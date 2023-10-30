<?php

class processAttValidation extends Validate
{

	function validateSearchAttributes()
	{
		$this->checkIdSearch();
		$this->checkVersionSearch();
		$this->checkNameSearch();
		$this->checkDescriptionSearch();
		$this->checkFormulaSearch();
		$this->checkCreationDateSearch();
		$this->checkModificationDateSearch();
		$this->checkIdCategoriaSearch();
		$this->checkDniCreationSearch();
		$this->checkDniModificationSearch();
		$this->checkActivoSearch();
	}

	function validateSearchByAttributes()
	{
		$this->checkId();
		$this->checkVersion();
	}

	function validateAddAttributes()
	{
		$this->checkName();
		$this->checkDescription();
		$this->checkEmptyFormula();
		$this->checkCreationDate();
		$this->checkModificationDate();
		$this->checkIdCategoria();
		$this->checkDniCreation();
		$this->checkDniModification();
		$this->checkActivo();
	}

	function validateEditAttributes()
	{
		$this->checkId();
		$this->checkVersion();
		$this->checkName();
		$this->checkDescription();
		$this->checkFormula();
		$this->checkCreationDate();
		$this->checkModificationDate();
		$this->checkIdCategoria();
		$this->checkDniCreation();
		$this->checkDniModification();
		$this->checkActivo();
	}

	function checkId()
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

		if ($this->maxLength($this->descripcion, 500) === false) {
			fillAttributeException('DESCRIPCION_MAYOR_QUE_500');
		}

		if (!$this->checkSpaceLettersNumbers($this->descripcion)) {
			fillAttributeException('DESCRIPCION_FORMATO_INCORRECTO');
		}
	}

	function checkEmptyFormula()
	{

		if (!$this->isEmpty($this->formula) === true) {
			fillAttributeException('FORMULA_NO_VACIA');
		}
	}

	function checkFormula()
	{

		if ($this->isEmpty($this->formula) === true) {
			fillAttributeException('FORMULA_VACIA');
		}

		if ($this->minLength($this->formula, 3) === false) {
			fillAttributeException('FORMULA_MENOR_QUE_3');
		}

		if ($this->maxLength($this->formula, 500) === false) {
			fillAttributeException('FORMULA_MAYOR_QUE_500');
		}
	}

	function checkCreationDate()
	{
		if ($this->isEmpty($this->fecha_creacion) === true) {
			fillAttributeException('FECHA_CREACION_VACIA');
		}

		switch ($this->checkDateNumbersSlash($this->fecha_creacion)) {
			case 'formatofechamal':
				fillAttributeException('FECHA_CREACION_FORMATO_INCORRECTO');
				break;

			case 'tieneletras':
				fillAttributeException('FECHA_CREACION_SOLO_NUMEROS_Y_GUIONES');
				break;

			case 'tamañomenor10':
				fillAttributeException('FECHA_CREACION_MENOR_QUE_10');
				break;

			case 'tamañomayor10':
				fillAttributeException('FECHA_CREACION_MAYOR_QUE_10');
				break;

			case 'fechafutura':
				fillAttributeException('FECHA_CREACION_IMPOSIBLE');
				break;

			default:
				break;
		}
	}

	function checkModificationDate()
	{
		if (!empty($this->fecha_modificacion)) {
			switch ($this->checkDateNumbersSlash($this->fecha_modificacion)) {
				case 'formatofechamal':
					fillAttributeException('FECHA_MODIFICACION_FORMATO_INCORRECTO');
					break;

				case 'tieneletras':
					fillAttributeException('FECHA_MODIFICACION_SOLO_NUMEROS_Y_GUIONES');
					break;

				case 'tamañomenor10':
					fillAttributeException('FECHA_MODIFICACION_MENOR_QUE_10');
					break;

				case 'tamañomayor10':
					fillAttributeException('FECHA_MODIFICACION_MAYOR_QUE_10');
					break;

				case 'fechafutura':
					fillAttributeException('FECHA_MODIFICACION_IMPOSIBLE');
					break;

				default:
					break;
			}
		} else {
			fillAttributeException('FECHA_MODIFICACION_VACIA');
		}
	}

	function checkIdCategoria()
	{

		if ($this->isEmpty($this->id_categoria) === true) {
			fillAttributeException('PROCESO_ID_CATEGORIA_VACIO');
		}

		if (!$this->isNumeric($this->id_categoria) === true) {
			fillAttributeException('ID_CATEGORIA_ERROR_FORMATO');
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

	function checkActivo()
	{
		if ($this->isEmpty($this->activo) === true) {
			fillAttributeException('ACTIVO_VACIO');
		}

		if (!$this->isNumeric($this->activo) === true) {
			fillAttributeException('ACTIVO_ERROR_FORMATO');
		}
	}

	function checkIdSearch()
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

	function checkNameSearch()
	{
		if (!empty($this->nombre)) {
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
	}

	function checkDescriptionSearch()
	{
		if (!empty($this->descripcion)) {
			if ($this->minLength($this->descripcion, 3) === false) {
				fillAttributeException('DESCRIPCION_MENOR_QUE_3');
			}

			if ($this->maxLength($this->descripcion, 500) === false) {
				fillAttributeException('DESCRIPCION_MAYOR_QUE_500');
			}

			if (!$this->checkSpaceLettersNumbers($this->descripcion)) {
				fillAttributeException('DESCRIPCION_FORMATO_INCORRECTO');
			}
		}
	}

	function checkFormulaSearch()
	{
		if (!empty($this->formula)) {
			if ($this->minLength($this->formula, 3) === false) {
				fillAttributeException('FORMULA_MENOR_QUE_3');
			}

			if ($this->maxLength($this->formula, 500) === false) {
				fillAttributeException('FORMULA_MAYOR_QUE_500');
			}
		}
	}

	function checkCreationDateSearch()
	{
		if (!empty($this->fecha_creacion)) {
			switch ($this->checkDateNumbersSlash($this->fecha_creacion)) {
				case 'formatofechamal':
					fillAttributeException('FECHA_CREACION_FORMATO_INCORRECTO');
					break;

				case 'tieneletras':
					fillAttributeException('FECHA_CREACION_SOLO_NUMEROS_Y_GUIONES');
					break;

				case 'tamañomenor10':
					fillAttributeException('FECHA_CREACION_MENOR_QUE_10');
					break;

				case 'tamañomayor10':
					fillAttributeException('FECHA_CREACION_MAYOR_QUE_10');
					break;

				case 'fechafutura':
					fillAttributeException('FECHA_CREACION_IMPOSIBLE');
					break;

				default:
					break;
			}
		}
	}

	function checkModificationDateSearch()
	{
		if (!empty($this->fecha_modificacion)) {
			switch ($this->checkDateNumbersSlash($this->fecha_modificacion)) {
				case 'formatofechamal':
					fillAttributeException('FECHA_MODIFICACION_FORMATO_INCORRECTO');
					break;

				case 'tieneletras':
					fillAttributeException('FECHA_MODIFICACION_SOLO_NUMEROS_Y_GUIONES');
					break;

				case 'tamañomenor10':
					fillAttributeException('FECHA_MODIFICACION_MENOR_QUE_10');
					break;

				case 'tamañomayor10':
					fillAttributeException('FECHA_MODIFICACION_MAYOR_QUE_10');
					break;

				case 'fechafutura':
					fillAttributeException('FECHA_MODIFICACION_IMPOSIBLE');
					break;

				default:
					break;
			}
		}
	}

	function checkIdCategoriaSearch()
	{
		if (!empty($this->id_categoria)) {
			if (!$this->isNumeric($this->id_categoria) === true) {
				fillAttributeException('ID_CATEGORIA_ERROR_FORMATO');
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

	function checkActivoSearch()
	{
		if (!empty($this->activo)) {
			if (!$this->isNumeric($this->activo) === true) {
				fillAttributeException('ID_PROCESO_ERROR_FORMATO');
			}
		}
	}
}
