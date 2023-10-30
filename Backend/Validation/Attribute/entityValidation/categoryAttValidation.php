<?php

class categoryAttValidation extends Validate {

    function validateSearchAttributes() {
		$this->checkIdSearch();
		$this->checkNameSearch();
		$this->checkDescriptionSearch();
	}

	function validateSearchByAttributes() {
		$this->checkId();
	}

	function validateAddAttributes() {
		$this->checkName();
		$this->checkDescription();
	}

	function validateEditAttributes() {
		$this->checkId();
		$this->checkName();
		$this->checkDescription();
	}

	function validateDeleteAttributes() {
		$this->checkId();
	}

	function checkId(){
		
		if($this->isEmpty($this->id_categoria)===true){
			fillAttributeException('ID_VACIO');
		}

		if(!$this->isNumeric($this->id_categoria)===true){
			fillAttributeException('ID_CATEGORIA_ERROR_FORMATO');
		}
	}

	function checkName(){

		if($this->isEmpty($this->nombre)===true){
			fillAttributeException('NOMBRE_VACIO');
		}

		if($this->minLength($this->nombre,3)===false){
			fillAttributeException('NOMBRE_MENOR_QUE_3');
		}

		if($this->maxLength($this->nombre,45)===false){
			fillAttributeException('NOMBRE_MAYOR_QUE_45');
		}

		if(!$this->checkSpaceLetters($this->nombre)){
			fillAttributeException('NOMBRE_FORMATO_INCORRECTO');
		}
	}

	function checkDescription(){

		if($this->isEmpty($this->descripcion)===true){
			fillAttributeException('DESCRIPCION_VACIA');
		}

		if($this->minLength($this->descripcion,3)===false){
			fillAttributeException('DESCRIPCION_MENOR_QUE_3');
		}

		if($this->maxLength($this->descripcion,500)===false){
			fillAttributeException('DESCRIPCION_MAYOR_QUE_500');
		}

		if(!$this->checkSpaceLetters($this->descripcion)){
			fillAttributeException('DESCRIPCION_FORMATO_INCORRECTO');
		}
	}

	function checkIdSearch(){
		if(!empty($this->id_categoria)){
			if(!$this->isNumeric($this->id_categoria)===true){
				fillAttributeException('ID_CATEGORIA_ERROR_FORMATO');
			}
		}
	}

	function checkNameSearch(){
		if(!empty($this->nombre)){
			if($this->maxLength($this->nombre,45)===false){
				fillAttributeException('NOMBRE_MAYOR_QUE_45');
			}

			if(!$this->checkSpaceLetters($this->nombre)){
				fillAttributeException('NOMBRE_FORMATO_INCORRECTO');
			}
		}
	}

	function checkDescriptionSearch(){
		if(!empty($this->descripcion)){
			if($this->maxLength($this->descripcion,500)===false){
				fillAttributeException('DESCRIPCION_MAYOR_QUE_500');
			}

			if(!$this->checkSpaceLetters($this->descripcion)){
				fillAttributeException('DESCRIPCION_FORMATO_INCORRECTO');
			}
		}
	}
	
}
?>