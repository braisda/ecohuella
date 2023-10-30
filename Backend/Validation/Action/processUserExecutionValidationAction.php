<?php

include_once './Validation/validate.php';

class processUserExecutionValidationAction extends Validate
{

    function validateSearch()
    {
        if ($this->isNotBasic()) {
            fillExceptionAction('ACCION_DENEGADA_BUSCAR_PROCESOS_USUARIO_EJECUCION');
        }
    }

    function validateAdd()
    {
        if ($this->processUserExecutionExists()) {
            fillExceptionAction('PROCESO_USUARIO_EJECUCION_YA_EXISTE');
        }

        if ($this->isNotBasic()) {
            fillExceptionAction('ACCION_DENEGADA_INSERTAR_PROCESOS_USUARIO_EJECUCION');
        }

        if ($this->previousVersionEmpty()) {
            fillExceptionAction('VERSION_ANTERIOR_NO_CALCULADA');
        }
    }

    function validateDelete()
    {
        if (!$this->processUserExecutionExists()) {
            fillExceptionAction('PROCESO_USUARIO_EJECUCION_NO_EXISTE');
        }
        if ($this->isNotBasic()) {
            fillExceptionAction('ACCION_DENEGADA_BORRAR_PROCESO_USUARIO_EJECUCION');
        }
        if ($this->processUserExecutionIsUsed()) {
            fillExceptionAction('PROCESO_USUARIO_EJECUCION_EN_USO');
        }
    }

    function processUserExecutionExists()
    {
        $category = $this->model->getById(array($this->model->arrayDataValue['id_proceso'], $this->model->arrayDataValue['version'], $this->model->arrayDataValue['dni_usuario_ejecucion']));
        return !empty($category['resource']);
    }

    function previousProcessUserExecutionExists($version)
    {
        $category = $this->model->getById(array($this->model->arrayDataValue['id_proceso'], $version, $this->model->arrayDataValue['dni_usuario_ejecucion']));
        return !empty($category['resource']);
    }

    function previousVersionEmpty()
    {
        include_once './Model/processUserExecutionParameterModel.php';
        $modelProcessUserExecutionParameter = new processUserExecutionParameterModel();

        $versionActual = $this->model->arrayDataValue['version'];
        $toret = false;
        for ($i = $versionActual; $i >= 0; $i--) {
            if ($this->previousProcessUserExecutionExists($i-1)) {                
                $processUserExecutionParameter = $modelProcessUserExecutionParameter->seek(
                    array("id_proceso", "version", "dni_usuario_ejecucion"),
                    array($this->model->arrayDataValue['id_proceso'], $i - 1, $this->model->arrayDataValue['dni_usuario_ejecucion'])
                );
                $toret = empty($processUserExecutionParameter['resource']);
                break;
            }
        }
        return $toret;
    }

    function isNotBasic()
    {
        return rolUserSystem != '4';
    }

    
    function processUserExecutionIsUsed()
    {
        include_once './Model/processUserExecutionParameterModel.php';
        $modelProcessUserExecutionParameter = new processUserExecutionParameterModel();
        $processUserExecutionParameter = $modelProcessUserExecutionParameter->seek(
            array("id_proceso", "version", "dni_usuario_ejecucion"),
            array($this->model->arrayDataValue['id_proceso'], $this->model->arrayDataValue['version'], $this->model->arrayDataValue['dni_usuario_ejecucion'])
        );
        return !empty($processUserExecutionParameter['resource']);
    }
}
