<?php

class parameterAttValidation extends Validate
{

	function validateSearchAttributes()
	{
		$this->checkIdSearch();
		$this->checkNameSearch();
		$this->checkDescriptionSearch();
		$this->checkUnitSearch();
		$this->checkDniCreationSearch();
		$this->checkDniModificationSearch();
		$this->checkIdProcessSearch();
		$this->checkVersionSearch();
	}

	function validateSearchByAttributes()
	{
		$this->checkId();
	}

	function validateAddAttributes()
	{
		$this->checkName();
		$this->checkDescription();
		$this->checkUnit();
		$this->checkDniCreation();
		$this->checkDniModification();
		$this->checkIdProcess();
		$this->checkVersion();
	}

	function validateEditAttributes()
	{
		$this->checkId();
		$this->checkName();
		$this->checkDescription();
		$this->checkUnit();
		$this->checkDniModification();
	}

	function checkId()
	{

		if ($this->isEmpty($this->id_parametro) === true) {
			fillAttributeException('ID_VACIO');
		}

		if (!$this->isNumeric($this->id_parametro) === true) {
			fillAttributeException('ID_PARAMETRO_ERROR_FORMATO');
		}
	}

	function checkName()
	{

		if ($this->isEmpty($this->nombre) === true) {
			fillAttributeException('NOMBRE_VACIO');
		}

		if ($this->minLength($this->nombre, 3) === false) {
			fillAttributeException('NOMBRE_MENOR_QUE_3');
		}

		if ($this->maxLength($this->nombre, 45) === false) {
			fillAttributeException('NOMBRE_MAYOR_QUE_45');
		}

		if (!$this->checkSpaceLettersNumbers($this->nombre)) {
			fillAttributeException('NOMBRE_FORMATO_INCORRECTO');
		}
	}

	function checkDescription()
	{

		if ($this->isEmpty($this->descripcion) === true) {
			fillAttributeException('DESCRIPCION_VACIA');
		}

		if ($this->minLength($this->descripcion, 3) === false) {
			fillAttributeException('DESCRIPCION_MENOR_QUE_3');
		}

		if ($this->maxLength($this->descripcion, 45) === false) {
			fillAttributeException('DESCRIPCION_MAYOR_QUE_45');
		}

		if (!$this->checkSpaceLetters($this->descripcion)) {
			fillAttributeException('DESCRIPCION_FORMATO_INCORRECTO');
		}
	}

	function checkUnit()
	{

		if ($this->isEmpty($this->unidad) === true) {
			fillAttributeException('UNIDAD_VACIO');
		}

		if ($this->maxLength($this->unidad, 45) === false) {
			fillAttributeException('UNIDAD_MAYOR_QUE_45');
		}

		if (!$this->checkSpaceLetters($this->unidad)) {
			fillAttributeException('UNIDAD_FORMATO_INCORRECTO');
		}
	}

	function checkDniCreation()
	{

		if ($this->isEmpty($this->dni_usuario_creacion) === true) {
			fillAttributeException('DNI_VACIO');
		}

		if ($this->minLength($this->dni_usuario_creacion, 9) === false) {
			fillAttributeException('DNI_MENOR_QUE_9');
		}

		if ($this->maxLength($this->dni_usuario_creacion, 9) === false) {
			fillAttributeException('DNI_MAYOR_QUE_9');
		}

		if (!$this->dniFormat($this->dni_usuario_creacion)) {
			fillAttributeException('DNI_FORMATO_INCORRECTO');
		}

		if ($this->nifLetter($this->dni_usuario_creacion) === false) {
			fillAttributeException('DNI_LETRA_INCORRECTA');
		}
	}

	function checkDniModification()
	{

		if ($this->isEmpty($this->dni_usuario_modificacion) === true) {
			fillAttributeException('DNI_VACIO');
		}

		if ($this->minLength($this->dni_usuario_modificacion, 9) === false) {
			fillAttributeException('DNI_MENOR_QUE_9');
		}

		if ($this->maxLength($this->dni_usuario_modificacion, 9) === false) {
			fillAttributeException('DNI_MAYOR_QUE_9');
		}

		if (!$this->dniFormat($this->dni_usuario_modificacion)) {
			fillAttributeException('DNI_FORMATO_INCORRECTO');
		}

		if ($this->nifLetter($this->dni_usuario_modificacion) === false) {
			fillAttributeException('DNI_LETRA_INCORRECTA');
		}
	}

	function checkIdProcess()
	{

		if ($this->isEmpty($this->id_proceso) === true) {
			fillAttributeException('ID_VACIO');
		}

		if (!$this->isNumeric($this->id_proceso) === true) {
			fillAttributeException('ID_PROCESO_ERROR_FORMATO');
		}
	}


	function checkVersion()
	{
		if ($this->isEmpty($this->version) === true) {
			fillAttributeException('VERSION_VACIO');
		}

		if (!$this->isNumeric($this->version) === true) {
			fillAttributeException('VERSION_ERROR_FORMATO');
		}
	}

	function checkIdSearch()
	{
		if (!empty($this->id_parametro)) {
			if (!$this->isNumeric($this->id_parametro) === true) {
				fillAttributeException('ID_PARAMETRO_ERROR_FORMATO');
			}
		}
	}

	function checkNameSearch()
	{
		if (!empty($this->nombre)) {
			if ($this->maxLength($this->nombre, 45) === false) {
				fillAttributeException('NOMBRE_MAYOR_QUE_45');
			}

			if (!$this->checkSpaceLettersNumbers($this->nombre)) {
				fillAttributeException('NOMBRE_FORMATO_INCORRECTO');
			}
		}
	}

	function checkDescriptionSearch()
	{
		if (!empty($this->descripcion)) {
			if ($this->maxLength($this->descripcion, 500) === false) {
				fillAttributeException('DESCRIPCION_MAYOR_QUE_500');
			}

			if (!$this->checkSpaceLetters($this->descripcion)) {
				fillAttributeException('DESCRIPCION_FORMATO_INCORRECTO');
			}
		}
	}

	function checkUnitSearch()
	{
		if (!empty($this->unidad)) {
			if ($this->maxLength($this->unidad, 45) === false) {
				fillAttributeException('UNIDAD_MAYOR_QUE_45');
			}

			if (!$this->checkSpaceLetters($this->unidad)) {
				fillAttributeException('UNIDAD_FORMATO_INCORRECTO');
			}
		}
	}

	function checkDniCreationSearch()
	{
		if (!empty($this->dni_usuario_creacion)) {
			if ($this->minLength($this->dni_usuario_creacion, 9) === false) {
				fillAttributeException('DNI_MENOR_QUE_9');
			}

			if ($this->maxLength($this->dni_usuario_creacion, 9) === false) {
				fillAttributeException('DNI_MAYOR_QUE_9');
			}

			if (!$this->dniFormat($this->dni_usuario_creacion)) {
				fillAttributeException('DNI_FORMATO_INCORRECTO');
			}

			if ($this->nifLetter($this->dni_usuario_creacion) === false) {
				fillAttributeException('DNI_LETRA_INCORRECTA');
			}
		}
	}

	function checkDniModificationSearch()
	{

		if (!empty($this->dni_usuario_modificacion)) {
			if ($this->minLength($this->dni_usuario_modificacion, 9) === false) {
				fillAttributeException('DNI_MENOR_QUE_9');
			}

			if ($this->maxLength($this->dni_usuario_modificacion, 9) === false) {
				fillAttributeException('DNI_MAYOR_QUE_9');
			}

			if (!$this->dniFormat($this->dni_usuario_modificacion)) {
				fillAttributeException('DNI_FORMATO_INCORRECTO');
			}

			if ($this->nifLetter($this->dni_usuario_modificacion) === false) {
				fillAttributeException('DNI_LETRA_INCORRECTA');
			}
		}
	}

	function checkIdProcessSearch()
	{
		if (!empty($this->id_proceso)) {
			if (!$this->isNumeric($this->id_proceso) === true) {
				fillAttributeException('ID_PROCESO_ERROR_FORMATO');
			}
		}
	}

	function checkVersionSearch()
	{
		if (!empty($this->version)) {
			if (!$this->isNumeric($this->version) === true) {
				fillAttributeException('VERSION_ERROR_FORMATO');
			}
		}
	}
}
