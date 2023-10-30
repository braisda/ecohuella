<?php

function pruebaREST_ProcesoUsuarioEjecucion_Borrar_Acciones(){

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

    //insertar PROCESO_USUARIO_EJECUCION
    $POST = $vaciarPost;
    $POST['controller'] = 'processUserExecution';
    $POST['action'] = 'add';
    $POST['id_proceso'] = '5';
    $POST['version'] = '1';
    $POST['dni_usuario_ejecucion'] = '11111111H';

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//BORRADO
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //ELIMINAR_PROCESO_USUARIO_EJECUCION_OK
    $POST = $vaciarPost;
    $POST['controller'] = 'processUserExecution';
    $POST['action'] = 'finalDelete';
    $POST['id_proceso'] = '3';
	$POST['version'] = '1';
	$POST['dni_usuario_ejecucion'] = '11111111H';

    $prueba = 'Borrado';
    $codeEsperado = 'ELIMINAR_PROCESS_USER_EXECUTION_OK';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);


//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                                            //ERRORES_CATEGORIA
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //PROCESO_USUARIO_EJECUCION_NO_EXISTE
    $POST = $vaciarPost;
    $POST['controller'] = 'processUserExecution';
    $POST['action'] = 'finalDelete';
    $POST['id_proceso'] = '3';
	$POST['version'] = '1';
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
    $POST['id_proceso'] = '5';
	$POST['version'] = '1';
	$POST['dni_usuario_ejecucion'] = '11111111H';

    $pruebas->peticionCurlNoTest($POST);

//---------------------------------------------------------------------------------------------------------------------

    $pruebas->desconectarCurl($pruebas->cliente);

    return $pruebas->resultadoTest;

}
?>