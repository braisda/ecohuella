<?php

include_once './Service/ServiceBase.php';
include_once './Validation/Attribute/Controller/processUserExecutionParameter.php';

class processUserExecutionParameterService extends ServiceBase
{

	function startRest()
	{
		$this->listAttributesEqual = array();
		$this->validateDataAttributes();

		switch (action) {
			case 'search':
				$this->attributeList = array('id_proceso', 'version', 'dni_usuario_ejecucion', 'id_parametro', 'fecha_ejecucion', 'valor_parametro');
				break;
			case 'searchBy':
				$this->attributeList = array('id_proceso', 'version', 'dni_usuario_ejecucion', 'id_parametro');
				$this->listAttributesEqual = array('id_proceso', 'version', 'dni_usuario_ejecucion', 'id_parametro');
				break;
			case 'add':
				$this->attributeList = array('id_proceso', 'version', 'dni_usuario_ejecucion', 'id_parametro', 'fecha_ejecucion', 'valor_parametro');
				break;
			case 'edit':
				$this->attributeList = array('id_proceso', 'version', 'dni_usuario_ejecucion', 'id_parametro', 'fecha_ejecucion', 'valor_parametro');
				break;
			case 'finalDelete':
				$this->attributeList = array('id_proceso', 'version', 'dni_usuario_ejecucion');
				break;
		}

		if (!empty($responseFront)) {
			return $responseFront;
		}
		$this->model = $this->createModelOne('processUserExecutionParameter');
		$this->validationClass = $this->createValidationOne('processUserExecutionParameter');
		$this->validationClass->model = $this->model;
		return $this->returnRest(action);
	}

	function addProcessUserExecutionParameter($message, $ok)
	{
		if ($ok) {
			$this->model->ADD();
		}

		return $this->createFeedback($message, $ok);
	}

	function editProcessUserExecutionParameter($message, $ok)
	{
		if ($ok) {
			$this->model->EDIT();
		}

		return $this->createFeedback($message, $ok);
	}

	function deleteProcessUserExecutionParameter($message, $ok)
	{
		if ($ok) {
			$this->model->LOGIC_DELETE();
		} else {
			$this->model->DELETE();
		}

		include_once './Model/processUserExecutionModel.php';
		$modelProcessUserExecution = new processUserExecutionModel();

		$modelProcessUserExecution->arrayDataValue["id_proceso"] = $this->model->arrayDataValue['id_proceso'];
		$modelProcessUserExecution->arrayDataValue["version"] = $this->model->arrayDataValue['version'];
		$modelProcessUserExecution->arrayDataValue["dni_usuario_ejecucion"] = $this->model->arrayDataValue['dni_usuario_ejecucion'];

		$modelProcessUserExecution->DELETE();

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
				if ((rolUserSystem == '4' || rolUserSystem == '2')) {
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
				return $this->addProcessUserExecutionParameter('ANADIR_PROCESS_USER_EXECUTION_PARAMETER_OK', true);
			case 'edit':
				$this->validateEdit();
				return $this->editProcessUserExecutionParameter('EDITAR_PROCESS_USER_EXECUTION_PARAMETER_OK', true);
				break;
			case 'finalDelete':
				$this->validateDelete("processUserExecutionParameter");
				return $this->deleteProcessUserExecutionParameter('ELIMINAR_PROCESS_USER_EXECUTION_PARAMETER_OK', false);
				break;
		}
	}
}
