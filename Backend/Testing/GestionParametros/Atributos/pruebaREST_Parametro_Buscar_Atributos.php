<?php

function pruebaREST_Parametro_Buscar_Atributos(){

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
												//ERRORES_ATRIBUTO ID
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

   //ID_PARAMETRO_ERROR_FORMATO
   $POST = $vaciarPost;
   $POST['controller'] = 'parameter';
   $POST['action'] = 'search';
   $POST['id_parametro'] = '/&%$';

   $prueba = 'Id de parametro presenta un formato incorrecto';
   $codeEsperado = 'ID_PARAMETRO_ERROR_FORMATO';
   $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//ERRORES_ATRIBUTO NOMBRE
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //PARAMETRO_NOMBRE_MAYOR_QUE_45
    $POST = $vaciarPost;
    $POST['controller'] = 'parameter';
    $POST['action'] = 'search';
    $POST['id_parametro'] = '1';
    $POST['nombre'] = 'namenamename
    namenamenamenamenamenamenamename
    namenamenamenamenamenamenamenamenamename';
    
    $prueba = 'Nombre de la parametro no puede ser mayor que 45 caracteres';
    $codeEsperado = 'NOMBRE_MAYOR_QUE_45';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

   //PARAMETRO_NOMBRE_FORMATO_INCORRECTO
   $POST = $vaciarPost;
   $POST['controller'] = 'parameter';
   $POST['action'] = 'search';
   $POST['id_parametro'] = '1';
   $POST['nombre'] = 'nombre&';

   $prueba = 'Nombre de la parametro presenta un formato incorrecto, solo letras o números';
   $codeEsperado = 'NOMBRE_FORMATO_INCORRECTO';
   $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//ERRORES_ATRIBUTO DESCRIPCION
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //PARAMETRO_DESCRIPCION_MAYOR_QUE_500
    $POST = $vaciarPost;
    $POST['controller'] = 'parameter';
    $POST['action'] = 'search';
    $POST['id_parametro'] = '1';
    $POST['nombre'] = 'nombre';
    $POST['descripcion'] = 'descripcionparametrodescripcionparametro
    descripcionparametrodescripcionparametrodescripcionparametrodescripcionparametro
    descripcionparametrodescripcionparametrodescripcionparametrodescripcionparametro
    descripcionparametrodescripcionparametrodescripcionparametrodescripcionparametro
    descripcionparametrodescripcionparametrodescripcionparametrodescripcionparametro
    descripcionparametrodescripcionparametrodescripcionparametrodescripcionparametro
    descripcionparametrodescripcionparametrodescripcionparametrodescripcionparametro
    descripcionparametrodescripcionparametrodescripcionparametrodescripcionparametro
    descripcionparametrodescripcionparametrodescripcionparametrodescripcionparametro';
    
    $prueba = 'Descripción de la parametro no puede tener una descripción mayor a 500 caracteres';
    $codeEsperado = 'DESCRIPCION_MAYOR_QUE_500';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //PARAMETRO_DESCRIPCION_FORMATO_INCORRECTO
    $POST = $vaciarPost;
    $POST['controller'] = 'parameter';
    $POST['action'] = 'search';
    $POST['id_parametro'] = '1';
    $POST['nombre'] = 'nombre';
    $POST['descripcion'] = 'des&ripcion';

    $prueba = 'Descripción de la parametro presenta un formato incorrecto, solo letras o números';
    $codeEsperado = 'DESCRIPCION_FORMATO_INCORRECTO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);
	
//---------------------------------------------------------------------------------------------------------------------

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//ERRORES_ATRIBUTO UNIDAD
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

   //PARAMETRO_UNIDAD_MAYOR_QUE_48
   $POST['descripcion'] = 'descripcion';
   $POST['unidad'] = 'parametroTesttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttt';

   $prueba = 'Unidad de parametro mayor que 48';
   $codeEsperado = 'UNIDAD_MAYOR_QUE_45';
   $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);


//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                                                //ERRORES_ATRIBUTO DNI_CREACION
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //DNI_MENOR_QUE_9
    $POST['unidad'] = 'unidad';
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

    //PROCESO_CREADOR_DNI_MENOR_QUE_9
    $POST['dni_usuario_creacion'] = '62167251E';
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

    //ID_PROCESO_ERROR_FORMATO
    $POST['dni_usuario_modificacion'] = '62167251E';
    $POST['id_proceso'] = '1$';
    

    $prueba = 'Id de proceso presenta un formato incorrecto';
    $codeEsperado = 'ID_PROCESO_ERROR_FORMATO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

  //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//ERRORES_ATRIBUTO VERSION
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //VERSION_ERROR_FORMATO
    $POST['id_proceso'] = '1';
    $POST['version'] = '1$';
        
    
    $prueba = 'Version de proceso presenta un formato incorrecto';
    $codeEsperado = 'VERSION_ERROR_FORMATO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);


    //---------------------------------------------------------------------------------------------------------------------
	$pruebas->desconectarCurl($pruebas->cliente);

	return $pruebas->resultadoTest;

}

?>