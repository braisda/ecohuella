<?php

include_once './Service/ServiceBase.php';
include_once './Validation/Attribute/Controller/parameterValidation.php';

class parameterService extends ServiceBase {

    function startRest(){
		$this->listAttributesEqual = array();
		$this->validateDataAttributes();
		
		switch(action){
			case 'search':
				$this->attributeList = array('id_parametro', 'nombre', 'descripcion', 'unidad', 'dni_usuario_creacion', 'dni_usuario_modificacion', 'id_proceso', 'version');
				break;
			case 'searchBy':
				$this->attributeList = array('id_parametro');
				$this->listAttributesEqual = array('id_parametro');
			break;
			case 'add':
				$this->attributeList = array('nombre', 'descripcion', 'unidad', 'dni_usuario_creacion', 'dni_usuario_modificacion', 'id_proceso', 'version');
			break;
			case 'edit':
				$this->attributeList = array('id_parametro', 'nombre', 'descripcion', 'unidad', 'dni_usuario_modificacion');
			break;
			case 'finalDelete':
				$this->attributeList = array('id_parametro');
			break;
		}
		
		if (!empty($responseFront)) {
			return $responseFront;
		}
		$this->model = $this->createModelOne('parameter');
		$this->validationClass = $this->createValidationOne('parameter');
		$this->validationClass->model = $this->model;
		return $this->returnRest(action);
	}

	function addParameter($message, $ok){
		if ($ok) {
			$this->model->ADD();
		}
		
		return $this->createFeedback($message, $ok);
	}

	function editParameter($message, $ok){
		if ($ok) {
			$this->model->EDIT();
		}

		return $this->createFeedback($message, $ok);
	}

	function deleteParameter($message, $ok) {
		if ($ok) {
			$this->model->DELETE();
		}

		return $this->createFeedback($message, $ok);
	}

	function createFeedback($message, $ok) {
		$this->feedback['ok'] = $ok;
		$this->feedback['code'] = $message;
		return $this->feedback;
	}

	function returnRest($action) {
		switch($action){
			case 'search':
				$this->validateSearch();
				if (rolUserSystem == '3' || rolUserSystem == '4') {
					$elements = $this->search();
				}
				return $elements;
			break;
			case 'searchBy':
				$this->validateSearch();
				return $this->searchBy();
			break;
			case 'add':
				$this->validateAdd();
				return $this->addParameter('ANADIR_PARAMETRO_OK', true);
			case 'edit':
				$this->validateEdit();
				return $this->editParameter('EDITAR_PARAMETRO_OK', true);
			break;
			case 'finalDelete':
				$this->validateDelete("parameter");
				return $this->deleteParameter('ELIMINAR_PARAMETRO_OK', true);
			break;
		}
	}
}
?>