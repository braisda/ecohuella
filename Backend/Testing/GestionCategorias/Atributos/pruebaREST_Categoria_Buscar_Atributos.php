<?php

function pruebaREST_Categoria_Buscar_Atributos(){

	include_once './Testing/pruebaREST_class.php';

	$pruebas = new testRest();

    $tipo = 'Atributo';
	$vaciarPost = NULL;

//---------------------------------------------------------------------------------------------------------------------

	//login correcto
	$POST = $vaciarPost;
	$POST['controller'] = 'auth';
	$POST['action'] = 'login';
	$POST['dni'] = '14488423X';
	$POST['password'] = '21232f297a57a5a743894a0e4a801fc3';

	$pruebas->peticionLogin($POST);

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//ERRORES_ATRIBUTO ID
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

   //ID_CATEGORIA_ERROR_FORMATO
   $POST = $vaciarPost;
   $POST['controller'] = 'category';
   $POST['action'] = 'search';
   $POST['id_categoria'] = '/&%$';

   $prueba = 'Id de categoria presenta un formato incorrecto';
   $codeEsperado = 'ID_CATEGORIA_ERROR_FORMATO';
   $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//ERRORES_ATRIBUTO NOMBRE
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //CATEGORIA_NOMBRE_MAYOR_QUE_45
    $POST = $vaciarPost;
    $POST['controller'] = 'category';
    $POST['action'] = 'search';
    $POST['id_categoria'] = '1';
    $POST['nombre'] = 'namenamename
    namenamenamenamenamenamenamename
    namenamenamenamenamenamenamenamenamename';
    
    $prueba = 'Nombre de la categoria no puede ser mayor que 45 caracteres';
    $codeEsperado = 'NOMBRE_MAYOR_QUE_45';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

   //CATEGORIA_NOMBRE_FORMATO_INCORRECTO
   $POST = $vaciarPost;
   $POST['controller'] = 'category';
   $POST['action'] = 'search';
   $POST['id_categoria'] = '1';
   $POST['nombre'] = 'nombre&';

   $prueba = 'Nombre de la categoria presenta un formato incorrecto, solo letras o números';
   $codeEsperado = 'NOMBRE_FORMATO_INCORRECTO';
   $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//ERRORES_ATRIBUTO DESCRIPCION
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //CATEGORIA_DESCRIPCION_MAYOR_QUE_500
    $POST = $vaciarPost;
    $POST['controller'] = 'category';
    $POST['action'] = 'search';
    $POST['id_categoria'] = '1';
    $POST['nombre'] = 'nombre';
    $POST['descripcion'] = 'descripcioncategoriadescripcioncategoria
    descripcioncategoriadescripcioncategoriadescripcioncategoriadescripcioncategoria
    descripcioncategoriadescripcioncategoriadescripcioncategoriadescripcioncategoria
    descripcioncategoriadescripcioncategoriadescripcioncategoriadescripcioncategoria
    descripcioncategoriadescripcioncategoriadescripcioncategoriadescripcioncategoria
    descripcioncategoriadescripcioncategoriadescripcioncategoriadescripcioncategoria
    descripcioncategoriadescripcioncategoriadescripcioncategoriadescripcioncategoria
    descripcioncategoriadescripcioncategoriadescripcioncategoriadescripcioncategoria
    descripcioncategoriadescripcioncategoriadescripcioncategoriadescripcioncategoria';
    
    $prueba = 'Descripción de la categoria no puede tener una descripción mayor a 500 caracteres';
    $codeEsperado = 'DESCRIPCION_MAYOR_QUE_500';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //CATEGORIA_DESCRIPCION_FORMATO_INCORRECTO
    $POST = $vaciarPost;
    $POST['controller'] = 'category';
    $POST['action'] = 'search';
    $POST['id_categoria'] = '1';
    $POST['nombre'] = 'nombre';
    $POST['descripcion'] = 'des&ripcion';

    $prueba = 'Descripción de la categoria presenta un formato incorrecto, solo letras o números';
    $codeEsperado = 'DESCRIPCION_FORMATO_INCORRECTO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);
	
//---------------------------------------------------------------------------------------------------------------------

	$pruebas->desconectarCurl($pruebas->cliente);

	return $pruebas->resultadoTest;

}

?>