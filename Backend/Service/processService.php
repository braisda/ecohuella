<?php

include_once './Service/ServiceBase.php';
include_once './Validation/Attribute/Controller/processValidation.php';

class processService extends ServiceBase
{

	function startRest()
	{
		$this->listAttributesEqual = array();
		if (action != 'finalDelete') {
			$this->validateDataAttributes();
		}

		switch (action) {
			case 'search':
				$this->attributeList = array('id_proceso', 'version', 'nombre', 'descripcion', 'formula', 'fecha_creacion', 'fecha_modificacion', 'activo', 'id_categoria', 'dni_usuario_creacion', 'dni_usuario_modificacion', 'borrado_logico');
				break;
			case 'explore':
				$this->attributeList = array('id_proceso', 'version', 'nombre', 'descripcion', 'formula', 'fecha_creacion', 'fecha_modificacion', 'activo', 'id_categoria', 'dni_usuario_creacion', 'dni_usuario_modificacion', 'borrado_logico');
				break;
			case 'searchBy':
				$this->attributeList = array('id_proceso', 'version');
				$this->listAttributesEqual = array('id_proceso', 'version');
				break;
			case 'add':
				$this->attributeList = array('id_proceso', 'version', 'nombre', 'descripcion', 'formula', 'fecha_creacion', 'fecha_modificacion', 'activo', 'id_categoria', 'dni_usuario_creacion', 'dni_usuario_modificacion');
				break;
			case 'edit':
				$this->attributeList = array('id_proceso', 'version', 'nombre', 'descripcion', 'formula', 'fecha_creacion', 'fecha_modificacion', 'activo', 'id_categoria', 'dni_usuario_creacion', 'dni_usuario_modificacion');
				break;
			case 'delete':
				$this->attributeList = array('id_proceso', 'version', 'borrado_logico');
				break;
			case 'finalDelete':
				$this->attributeList = array('id_proceso', 'version');
				break;
		}

		if (!empty($responseFront)) {
			return $responseFront;
		}
		$this->model = $this->createModelOne('process');
		$this->validationClass = $this->createValidationOne('process');
		$this->validationClass->model = $this->model;
		return $this->returnRest(action);
	}

	function addProcess($message, $ok)
	{
		if ($ok) {
			$this->model->ADD();
		}

		return $this->createFeedback($message, $ok);
	}

	function editProcess($message, $ok)
	{
		if ($ok) {
			$this->model->EDIT();
		}

		return $this->createFeedback($message, $ok);
	}

	function deleteProcess($message, $ok)
	{
		if ($ok) {
			$this->model->LOGIC_DELETE();
		} else {
			$this->deleteProcessParameters();
			$this->model->DELETE();
		}

		return $this->createFeedback($message, $ok);
	}

	function createFeedback($message, $ok)
	{
		$this->feedback['ok'] = $ok;
		$this->feedback['code'] = $message;
		return $this->feedback;
	}

	function returnRest($action)
	{
		switch ($action) {
			case 'search':
				$this->validateSearch();
				$processes = array();
				$elements = $this->search();
				foreach ($elements['resource'] as $elem) {
					if ($elem['borrado_logico'] === 0 && (rolUserSystem != '1')) {
						array_push($processes, $elem);
					}
				}
				$elements['resource'] = $processes;
				$elements['total'] = count($processes);
				$elements['filas'] = count($processes);
				return $elements;
				break;
			case 'explore':
				$this->validateSearch();
				$processes = array();
				$elements = $this->search();
				include_once './Model/processUserExecutionModel.php';
				$modelProcessUserExecution = new processUserExecutionModel();
				foreach ($elements['resource'] as $elem) {
					$modelProcessUserExecution->arrayDataValue["id_proceso"] = $elem['id_proceso'];
					$modelProcessUserExecution->arrayDataValue["version"] = $elem['version'];
					$modelProcessUserExecution->arrayDataValue["dni_usuario_ejecucion"] = userSystem;
					
					//consultamos si el proceso ha sido abierto por el usuario
					if ($modelProcessUserExecution->seek(
						array("id_proceso", "version", "dni_usuario_ejecucion"),
						array($modelProcessUserExecution->arrayDataValue["id_proceso"], $modelProcessUserExecution->arrayDataValue["version"], $modelProcessUserExecution->arrayDataValue["dni_usuario_ejecucion"])
					)["code"] == 'RECORDSET_VACIO'){
						$elem['abierto'] = 0;
					} else {
						$elem['abierto'] = 1;
					}

					if ($elem['borrado_logico'] === 0 && (rolUserSystem != '1')) {
						array_push($processes, $elem);
					}
				}
				$elements['resource'] = $processes;
				$elements['empieza'] = 0;
				$elements['total'] = count($processes);
				$elements['filas'] = count($processes);
				return $elements;
				break;
			case 'searchBy':
				$this->validateSearch();
				return $this->searchBy();
				break;
			case 'add':
				if($this->model->arrayDataValue['id_proceso'] == ""){
					$this->model->arrayDataValue['id_proceso'] = null;
				}
				$this->validateAdd();
				return $this->addProcess('ANADIR_PROCESO_OK', true);
			case 'edit':
				$this->validateEdit();
				return $this->editProcess('EDITAR_PROCESO_OK', true);
				break;
			case 'delete':
				$this->validateDelete("process");
				return $this->deleteProcess('ELIMINAR_PROCESO_OK', true);
				break;
			case 'finalDelete':
				$this->validateDelete("process");
				return $this->deleteProcess('ELIMINAR_PROCESO_OK', false);
				break;
		}
	}

	function deleteProcessParameters()
	{
		include_once './Model/parameterModel.php';
		$modelParameter = new parameterModel();
		$modelParameter->arrayDataValue["id_proceso"] = $this->model->arrayDataValue['id_proceso'];
		$modelParameter->arrayDataValue["version"] = $this->model->arrayDataValue['version'];
		$parameters = $modelParameter->search();
		if (count($parameters['resource']) > 0) {
			foreach ($parameters['resource'] as $param) {
				$modelParameterToDelete = new parameterModel();
				$modelParameterToDelete->arrayDataValue["id_parametro"] = $param["id_parametro"];
				$modelParameterToDelete->DELETE();
			}
		}
	}
}
