<?php

include_once './Service/ServiceBase.php';
include_once './Validation/Attribute/Controller/notificationValidation.php';

class notificationService extends ServiceBase
{

	function startRest()
	{
		$this->listAttributesEqual = array();
		$this->validateDataAttributes();

		switch (action) {
			case 'search':
				$this->attributeList = array('id_notificacion', 'titulo', 'cuerpo', 'fecha', 'leida', 'dni_usuario_remitente', 'dni_usuario_destinatario');
				break;
			case 'searchBy':
				$this->attributeList = array('id_notificacion');
				$this->listAttributesEqual = array('id_notificacion');
				break;
			case 'add':
				$this->attributeList = array('titulo', 'cuerpo', 'fecha', 'leida', 'dni_usuario_remitente', 'dni_usuario_destinatario');
				break;
			case 'edit':
				$this->attributeList = array('id_notificacion', 'leida');
				break;
			case 'finalDelete':
				$this->attributeList = array('id_notificacion');
				break;
		}

		if (!empty($responseFront)) {
			return $responseFront;
		}
		$this->model = $this->createModelOne('notification');
		$this->validationClass = $this->createValidationOne('notification');
		$this->validationClass->model = $this->model;
		return $this->returnRest(action);
	}

	function addNotification($message, $ok)
	{
		if ($ok) {
			$this->model->ADD();
		}

		return $this->createFeedback($message, $ok);
	}

	function editNotification($message, $ok)
	{
		if ($ok) {
			$this->model->EDIT();
		}

		return $this->createFeedback($message, $ok);
	}

	function deleteNotification($message, $ok)
	{
		if ($ok) {
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
				$elements = $this->search();
				return $elements;
				break;
			case 'searchBy':
				$this->validateSearch();
				return $this->searchBy();
				break;
			case 'add':
				$this->validateAdd();
				return $this->addNotification('ANADIR_NOTIFICACION_OK', true);
			case 'edit':
				$this->validateEdit();
				return $this->editNotification('EDITAR_NOTIFICACION_OK', true);
				break;
			case 'finalDelete':
				$this->validateDelete("notification");
				return $this->deleteNotification('ELIMINAR_NOTIFICACION_OK', true);
				break;
		}
	}
}
