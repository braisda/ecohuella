<?php

class processUserExecutionParameterAttValidation extends Validate {

    function validateSearchAttributes() {
		$this->checkIdSearch();
		$this->checkDniExecutionSearch();
		$this->checkDateSearch();
		$this->checkValueParameterSearch();
	}

	function validateSearchByAttributes() {
		$this->checkId();
		$this->checkDniExecution();
	}

	function validateAddAttributes() {
		$this->checkId();
		$this->checkDniExecution();
		$this->checkDate();
		$this->checkValueParameter();
	}

	function validateEditAttributes() {
		$this->checkId();
		$this->checkDniExecution();
		$this->checkDate();
		$this->checkValueParameter();
	}

	function checkId(){
		
		if($this->isEmpty($this->id_proceso)===true){
			fillAttributeException('ID_PROCESO_VACIO');
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

		if($this->isEmpty($this->id_parametro)===true){
			fillAttributeException('ID_PARAMETRO_VACIO');
		}

		if(!$this->isNumeric($this->id_parametro)===true){
			fillAttributeException('ID_PARAMETRO_ERROR_FORMATO');
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

	function checkDate()
	{
		if (!empty($this->fecha_ejecucion)) {
			switch ($this->checkDateNumbersSlash($this->fecha_ejecucion)) {
				case 'formatofechamal':
					fillAttributeException('FECHA_FORMATO_INCORRECTO');
					break;

				case 'tieneletras':
					fillAttributeException('FECHA_SOLO_NUMEROS_Y_GUIONES');
					break;

				case 'tamañomenor10':
					fillAttributeException('FECHA_MENOR_QUE_10');
					break;

				case 'tamañomayor10':
					fillAttributeException('FECHA_MAYOR_QUE_10');
					break;

				case 'fechafutura':
					fillAttributeException('FECHA_IMPOSIBLE');
					break;

				default:
					break;
			}
		} else {
			fillAttributeException('FECHA_VACIA');
		}
	}

	function checkValueParameter()
	{
		if ($this->isEmpty($this->valor_parametro) === true) {
			fillAttributeException('VALOR_VACIO');
		}


		if ($this->maxLength($this->valor_parametro, 9) === false) {
			fillAttributeException('VALOR_MAYOR_QUE_9');
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

		if (!empty($this->id_parametro)) {
			if (!$this->isNumeric($this->id_parametro) === true) {
				fillAttributeException('ID_PARAMETRO_ERROR_FORMATO');
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

	function checkDateSearch()
	{
		if (!empty($this->fecha_ejecucion)) {
			switch ($this->checkDateNumbersSlash($this->fecha_ejecucion)) {
				case 'formatofechamal':
					fillAttributeException('FECHA_FORMATO_INCORRECTO');
					break;

				case 'tieneletras':
					fillAttributeException('FECHA_SOLO_NUMEROS_Y_GUIONES');
					break;

				case 'tamañomenor10':
					fillAttributeException('FECHA_MENOR_QUE_10');
					break;

				case 'tamañomayor10':
					fillAttributeException('FECHA_MAYOR_QUE_10');
					break;

				case 'fechafutura':
					fillAttributeException('FECHA_IMPOSIBLE');
					break;

				default:
					break;
			}
		}
	}

	function checkValueParameterSearch()
	{
		if (!empty($this->valor_parametro)) {
			if ($this->maxLength($this->valor_parametro, 9) === false) {
				fillAttributeException('VALOR_MAYOR_QUE_9');
			}
		}
	}
	
}
?>