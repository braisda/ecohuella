<?php

class notificationAttValidation extends Validate
{

	function validateSearchAttributes()
	{
		$this->checkIdSearch();
		$this->checkTitleSearch();
		$this->checkBodySearch();
		$this->checkDateSearch();
		$this->checkReadedSearch();
		$this->checkDniSenderSearch();
		$this->checkDniReceiverSearch();
	}

	function validateSearchByAttributes()
	{
		$this->checkId();
	}

	function validateAddAttributes()
	{
		$this->checkTitle();
		$this->checkBody();
		$this->checkDate();
		$this->checkReaded();
		$this->checkDniSender();
		$this->checkDniReceiver();
	}

	function validateEditAttributes()
	{
		$this->checkId();
		$this->checkReaded();
	}

	function validateDeleteAttributes()
	{
		$this->checkId();
	}

	function checkId()
	{
		if ($this->isEmpty($this->id_notificacion) === true) {
			fillAttributeException('ID_VACIO');
		}

		if (!$this->isNumeric($this->id_notificacion) === true) {
			fillAttributeException('ID_NOTIFICACION_ERROR_FORMATO');
		}
	}

	function checkTitle()
	{

		if ($this->isEmpty($this->titulo) === true) {
			fillAttributeException('TITULO_VACIO');
		}

		if ($this->minLength($this->titulo, 3) === false) {
			fillAttributeException('TITULO_MENOR_QUE_3');
		}

		if ($this->maxLength($this->titulo, 45) === false) {
			fillAttributeException('TITULO_MAYOR_QUE_45');
		}

		if (!$this->checkSpaceLettersNumbers($this->titulo)) {
			fillAttributeException('TITULO_FORMATO_INCORRECTO');
		}
	}

	function checkBody()
	{

		if ($this->isEmpty($this->cuerpo) === true) {
			fillAttributeException('CUERPO_VACIA');
		}

		if ($this->minLength($this->cuerpo, 3) === false) {
			fillAttributeException('CUERPO_MENOR_QUE_3');
		}

		if ($this->maxLength($this->cuerpo, 500) === false) {
			fillAttributeException('CUERPO_MAYOR_QUE_500');
		}

		if (!$this->checkSpaceLettersNumbers($this->cuerpo)) {
			fillAttributeException('CUERPO_FORMATO_INCORRECTO');
		}
	}

	function checkDate()
	{
		if (!empty($this->fecha)) {
			switch ($this->checkDateNumbersSlash($this->fecha)) {
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

	function checkReaded()
	{
		if ($this->isEmpty($this->leida) === true) {
			fillAttributeException('NOTIFICACION_LEIDA_VACIO');
		}

		if (!$this->isNumeric($this->leida) === true) {
			fillAttributeException('NOTIFICACION_LEIDA_ERROR_FORMATO');
		}
	}

	function checkDniSender()
	{
		if ($this->isEmpty($this->dni_usuario_remitente) === true) {
			fillAttributeException('DNI_VACIO');
		}

		if ($this->minLength($this->dni_usuario_remitente, 9) === false) {
			fillAttributeException('DNI_MENOR_QUE_9');
		}

		if ($this->maxLength($this->dni_usuario_remitente, 9) === false) {
			fillAttributeException('DNI_MAYOR_QUE_9');
		}

		if (!$this->dniFormat($this->dni_usuario_remitente)) {
			fillAttributeException('DNI_FORMATO_INCORRECTO');
		}

		if ($this->nifLetter($this->dni_usuario_remitente) === false) {
			fillAttributeException('DNI_LETRA_INCORRECTA');
		}
	}

	function checkDniReceiver()
	{
		if ($this->isEmpty($this->dni_usuario_destinatario) === true) {
			fillAttributeException('DNI_VACIO');
		}

		if ($this->minLength($this->dni_usuario_destinatario, 9) === false) {
			fillAttributeException('DNI_MENOR_QUE_9');
		}

		if ($this->maxLength($this->dni_usuario_destinatario, 9) === false) {
			fillAttributeException('DNI_MAYOR_QUE_9');
		}

		if (!$this->dniFormat($this->dni_usuario_destinatario)) {
			fillAttributeException('DNI_FORMATO_INCORRECTO');
		}

		if ($this->nifLetter($this->dni_usuario_destinatario) === false) {
			fillAttributeException('DNI_LETRA_INCORRECTA');
		}
	}

	function checkIdSearch()
	{
		if (!empty($this->id_notificacion)) {
			if (!$this->isNumeric($this->id_notificacion) === true) {
				fillAttributeException('ID_NOTIFICACION_ERROR_FORMATO');
			}
		}
	}

	function checkTitleSearch()
	{
		if (!empty($this->titulo)) {
			if ($this->maxLength($this->titulo, 45) === false) {
				fillAttributeException('TITULO_MAYOR_QUE_45');
			}

			if (!$this->checkSpaceLettersNumbers($this->titulo)) {
				fillAttributeException('TITULO_FORMATO_INCORRECTO');
			}
		}
	}

	function checkBodySearch()
	{
		if (!empty($this->cuerpo)) {
			if ($this->maxLength($this->cuerpo, 500) === false) {
				fillAttributeException('CUERPO_MAYOR_QUE_500');
			}

			if (!$this->checkSpaceLettersNumbers($this->cuerpo)) {
				fillAttributeException('CUERPO_FORMATO_INCORRECTO');
			}
		}
	}

	function checkDateSearch()
	{
		if (!empty($this->fecha)) {
			switch ($this->checkDateNumbersSlash($this->fecha)) {
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

	function checkReadedSearch()
	{
		if (!empty($this->leida)) {
			if (!$this->isNumeric($this->leida) === true) {
				fillAttributeException('NOTIFICACION_LEIDA_ERROR_FORMATO');
			}
		}
	}

	function checkDniSenderSearch()
	{
		if (!empty($this->dni_usuario_remitente)) {
			if ($this->minLength($this->dni_usuario_remitente, 9) === false) {
				fillAttributeException('DNI_MENOR_QUE_9');
			}

			if ($this->maxLength($this->dni_usuario_remitente, 9) === false) {
				fillAttributeException('DNI_MAYOR_QUE_9');
			}

			if (!$this->dniFormat($this->dni_usuario_remitente)) {
				fillAttributeException('DNI_FORMATO_INCORRECTO');
			}

			if ($this->nifLetter($this->dni_usuario_remitente) === false) {
				fillAttributeException('DNI_LETRA_INCORRECTA');
			}
		}
	}

	function checkDniReceiverSearch()
	{
		if (!empty($this->dni_usuario_destinatario)) {
			if ($this->minLength($this->dni_usuario_destinatario, 9) === false) {
				fillAttributeException('DNI_MENOR_QUE_9');
			}

			if ($this->maxLength($this->dni_usuario_destinatario, 9) === false) {
				fillAttributeException('DNI_MAYOR_QUE_9');
			}

			if (!$this->dniFormat($this->dni_usuario_destinatario)) {
				fillAttributeException('DNI_FORMATO_INCORRECTO');
			}

			if ($this->nifLetter($this->dni_usuario_destinatario) === false) {
				fillAttributeException('DNI_LETRA_INCORRECTA');
			}
		}
	}
}
