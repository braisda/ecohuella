<?php

include_once './Validation/validate.php';

class processValidationAction extends Validate {

    function validateSearch() {
        if($this->isAdmin()) {
			fillExceptionAction('ACCION_DENEGADA_BUSCAR_PROCESO');
        }
    }

    function validateAdd() {
		if($this->processExists()){
			fillExceptionAction('PROCESO_YA_EXISTE');
		}
        if($this->isNotFormulator()) {
			fillExceptionAction('ACCION_DENEGADA_INSERTAR_PROCESO');
        }
	}

    function validateEdit() {
        if (!$this->processExists()) {
            fillExceptionAction('PROCESO_NO_EXISTE');
        }
        if($this->isNotModeratorOrFormulator()){
			fillExceptionAction('ACCION_DENEGADA_EDITAR_PROCESO');
        }
    }

    function validateDelete() {
        if (!$this->processExists()) {
            fillExceptionAction('PROCESO_NO_EXISTE');
        }
        if($this->isNotModeratorOrFormulator()){
			fillExceptionAction('ACCION_DENEGADA_ELIMINAR_PROCESO');
        }
        if ($this->processIsUsed()) {
            fillExceptionAction('PROCESO_ESTA_EN_USO');
        }
    }

    function processExists() {
        $process = $this->model->getById(array($this->model->arrayDataValue['id_proceso'], $this->model->arrayDataValue['version']));
        //$process = $this->model->seek(array("version", "nombre", "id_categoria"), array($this->model->arrayDataValue['version'], $this->model->arrayDataValue['nombre'], $this->model->arrayDataValue['id_categoria']));
        return !empty($process['resource']) && $process['resource']['borrado_logico'] == '0';
    }

    function processIsUsed() {
        include_once './Model/processUserExecutionModel.php';
        $modelProcessUserExecution = new processUserExecutionModel();
        $processUserExecution = $modelProcessUserExecution->seek(array("id_proceso", "version"), array($this->model->arrayDataValue['id_proceso'], $this->model->arrayDataValue['version']));
        return !empty($processUserExecution['resource']);
    }

    function isAdmin() {
        return (rolUserSystem == '1');
    }

    function isNotFormulator() {
        return (rolUserSystem != '3');
    }

    function isNotModeratorOrFormulator()
    {
        return rolUserSystem != '2' && rolUserSystem != '3';
    }


}
?>