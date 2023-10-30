<?php

include_once './Validation/validate.php';

class notificationValidationAction extends Validate
{

    function validateSearch()
    {
        if ($this->isNotUser()) {
            fillExceptionAction('ACCION_DENEGADA_BUSCAR_NOTIFICACIONES');
        }
    }

    function validateAdd()
    {
        if ($this->isNotModeratorOrFormulator()) {
            fillExceptionAction('ACCION_DENEGADA_INSERTAR_NOTIFICACION');
        }
    }

    function validateEdit()
    {
        if ($this->isAdmin()) {
            fillExceptionAction('ACCION_DENEGADA_EDITAR_NOTIFICACION');
        }
        if (!$this->notificationExists()) {
            fillExceptionAction('NOTIFICACION_NO_EXISTE');
        }
        if ($this->isNotOwner()) {
            fillExceptionAction('USUARIO_NO_ES_DUEÑO_NOTIFICACION');
        }
    }

    function validateDelete()
    {
        if (!$this->notificationExists()) {
            fillExceptionAction('NOTIFICACION_NO_EXISTE');
        }
        if ($this->isNotUser()) {
            fillExceptionAction('ACCION_DENEGADA_ELIMINAR_NOTIFICACION');
        }
        if ($this->isNotOwner() && !$this->isAdmin()) {
            fillExceptionAction('USUARIO_NO_ES_DUEÑO_NOTIFICACION');
        }
    }

    function notificationExists()
    {
        $notification = $this->model->getById(array($this->model->arrayDataValue['id_notificacion']));
        return !empty($notification['resource']);
    }
    
    function isNotOwner()
    {
        return userSystem != $this->model->getById(array($this->model->arrayDataValue['id_notificacion']))["resource"]["dni_usuario_destinatario"];
    }

    function isNotUser()
    {
        return rolUserSystem == null;
    }

    function isAdmin()
    {
        return rolUserSystem == '1';
    }

    function isNotModeratorOrFormulator()
    {
        return rolUserSystem != '2' && rolUserSystem != '3';
    }
}
