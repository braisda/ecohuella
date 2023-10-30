<?php

function pruebaREST_ProcesoUsuarioEjecucionParametro_Editar_Acciones(){

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

//---------------------------------------------------------------------------------------------------------------------

    //insertar PROCESO_USUARIO_EJECUCION
	$POST = $vaciarPost;
	$POST['controller'] = 'processUserExecution';
	$POST['action'] = 'add';
	$POST['id_proceso'] = '3';
	$POST['version'] = '1';
	$POST['dni_usuario_ejecucion'] = '11111111H';
    
    $pruebas->peticionCurlNoTest($POST);

    //insertar PROCESO_USUARIO_EJECUCION_PARAMETRO
    $POST = $vaciarPost;
    $POST['controller'] = 'processUserExecutionParameter';
    $POST['action'] = 'add';
    $POST['id_proceso'] = '3';
    $POST['version'] = '1';
    $POST['dni_usuario_ejecucion'] = '11111111H';
    $POST['id_parametro'] = '3';
    $POST['fecha_ejecucion'] = '2020-05-05';
	$POST['valor_parametro'] = '24';

    $pruebas->peticionCurlNoTest($POST);


//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                                            //ERRORES_PROCESO_USUARIO_EJECUCION
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //PROCESO_USUARIO_EJECUCION_NO_EXISTE
    $POST = $vaciarPost;
    $POST['controller'] = 'processUserExecutionParameter';
    $POST['action'] = 'edit';
    $POST['id_proceso'] = '2';
	$POST['version'] = '1';
	$POST['dni_usuario_ejecucion'] = '11111111H';
    $POST['id_parametro'] = '3';
    $POST['fecha_ejecucion'] = '2020-05-05';
	$POST['valor_parametro'] = '42';

    $prueba = 'Proceso usuario ejecucion no existe';
    $codeEsperado = 'PROCESO_USUARIO_EJECUCION_PARAMETRO_NO_EXISTE';
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
    $POST['controller'] = 'processUserExecutionParameter';
    $POST['action'] = 'edit';
    $POST['id_proceso'] = '3';
	$POST['version'] = '1';
	$POST['dni_usuario_ejecucion'] = '11111111H';
    $POST['id_parametro'] = '3';
    $POST['fecha_ejecucion'] = '2020-05-05';
	$POST['valor_parametro'] = '24';

    $prueba = 'Solo el usuario básico puede eliminar un proceso usuario ejecucion del sistema.';
    $codeEsperado = 'PERMISOS_KO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

    
    $pruebas->peticionCurlNoTest($POST);

    //login correcto
	$POST = $vaciarPost;
	$POST['controller'] = 'auth';
	$POST['action'] = 'login';
	$POST['dni'] = '11111111H';
	$POST['password'] = '21232f297a57a5a743894a0e4a801fc3';

	$pruebas->peticionLogin($POST);
    
    //borrado
    $POST = $vaciarPost;
    $POST['controller'] = 'processuserExecutionParameter';
    $POST['action'] = 'finalDelete';
    $POST['id_proceso'] = '3';
	$POST['version'] = '1';
	$POST['dni_usuario_ejecucion'] = '11111111H';
    $POST['id_parametro'] = '3';

    $pruebas->peticionCurlNoTest($POST);

    //borrado
    $POST = $vaciarPost;
    $POST['controller'] = 'processUserExecution';
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