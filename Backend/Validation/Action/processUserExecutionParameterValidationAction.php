<?php

include_once './Validation/validate.php';

class processUserExecutionParameterValidationAction extends Validate {

    function validateSearch() { 
        if($this->isNotModeratorOrBasic()) {
			fillExceptionAction('ACCION_DENEGADA_BUSCAR_PROCESOS_USUARIO_PARAMETRO_EJECUCION');
        }
    }

    function validateAdd() {
        if($this->isNotBasic()) {
			fillExceptionAction('ACCION_DENEGADA_INSERTAR_PROCESOS_USUARIO_PARAMETRO_EJECUCION');
        }

        if($this->processUserExecutionParameterExists()) {
			fillExceptionAction('PROCESO_USUARIO_EJECUCION_PARAMETRO_YA_EXISTE');
        }
	}

    function validateEdit() {
        if($this->isNotBasic()) {
			fillExceptionAction('ACCION_DENEGADA_INSERTAR_PROCESOS_USUARIO_PARAMETRO_EJECUCION');
        }

        if(!$this->processUserExecutionParameterExists()) {
			fillExceptionAction('PROCESO_USUARIO_EJECUCION_PARAMETRO_NO_EXISTE');
        }
        /*if ($this->isLastVersion()) {
            fillExceptionAction('CALCULO_NO_ES_ULTIMA_VERSION');
        }*/
    }

    function validateDelete()
    {
        if (!$this->processUserExecutionParameterExists()) {
            fillExceptionAction('PROCESO_USUARIO_EJECUCION_PARAMETRO_NO_EXISTE');
        }
        if ($this->isNotBasic()) {
            fillExceptionAction('ACCION_DENEGADA_BORRAR_PROCESO_USUARIO_EJECUCION_PARAMETRO');
        }
        /*if ($this->isLastVersion()) {
            fillExceptionAction('CALCULO_ES_ULTIMA_VERSION');
        }*/
    }

    function processUserExecutionParameterExists() {
        //$processUserExecutionParameter = $this->model->getById(array($this->model->arrayDataValue['id_proceso'], $this->model->arrayDataValue['version'], $this->model->arrayDataValue['dni_usuario_ejecucion']));
        $processUserExecutionParameter = $this->model->seek(array("id_proceso", "version", "dni_usuario_ejecucion"), array($this->model->arrayDataValue['id_proceso'], $this->model->arrayDataValue['version'], $this->model->arrayDataValue['dni_usuario_ejecucion']));
        return !empty($processUserExecutionParameter['resource']);
    }

    function isNotBasic() {
        return rolUserSystem != '4';
    }

    function isNotModeratorOrBasic() {
        return rolUserSystem != '2' && rolUserSystem != '4';
    }
}
?>