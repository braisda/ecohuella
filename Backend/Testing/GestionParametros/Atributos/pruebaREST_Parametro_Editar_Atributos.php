<?php

function pruebaREST_Parametro_Editar_Atributos(){

	include_once './Testing/pruebaREST_class.php';

	$pruebas = new testRest();

    $tipo = 'Atributo';
	$vaciarPost = NULL;

//---------------------------------------------------------------------------------------------------------------------

	//login correcto
	$POST = $vaciarPost;
	$POST['controller'] = 'auth';
	$POST['action'] = 'login';
	$POST['dni'] = '62167251E';
	$POST['password'] = '21232f297a57a5a743894a0e4a801fc3';

	$pruebas->peticionLogin($POST);

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//ERRORES_ATRIBUTO ID_PARAMETRO
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //ID_PARAMETRO_VACIO
    $POST = $vaciarPost;
    $POST['controller'] = 'parameter';
    $POST['action'] = 'edit';
    $POST['id_parametro'] = '';

    $prueba = 'ID de parametro vacío';
    $codeEsperado = 'ID_VACIO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //ID_PARAMETRO_ERROR_FORMATO
    $POST = $vaciarPost;
    $POST['controller'] = 'parameter';
    $POST['action'] = 'edit';
    $POST['id_parametro'] = '/&%$';
    
    $prueba = 'Id de parametro presenta un formato incorrecto';
    $codeEsperado = 'ID_PARAMETRO_ERROR_FORMATO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);



//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//ERRORES_ATRIBUTO NOMBRE
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

   //PARAMETRO_NOMBRE_VACIO
   $POST['id_parametro'] = '1';
   $POST['nombre'] = '';
   

   $prueba = 'Nombre de parametro vacío';
   $codeEsperado = 'NOMBRE_VACIO';
   $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

   //PARAMETRO_NOMBRE_MENOR_QUE_3
   $POST['nombre'] = 'ro';

   $prueba = 'Nombre de parametro con nombre menor que 3';
   $codeEsperado = 'NOMBRE_MENOR_QUE_3';
   $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

   //PARAMETRO_NOMBRE_MAYOR_QUE_48
   $POST['nombre'] = 'parametroTesttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttt';

   $prueba = 'Nombre de parametro con nombre mayor que 48';
   $codeEsperado = 'NOMBRE_MAYOR_QUE_45';
   $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

   //PARAMETRO_NOMBRE_FORMATO_INCORRECTO
   $POST['nombre'] = 'parametro&est';

   $prueba = 'Nombre de parametro que contenga caracteres diferentes a números, letras y espacios';
   $codeEsperado = 'NOMBRE_FORMATO_INCORRECTO';
   $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//ERRORES_ATRIBUTO DESCRIPCION
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
   //PARAMETRO_NOMBRE_VACIO
   $POST['id_parametro'] = '1';
   $POST['nombre'] = 'nombre';
   $POST['descripcion'] = '';
   

   $prueba = 'Descripción de parametro vacío';
   $codeEsperado = 'DESCRIPCION_VACIA';
   $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//--------------------------------------------------------------------------------------------------------------------- 
    //PARAMETRO_DESCRIPCION_MENOR_QUE_3
    $POST['id_parametro'] = '1';
    $POST['descripcion'] = 'Ed';

    $prueba = 'Descripción de parametro menor que 3';
    $codeEsperado = 'DESCRIPCION_MENOR_QUE_3';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //PARAMETRO_DESCRIPCION_MAYOR_QUE_45
    $POST['descripcion'] = 'Iiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii';

    $prueba = 'Descripción de parametro mayor de 45';
    $codeEsperado = 'DESCRIPCION_MAYOR_QUE_45';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //PARAMETRO_DESCRIPCION_FORMATO_INCORRECTO
    $POST['descripcion'] = 'Descrpc#on';

    $prueba = 'Descripción de parametro con carcateres diferentes a números, letras y espacios en la descripcion';
    $codeEsperado = 'DESCRIPCION_FORMATO_INCORRECTO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//ERRORES_ATRIBUTO UNIDAD
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

   //PARAMETRO_UNIDAD_MAYOR_QUE_48
   $POST['descripcion'] = 'Descrpcion';
   $POST['unidad'] = 'parametroTesttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttt';

   $prueba = 'Unidad de parametro mayor que 48';
   $codeEsperado = 'UNIDAD_MAYOR_QUE_45';
   $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//ERRORES_ATRIBUTO DNI_MODIFICACION
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //PROCESO_MODIFICADOR_DNI_VACIO
    $POST['unidad'] = 'unidadTest';
    $POST['dni_usuario_modificacion'] = '';

    $prueba = 'DNI modificador vacío';
    $codeEsperado = 'DNI_VACIO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //PROCESO_MODIFICADOR_DNI_MENOR_QUE_9
    $POST['dni_usuario_modificacion'] = '11111111';

    $prueba = 'DNI modificador menor que 9';
    $codeEsperado = 'DNI_MENOR_QUE_9';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //PROCESO_MODIFICADOR_DNI_MAYOR_QUE_9
    $POST['dni_usuario_modificacion'] = '11111111HH';

    $prueba = 'DNI modificador mayor que 9';
    $codeEsperado = 'DNI_MAYOR_QUE_9';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //PROCESO_MODIFICADOR_DNI_FORMATO_INCORRECTO
    $POST['dni_usuario_modificacion'] = '1234 5678';

	$prueba = 'El dni modificador no puede contener más que letras y números, no se aceptan caracteres en blanco, ñ, acentos o carcateres especiales.';
	$codeEsperado = 'DNI_FORMATO_INCORRECTO';
	$pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

	//PROCESO_MODIFICADOR_DNI_LETRA_INCORRECTA
	$POST['dni_usuario_modificacion'] = '12345678A';

	$prueba = 'El dni de usuario debe ser real.';
	$codeEsperado = 'DNI_LETRA_INCORRECTA';

//---------------------------------------------------------------------------------------------------------------------

   //PARAMETRO_UNIDAD_FORMATO_INCORRECTO
   $POST['unidad'] = 'parametro&est';

   $prueba = 'Unidad de parametro que contenga caracteres diferentes a números, letras y espacios';
   $codeEsperado = 'UNIDAD_FORMATO_INCORRECTO';
   $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);
   
//---------------------------------------------------------------------------------------------------------------------
	$pruebas->desconectarCurl($pruebas->cliente);

	return $pruebas->resultadoTest;

}

?>