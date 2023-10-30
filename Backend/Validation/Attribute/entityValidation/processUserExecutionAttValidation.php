<?php

class processUserExecutionAttValidation extends Validate {

    function validateSearchAttributes() {
		$this->checkIdSearch();
		$this->checkDniExecutionSearch();
	}

	function validateSearchByAttributes() {
		$this->checkId();
		$this->checkDniExecution();
	}

	function validateAddAttributes() {
		$this->checkId();
		$this->checkDniExecution();
	}

	function validateDeleteAttributes() {
		$this->checkId();
		$this->checkDniExecution();
	}

	function checkId(){
		
		if($this->isEmpty($this->id_proceso)===true){
			fillAttributeException('ID_VACIO');
		}

		if(!$this->isNumeric($this->id_proceso)===true){
			fillAttributeException('ID_PROCESO_ERROR_FORMATO');
		}

		if($this->isEmpty($this->version)===true){
			fillAttributeException('VERSION_VACIO');
		}

		if(!$this->isNumeric($this->version)===true){
			fillAttributeException('VERSION_ERROR_FORMATO');
		}
	}

	function checkDniExecution()
	{

		if ($this->isEmpty($this->dni_usuario_ejecucion) === true) {
			fillAttributeException('DNI_VACIO');
		}

		if ($this->minLength($this->dni_usuario_ejecucion, 9) === false) {
			fillAttributeException('DNI_MENOR_QUE_9');
		}

		if ($this->maxLength($this->dni_usuario_ejecucion, 9) === false) {
			fillAttributeException('DNI_MAYOR_QUE_9');
		}

		if (!$this->dniFormat($this->dni_usuario_ejecucion)) {
			fillAttributeException('DNI_FORMATO_INCORRECTO');
		}

		if ($this->nifLetter($this->dni_usuario_ejecucion) === false) {
			fillAttributeException('DNI_LETRA_INCORRECTA');
		}
	}
	
	function checkIdSearch()
	{
		if (!empty($this->id_proceso)) {
			if (!$this->isNumeric($this->id_proceso) === true) {
				fillAttributeException('ID_PROCESO_ERROR_FORMATO');
			}
		}

		if (!empty($this->version)) {
			if (!$this->isNumeric($this->version) === true) {
				fillAttributeException('VERSION_ERROR_FORMATO');
			}
		}
	}

	function checkDniExecutionSearch()
	{
		if (!empty($this->dni_usuario_ejecucion)) {
			if ($this->minLength($this->dni_usuario_ejecucion, 9) === false) {
				fillAttributeException('DNI_MENOR_QUE_9');
			}

			if ($this->maxLength($this->dni_usuario_ejecucion, 9) === false) {
				fillAttributeException('DNI_MAYOR_QUE_9');
			}

			if (!$this->dniFormat($this->dni_usuario_ejecucion)) {
				fillAttributeException('DNI_FORMATO_INCORRECTO');
			}

			if ($this->nifLetter($this->dni_usuario_ejecucion) === false) {
				fillAttributeException('DNI_LETRA_INCORRECTA');
			}
		}
	}
}
?>