<?php

include_once './Service/ServiceBase.php';
include_once './Validation/Attribute/Controller/categoryValidation.php';

class categoryService extends ServiceBase {

    function startRest(){
		$this->listAttributesEqual = array();
		if (action != 'finalDelete') {
			$this->validateDataAttributes();
		}
		
		switch(action){
			case 'search':
				$this->attributeList = array('id_categoria', 'nombre', 'descripcion', 'id_categoria_padre', 'dni_usuario_creacion', 'dni_usuario_modificacion', 'borrado_logico');
				break;
			case 'searchBy':
				$this->attributeList = array('id_categoria');
				$this->listAttributesEqual = array('id_categoria');
			break;
			case 'add':
				$this->attributeList = array('nombre', 'descripcion', 'id_categoria_padre', 'dni_usuario_creacion', 'dni_usuario_modificacion');
			break;
			case 'edit':
				$this->attributeList = array('id_categoria', 'nombre', 'descripcion', 'id_categoria_padre', 'dni_usuario_creacion', 'dni_usuario_modificacion');
			break;
			case 'delete':
				$this->attributeList = array('id_categoria', 'dni_usuario_modificacion');
			break;
			case 'finalDelete':
				$this->attributeList = array('id_categoria');
			break;

		}
		
		if (!empty($responseFront)) {
			return $responseFront;
		}
		$this->model = $this->createModelOne('category');
		$this->validationClass = $this->createValidationOne('category');
		$this->validationClass->model = $this->model;
		return $this->returnRest(action);
	}

	function addCategory($message, $ok){
		if ($ok) {
			$this->model->ADD();
		}
		
		return $this->createFeedback($message, $ok);
	}

	function editCategory($message, $ok){
		if ($ok) {
			$this->model->EDIT();
		}

		return $this->createFeedback($message, $ok);
	}

	function deleteCategory($message, $ok) {
		if ($ok) {
			$this->model->LOGIC_DELETE();
		} else {
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
				$categories = array();
				$elements = $this->search();
				foreach ($elements['resource'] as $elem) {
					if ($elem['borrado_logico'] === 0 && (rolUserSystem != '1')) {
						if ($elem['id_categoria_padre'] == null) {
							$elem['id_categoria_padre']["id_categoria"] = "-";
						}
                        array_push($categories, $elem);
					}
				}
				$elements['resource'] = $categories;
				$elements['total'] = count($categories);
				$elements['filas'] = count($categories);
				return $elements;
			break;
			case 'searchBy':
				$this->validateSearch();
				return $this->searchBy();
			break;
			case 'add':
				$this->validateAdd();
				return $this->addCategory('ANADIR_CATEGORIA_OK', true);
			case 'edit':
				$this->validateEdit();
				return $this->editCategory('EDITAR_CATEGORIA_OK', true);
			break;
			case 'delete':
				$this->validateDelete("category");
				return $this->deleteCategory('ELIMINAR_CATEGORIA_OK', true);
			break;
			case 'finalDelete':
				$this->validateDelete("category");
				return $this->deleteCategory('ELIMINAR_CATEGORIA_OK', false);
			break;
		}
	}
}
?>