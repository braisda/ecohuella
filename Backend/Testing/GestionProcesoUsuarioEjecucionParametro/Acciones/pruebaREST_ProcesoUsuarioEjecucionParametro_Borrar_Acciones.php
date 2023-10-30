<?php

function pruebaREST_ProcesoUsuarioEjecucionParametro_Borrar_Acciones(){

	include_once './Testing/pruebaREST_class.php';

	$pruebas = new testRest();

    $tipo = 'Acción';
	$vaciarPost = NULL;

//---------------------------------------------------------------------------------------------------------------------

	//login correcto
	$POST = $vaciarPost;
	$POST['controller'] = 'auth';
	$POST['action'] = 'login';
	$POST['dni'] = '11111111H';
	$POST['password'] = '21232f297a57a5a743894a0e4a801fc3';

	$pruebas->peticionLogin($POST); 

    //Añadimos proceso usuario ejecucion previo
	$POST = $vaciarPost;
	$POST['controller'] = 'processUserExecution';
	$POST['action'] = 'add';
	$POST['id_proceso'] = '3';
	$POST['version'] = '1';
	$POST['dni_usuario_ejecucion'] = '11111111H';
    
    $pruebas->peticionCurlNoTest($POST);

    $POST = $vaciarPost;
	$POST['controller'] = 'processUserExecutionParameter';
	$POST['action'] = 'add';
	$POST['id_proceso'] = '3';
	$POST['version'] = '1';
	$POST['dni_usuario_ejecucion'] = '11111111H';
	$POST['id_parametro'] = '3';
	$POST['fecha_ejecucion'] = '2023-05-05';
	$POST['valor_parametro'] = 2.00;

    $pruebas->peticionCurlNoTest($POST);

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//BORRADO
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //ELIMINAR_PROCESO_USUARIO_EJECUCION_PARAMETRO_OK
    $POST = $vaciarPost;
    $POST['controller'] = 'processUserExecutionParameter';
    $POST['action'] = 'finalDelete';
    $POST['id_proceso'] = '3';
	$POST['version'] = '1';
	$POST['dni_usuario_ejecucion'] = '11111111H';

    $prueba = 'Borrado';
    $codeEsperado = 'ELIMINAR_PROCESS_USER_EXECUTION_PARAMETER_OK';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);


//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                                            //ERRORES_CATEGORIA
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //PROCESO_USUARIO_EJECUCION_NO_EXISTE
    $POST = $vaciarPost;
    $POST['controller'] = 'processUserExecution';
    $POST['action'] = 'finalDelete';
    $POST['id_proceso'] = '9999';
	$POST['version'] = '99';
	$POST['dni_usuario_ejecucion'] = '11111111H';

    $prueba = 'Proceso usuario ejecucion no existe';
    $codeEsperado = 'PROCESO_USUARIO_EJECUCION_NO_EXISTE';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //login incorrecto
    $POST = $vaciarPost;
    $POST['controller'] = 'auth';
    $POST['action'] = 'login';
    $POST['dni'] = '12345678Z';
    $POST['password'] = '21232f297a57a5a743894a0e4a801fc3';

    $pruebas->peticionLogin($POST);

    //PERMISOS_KO
    $POST = $vaciarPost;
    $POST['controller'] = 'processUserExecution';
    $POST['action'] = 'finalDelete';
    $POST['id_proceso'] = '5';
	$POST['version'] = '1';
	$POST['dni_usuario_ejecucion'] = '11111111H';

    $prueba = 'Solo el usuario básico puede eliminar un proceso usuario ejecucion del sistema.';
    $codeEsperado = 'PERMISOS_KO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

    
    $pruebas->peticionCurlNoTest($POST);

    //---------------------------------------------------------------------------------------------------------------------

    //login correcto
	$POST = $vaciarPost;
	$POST['controller'] = 'auth';
	$POST['action'] = 'login';
	$POST['dni'] = '11111111H';
	$POST['password'] = '21232f297a57a5a743894a0e4a801fc3';

	$pruebas->peticionLogin($POST);
    
    //borrado 
    $POST = $vaciarPost;
    $POST['controller'] = 'processUserExecution';
    $POST['action'] = 'finalDelete';
    $POST['id_proceso'] = '3';
    $POST['version'] = '1';
    $POST['dni_usuario_ejecucion'] = '11111111H';

    $pruebas->peticionCurlNoTest($POST);

	//borrado 
    $POST = $vaciarPost;
    $POST['controller'] = 'processUserExecutionParameter';
    $POST['action'] = 'finalDelete';
    $POST['id_proceso'] = '3';
    $POST['version'] = '1';
    $POST['dni_usuario_ejecucion'] = '11111111H';

    $pruebas->peticionCurlNoTest($POST);

//---------------------------------------------------------------------------------------------------------------------

    $pruebas->desconectarCurl($pruebas->cliente);

    return $pruebas->resultadoTest;

}
?>