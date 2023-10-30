<?php

class ServiceBase {

	protected $model;
	protected $validationClass;

	function fillExceptionAction($message) {
		$feedback['ok'] = false;
		$feedback['code'] = $message;
		
		if(!isset($_POST['test'])){
			$this->logExceptionsAction($feedback);
		}

		header('Content-type: application/json');
		echo(json_encode($feedback));
		exit();
	}

	function createModelOne($entity) {
		$baseEntity = $entity;
		include_once './Model/'.$baseEntity.'Model.php';
		$baseEntity = $baseEntity.'Model'; 
		$this->entity = new $baseEntity;

		if(isset($this->attributeList)){
			$this->fillModel($this->entity, $this->attributeList);
		}

		return $this->entity;
	}

	function createValidationOne($entity) {
		$baseEntity = $entity;
		include_once './Validation/Action/'.$baseEntity.'ValidationAction.php';
		$baseEntity = $baseEntity.'ValidationAction';
		$validation = new $baseEntity;

		if(isset($this->attributeList)){
			$this->fillModel($validation, $this->attributeList);
		}

		return $validation;
	}

    /*Funtion to call the attributes validation for an action.*/
	function validateDataAttributes(){
		$validation = 'validate_data_'.controller;	
		$validation();
	}

	function fillModel(&$entityObject, $attributeList){

		$object = $entityObject;
		$object->arrayDataValue = array();
		$i = 0;

		$object = $this->pagination($object, $attributeList);

		foreach ($attributeList as $attribute){
			if (!isset($_POST[$attribute])){
				$_POST[$attribute] = '';
			}
			$object->searchCriteria[$attribute] = $_POST[$attribute];	
		}
		
		foreach ($attributeList as $attribute){
			if (!isset($_POST[$attribute])){
				unset($attributeList[$i]);
			}
			$i++;
		}
		
		foreach ($attributeList as $attribute){
			if (!isset($_POST[$attribute])){
				$_POST[$attribute] = '';
			}

			if(in_array($attribute, $this->listAttributesEqual)){
				$attributeEqual = $attribute;
				if($_POST[$attribute] != ''){
					$object->arrayDataValue[$attributeEqual] = $_POST[$attribute];
				}
			}else{
				$object->arrayDataValue[$attribute] = $_POST[$attribute];
			}
		}
	}

	function pagination($object, $attributeList){
		//Action starts with buscar/verEnDetalle
		if (substr(action, 0, 6) == 'search' || action == 'verEnDetalle' ){
			foreach ($attributeList as $attribute){
				if (!isset($_POST[$attribute])){
					$_POST[$attribute] = '';
				}
				$object->searchCriteria[$attribute] = $_POST[$attribute];
			}

			if (!isset($_POST['empieza'])) {
				$start = 'nulo'; 
			} elseif ($_POST['empieza'] == '' || $_POST['empieza'] == 0) { 
				$start = 'nulo';
			} else { 
				$start = $_POST['empieza']; 
			} // if is empty stars by default in 0

			$object->start = $start;
			
			if (!isset($_POST['filaspagina'])) { 
				$pageRaw = 'nulo'; 
			} elseif ($_POST['filaspagina'] == '' || $_POST['filaspagina'] == 0) { 
				$pageRaw = 'nulo'; 
			} else { $pageRaw = $_POST['filaspagina']; 
			}// if pageRaw is null, search all
			
			$object->pageRaw = $pageRaw;
		}
		return $object;
	}

	function search() {
		$infoSearch = $this->model->SEARCH($this->model->arrayDataValue, $this->model->orden, $this->model->tipoOrden);

			//No se puede ver la contraseña de los usuarios
			if(controller == 'user' && action == 'search'){
				for($i = 0 ; $i  < count($infoSearch['resource']); $i++){
					$infoSearch['resource'][$i]['password'] = '********************************';
				}
			}

			$this->feedback['ok'] = true;
			$this->feedback['code'] = $infoSearch['code'];
			$this->feedback['resource'] = $infoSearch['resource'];
			//Información de pagincación
			$this->feedback['total'] = $infoSearch['total'];
			$this->feedback['empieza'] = $infoSearch['empieza'];
			$this->feedback['filas'] = $infoSearch['filas'];
			$this->feedback['criteriosbusqueda'] = $infoSearch['criteriosbusqueda'];

			return $this->feedback;
	}

	function validateSearch() {
		$this->validationClass->validateSearch();
	}

	function validateAdd() {
		$this->validationClass->validateAdd();
	}

	function validateEdit() {
		$this->validationClass->validateEdit();
	}

	function validateDelete($entity) {
		switch($entity){
			case 'user':
				$userModel = $this->createModelOne("user");
				$userRole = $userModel->seek(array("dni"), array($this->model->arrayDataValue['dni']))['resource']['id_rol'];
				$this->validationClass->validateDelete($userRole);
			break;
            case 'category':
                $this->validationClass->validateDelete();
            break;
			case 'process':
                $this->validationClass->validateDelete();
            break;
			case 'notification':
                $this->validationClass->validateDelete();
            break;
			case 'parameter':
                $this->validationClass->validateDelete();
            break;
			case 'processUserExecution':
                $this->validationClass->validateDelete();
            break;
			case 'processUserExecutionParameter':
                $this->validationClass->validateDelete();
            break;
		}
	}

	function searchBy() {
		/*if (controller == 'user' && action == 'searchBy') {
			$this->model->arrayDataValue = array($this->model->arrayDataValue['dni']);
		} elseif(controller == 'category' && action == 'searchBy'){
			$this->model->arrayDataValue = array($this->model->arrayDataValue['id_categoria']);
		} elseif(controller == 'process' && action == 'searchBy'){
			$this->model->arrayDataValue = array($this->model->arrayDataValue['id_proceso'], $this->model->arrayDataValue['version']);
		}*/
		
		$keys = array();
		foreach ($this->model->arrayDataValue as $key => $value) {
			array_push($keys, $this->model->arrayDataValue[$key]);
		}

		$infoSearch = $this->model->getById($keys);
		//No se puede ver la contraseña de los usuarios
		if(controller == 'user' && action == 'searchBy' && count($infoSearch['resource']) == 1){
			$infoSearch['resource'][0]['password'] = '********************************';
		}
		$this->feedback['ok'] = true;
		$this->feedback['code'] = $infoSearch['code'];
		$this->feedback['resource'] = $infoSearch['resource'];
	return $this->feedback;

}

function checkPermission() {
	include_once "./JWT/token.php";
	
	$roleModel = $this->createModelOne("role");
	$rolActionFunctionalityModel = $this->createModelOne("rolActionFunctionality");
	$actionModel = $this->createModelOne("action");
	$functionalityModel = $this->createModelOne("functionality");

	// Obtains the roleId
	$tokenFront = $this->loadTokenHeader();
	$result = MiToken::devuelveToken($tokenFront);
	$roleId = $result->data->rol;

	// Obtains the actionId
	$actionId = $actionModel->seek(array("nombre_accion"), array(action))['resource'];

	// Obtains the functionalityId
	$functionalityId = $functionalityModel->seek(array("nombre_funcionalidad"), array(controller))['resource'];

	if (!empty($actionId) && empty($actionId["code"]) && !empty($functionalityId) && empty($functionalityId["code"])) {
		return !empty($rolActionFunctionalityModel->seek(array('id_rol', 'id_accion', 'id_funcionalidad'), array($roleId, $actionId['id_accion'], $functionalityId['id_funcionalidad']))['resource']);	
	}
	return false;
}

///////////////////////////////////////////////cargarTokenCabecera//////////////////////////////////////////////////

	function loadTokenHeader(){
		$tokenFront = '';

		foreach(apache_request_headers() as $header =>$value){
			if($header == 'Authorization')
				$tokenFront = $value;
		}	

		return $tokenFront;
	}

}

?>