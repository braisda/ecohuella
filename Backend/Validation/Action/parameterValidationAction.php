<?php

include_once './Validation/validate.php';

class parameterValidationAction extends Validate {

    function validateSearch() { 
        if($this->isNotFormulatorOrBasic()) {
			fillExceptionAction('ACCION_DENEGADA_BUSCAR_PARAMETROS');
        }
    }

    function validateAdd() {
        if($this->isNotFormulator()) {
			fillExceptionAction('ACCION_DENEGADA_INSERTAR_PARAMETRO');
        }
	}

    function validateEdit() {
        if($this->isNotFormulator()) {
			fillExceptionAction('ACCION_DENEGADA_EDITAR_PARAMETRO');
        }
        if (!$this->parameterExists()) {
            fillExceptionAction('PARAMETRO_NO_EXISTE');
        }
    }

    function validateDelete() {
        if($this->isNotFormulator()) {
			fillExceptionAction('ACCION_DENEGADA_ELIMINAR_PARAMETRO');
        }
        if (!$this->parameterExists()) {
            fillExceptionAction('PARAMETRO_NO_EXISTE');
        }
        if ($this->parameterIsUsed()) {
            fillExceptionAction('PARAMETRO_ESTA_EN_USO');
        }
    }

    function parameterExists() {
        $parameter = $this->model->getById(array($this->model->arrayDataValue['id_parametro']));
        return !empty($parameter['resource']);
    }

    function parameterIsUsed() {
        $parameter = $this->model->getById(array($this->model->arrayDataValue['id_parametro']));
        include_once './Model/processModel.php';
        $modelProcess = new processModel();
        $process = $modelProcess->seek(array("id_proceso", "version"), array($parameter["resource"]['id_proceso'], $parameter["resource"]['version']));
        return str_contains($process["resource"]["formula"], '#_' . strval($parameter["resource"]['id_parametro']) . "_#");
    }

    function parameterNameDuplicated() {
        $parameter = $this->model->seek(array("nombre"), array($this->model->arrayDataValue['nombre']));
        return !empty($parameter['resource']);
    }

    function isNotFormulatorOrBasic() {
        return rolUserSystem != '3' && rolUserSystem != '4';
    }

    function isNotFormulator() {
        return rolUserSystem != '3';
    }

    function denyDeleteAction() {
        $row = $this->model->getById(array($this->model->arrayDataValue['id_parametro']))['resource'];
        return !($row['id_parametro'] == '1');
    }


}
?>