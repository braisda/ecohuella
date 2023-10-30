<?php

function pruebaREST_ProcesoUsuarioEjecucionParametro_Insertar_Atributos(){

	include_once './Testing/pruebaREST_class.php';

	$pruebas = new testRest();

    $tipo = 'Atributo';
	$vaciarPost = NULL;

//---------------------------------------------------------------------------------------------------------------------

	//login correcto
	$POST = $vaciarPost;
	$POST['controller'] = 'auth';
	$POST['action'] = 'login';
	$POST['dni'] = '11111111H';
	$POST['password'] = '21232f297a57a5a743894a0e4a801fc3';

	$pruebas->peticionLogin($POST);

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//ERRORES_ATRIBUTO ID_PROCESO
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //ID_PROCESO_VACIO
    $POST = $vaciarPost;
    $POST['controller'] = 'processUserExecutionParameter';
    $POST['action'] = 'add';
    $POST['id_proceso'] = '';


    $prueba = 'Id de proceso vacío';
    $codeEsperado = 'ID_PROCESO_VACIO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

    //---------------------------------------------------------------------------------------------------------------------

    //ID_PROCESO_ERROR_FORMATO
    $POST = $vaciarPost;
    $POST['controller'] = 'processUserExecutionParameter';
    $POST['action'] = 'add';
    $POST['id_proceso'] = '1$';

    $prueba = 'Id de proceso presenta un formato incorrecto';
    $codeEsperado = 'ID_PROCESO_ERROR_FORMATO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

    //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                                                //ERRORES_ATRIBUTO VERSION
    //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //VERSION_VACIO
    $POST = $vaciarPost;
    $POST['controller'] = 'processUserExecutionParameter';
    $POST['action'] = 'add';
    $POST['id_proceso'] = '1';
    $POST['version'] = '';

    $prueba = 'Version de proceso vacío';
    $codeEsperado = 'VERSION_VACIO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

    //---------------------------------------------------------------------------------------------------------------------

    //VERSION_ERROR_FORMATO
    $POST = $vaciarPost;
    $POST['controller'] = 'processUserExecutionParameter';
    $POST['action'] = 'add';
    $POST['id_proceso'] = '1';
    $POST['version'] = '0$';

    $prueba = 'Version presenta un formato incorrecto';
    $codeEsperado = 'VERSION_ERROR_FORMATO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);


    //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//ERRORES_ATRIBUTO ID_PARAMETRO
    //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
    $POST['id_proceso'] = '1';
    $POST['version'] = '1';

    //ID_PARAMETRO__VACIO
    $POST['id_parametro'] = '';

    $prueba = 'Id de parametro vacío';
    $codeEsperado = 'ID_PARAMETRO_VACIO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);
        
    //ID_PARAMETRO_ERROR_FORMATO
    $POST['id_parametro'] = '1$';

    $prueba = 'El id del parametro presenta un formato incorrecto.';
    $codeEsperado = 'ID_PARAMETRO_ERROR_FORMATO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);


    //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                                                //ERRORES_ATRIBUTO DNI_EJECUCION
    //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //PROCESO_EJECUCION_DNI_VACIO
    $POST['id_parametro'] = '4';
    $POST['dni_usuario_ejecucion'] = '';

    $prueba = 'DNI creador vacío';
    $codeEsperado = 'DNI_VACIO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

    //---------------------------------------------------------------------------------------------------------------------

    //PROCESO_EJECUCION_DNI_MENOR_QUE_9
    $POST['dni_usuario_ejecucion'] = '11111111';

    $prueba = 'DNI creador menor que 9';
    $codeEsperado = 'DNI_MENOR_QUE_9';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

    //---------------------------------------------------------------------------------------------------------------------

    //PROCESO_EJECUCION_DNI_MAYOR_QUE_9
    $POST['dni_usuario_ejecucion'] = '11111111HH';

    $prueba = 'DNI creador mayor que 9';
    $codeEsperado = 'DNI_MAYOR_QUE_9';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

    //---------------------------------------------------------------------------------------------------------------------

    //PROCESO_EJECUCION_DNI_FORMATO_INCORRECTO
    $POST['dni_usuario_ejecucion'] = '1234 5678';

    $prueba = 'El dni de usuario no puede contener más que letras y números, no se aceptan caracteres en blanco, ñ, acentos o carcateres especiales.';
    $codeEsperado = 'DNI_FORMATO_INCORRECTO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

    //---------------------------------------------------------------------------------------------------------------------

    //PROCESO_EJECUCION_DNI_LETRA_INCORRECTA
    $POST['dni_usuario_ejecucion'] = '12345678A';

    $prueba = 'El dni de usuario debe ser real.';
    $codeEsperado = 'DNI_LETRA_INCORRECTA';


    //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//ERRORES_ATRIBUTO VALOR_PARAMETRO
    //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
    $POST['dni_usuario_ejecucion'] = '11111111H';
    $POST['fecha_ejecucion'] = '2020-01-01';

    //VALOR_MAYOR_QUE_9
    $POST['valor_parametro'] = '111111111111';

    $prueba = 'El valor del parámetro no puede ser mayor que 9.';
    $codeEsperado = 'VALOR_MAYOR_QUE_9';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------


	$pruebas->desconectarCurl($pruebas->cliente);

	return $pruebas->resultadoTest;

}

?>