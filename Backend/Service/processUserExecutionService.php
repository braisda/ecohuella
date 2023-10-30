<?php

include_once './Service/ServiceBase.php';
include_once './Validation/Attribute/Controller/processUserExecution.php';

class processUserExecutionService extends ServiceBase
{

	function startRest()
	{
		$this->listAttributesEqual = array();
		$this->validateDataAttributes();

		switch (action) {
			case 'search':
				$this->attributeList = array('id_proceso', 'version', 'dni_usuario_ejecucion');
				break;
			case 'searchBy':
				$this->attributeList = array('id_proceso', 'version', 'dni_usuario_ejecucion');
				$this->listAttributesEqual = array('id_proceso', 'version', 'dni_usuario_ejecucion');
				break;
			case 'add':
				$this->attributeList = array('id_proceso', 'version', 'dni_usuario_ejecucion');
				break;
			case 'finalDelete':
				$this->attributeList = array('id_proceso', 'version', 'dni_usuario_ejecucion');
				break;
		}

		if (!empty($responseFront)) {
			return $responseFront;
		}
		$this->model = $this->createModelOne('processUserExecution');
		$this->validationClass = $this->createValidationOne('processUserExecution');
		$this->validationClass->model = $this->model;
		return $this->returnRest(action);
	}

	function addProcessUserExecution($message, $ok)
	{
		if ($ok) {
			$this->model->ADD();
		}

		return $this->createFeedback($message, $ok);
	}

	function deleteProcessUserExecution($message, $ok)
	{
		$this->model->DELETE();

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
				if ((rolUserSystem == '4')) {
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
				return $this->addProcessUserExecution('ANADIR_PROCESS_USER_EXECUTION_OK', true);
			case 'finalDelete':
				$this->validateDelete("processUserExecution");
				return $this->deleteProcessUserExecution('ELIMINAR_PROCESS_USER_EXECUTION_OK', true);
				break;
		}
	}
}
