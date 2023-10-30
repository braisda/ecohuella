<?php

function pruebaREST_Parametro_Insertar_Atributos(){

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
												//ERRORES_ATRIBUTO NOMBRE
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

   //PARAMETRO_NOMBRE_VACIO
   $POST = $vaciarPost;
   $POST['controller'] = 'parameter';
   $POST['action'] = 'add';
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

   //PARAMETRO_DESCRIPCION_VACIO
   $POST = $vaciarPost;
   $POST['nombre'] = 'nombreTest';
   $POST['controller'] = 'parameter';
   $POST['action'] = 'add';
   $POST['descripcion'] = '';
   

   $prueba = 'Descripcion de parametro vacío';
   $codeEsperado = 'DESCRIPCION_VACIA';
   $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

   //PARAMETRO_DESCRIPCION_MENOR_QUE_3
   $POST['descripcion'] = 'ro';

   $prueba = 'Descripcion menor que 3';
   $codeEsperado = 'DESCRIPCION_MENOR_QUE_3';
   $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

   //PARAMETRO_DESCRIPCION_MAYOR_QUE_45
   $POST['descripcion'] = 'parametroTesttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttt';

   $prueba = 'Descripcion mayor que 45';
   $codeEsperado = 'DESCRIPCION_MAYOR_QUE_45';
   $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

   //PARAMETRO_DESCRIPCION_FORMATO_INCORRECTO
   $POST['descripcion'] = 'parametro&est';

   $prueba = 'Descripcion de parametro que contenga caracteres diferentes a números, letras y espacios';
   $codeEsperado = 'DESCRIPCION_FORMATO_INCORRECTO';
   $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);


//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//ERRORES_ATRIBUTO UNIDAD
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

   //PARAMETRO_UNIDAD_VACIO
   $POST = $vaciarPost;
   $POST['nombre'] = 'nombreTest';
   $POST['descripcion'] = 'descripcionTest';
   $POST['controller'] = 'parameter';
   $POST['action'] = 'add';
   $POST['unidad'] = '';
   

   $prueba = 'Unidad de parametro vacío';
   $codeEsperado = 'UNIDAD_VACIO';
   $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

   //PARAMETRO_DESCRIPCION_MAYOR_QUE_45
   $POST['unidad'] = 'parametroTesttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttt';

   $prueba = 'Unidad mayor que 45';
   $codeEsperado = 'UNIDAD_MAYOR_QUE_45';
   $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

   //PARAMETRO_UNIDAD_FORMATO_INCORRECTO
   $POST['unidad'] = 'parametro&est';

   $prueba = 'Unidad de parametro que contenga caracteres diferentes a números, letras y espacios';
   $codeEsperado = 'UNIDAD_FORMATO_INCORRECTO';
   $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);


//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//ERRORES_ATRIBUTO DNI_CREACION
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //PROCESO_CREADOR_DNI_VACIO
    $POST['unidad'] = 'unidadTest';
    $POST['dni_usuario_creacion'] = '';

    $prueba = 'DNI creador vacío';
    $codeEsperado = 'DNI_VACIO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //PROCESO_CREADOR_DNI_MENOR_QUE_9
    $POST['dni_usuario_creacion'] = '11111111';

    $prueba = 'DNI creador menor que 9';
    $codeEsperado = 'DNI_MENOR_QUE_9';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //PROCESO_CREADOR_DNI_MAYOR_QUE_9
    $POST['dni_usuario_creacion'] = '11111111HH';

    $prueba = 'DNI creador mayor que 9';
    $codeEsperado = 'DNI_MAYOR_QUE_9';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //PROCESO_CREADOR_DNI_FORMATO_INCORRECTO
    $POST['dni_usuario_creacion'] = '1234 5678';

	$prueba = 'El dni de usuario no puede contener más que letras y números, no se aceptan caracteres en blanco, ñ, acentos o carcateres especiales.';
	$codeEsperado = 'DNI_FORMATO_INCORRECTO';
	$pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

	//PROCESO_CREADORDNI_LETRA_INCORRECTA
	$POST['dni_usuario_creacion'] = '12345678A';

	$prueba = 'El dni de usuario debe ser real.';
	$codeEsperado = 'DNI_LETRA_INCORRECTA';

//---------------------------------------------------------------------------------------------------------------------

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//ERRORES_ATRIBUTO DNI_MODIFICACION
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //PROCESO_CREADOR_DNI_VACIO
    $POST['dni_usuario_creacion'] = '62167251E';
    $POST['dni_usuario_modificacion'] = '';

    $prueba = 'DNI modificador vacío';
    $codeEsperado = 'DNI_VACIO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //PROCESO_CREADOR_DNI_MENOR_QUE_9
    $POST['dni_usuario_modificacion'] = '11111111';

    $prueba = 'DNI modificador menor que 9';
    $codeEsperado = 'DNI_MENOR_QUE_9';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //PROCESO_CREADOR_DNI_MAYOR_QUE_9
    $POST['dni_usuario_modificacion'] = '11111111HH';

    $prueba = 'DNI modificador mayor que 9';
    $codeEsperado = 'DNI_MAYOR_QUE_9';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //PROCESO_CREADOR_DNI_FORMATO_INCORRECTO
    $POST['dni_usuario_modificacion'] = '1234 5678';

	$prueba = 'El dni modificador no puede contener más que letras y números, no se aceptan caracteres en blanco, ñ, acentos o carcateres especiales.';
	$codeEsperado = 'DNI_FORMATO_INCORRECTO';
	$pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

	//PROCESO_CREADORDNI_LETRA_INCORRECTA
	$POST['dni_usuario_modificacion'] = '12345678A';

	$prueba = 'El dni de usuario debe ser real.';
	$codeEsperado = 'DNI_LETRA_INCORRECTA';

//---------------------------------------------------------------------------------------------------------------------

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//ERRORES_ATRIBUTO ID_PROCESO
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

   //ID_PROCESO_VACIO 
   $POST['dni_usuario_modificacion'] = '62167251E';
   $POST['id_proceso'] = '';
   

   $prueba = 'Id de proceso vacío';
   $codeEsperado = 'ID_VACIO';
   $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //ID_PROCESO_ERROR_FORMATO
    $POST['id_proceso'] = '1$';
    

    $prueba = 'Id de proceso presenta un formato incorrecto';
    $codeEsperado = 'ID_PROCESO_ERROR_FORMATO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

  //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//ERRORES_ATRIBUTO VERSION
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //VERSION_PROCESO_VACIO
    $POST['id_proceso'] = '1';
    $POST['version'] = '';
   

    $prueba = 'Version de proceso vacío';
    $codeEsperado = 'VERSION_VACIO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

    //VERSION_ERROR_FORMATO
    $POST['version'] = '1$';
        
    
    $prueba = 'Version de proceso presenta un formato incorrecto';
    $codeEsperado = 'VERSION_ERROR_FORMATO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

	$pruebas->desconectarCurl($pruebas->cliente);

	return $pruebas->resultadoTest;

}

?>