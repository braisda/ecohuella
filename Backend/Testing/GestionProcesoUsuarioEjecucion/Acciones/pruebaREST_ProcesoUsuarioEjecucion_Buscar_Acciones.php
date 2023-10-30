<?php

function pruebaREST_ProcesoUsuarioEjecucion_Buscar_Acciones(){

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

    //Añadimos proceso usuario ejecucion previo
	$POST = $vaciarPost;
	$POST = $vaciarPost;
	$POST['controller'] = 'processUserExecution';
	$POST['action'] = 'add';
	$POST['id_proceso'] = '3';
	$POST['version'] = '1';
	$POST['dni_usuario_ejecucion'] = '11111111H';
    
    $pruebas->peticionCurlNoTest($POST);

    //RECORDSET_DATOS
    $POST = $vaciarPost;
    $POST['controller'] = 'processUserExecution';
    $POST['action'] = 'search';

    $prueba = 'Buscar proceso usuario ejecucion';
    $codeEsperado = 'RECORDSET_DATOS';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //RECORDSET_VACIO
    $POST['id_proceso'] = 999999;
    $POST['version'] = 999999;
    $POST['dni_usuario_ejecucion'] = "11111111H";

    $prueba = 'Buscar proceso usuario ejecucion que no existe en el sistema';
    $codeEsperado = 'RECORDSET_VACIO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //Eliminamos proceso usuario ejecucion añadido previamente
    $POST = $vaciarPost;
    $POST['controller'] = 'processUserExecution';
    $POST['action'] = 'finalDelete';
    $POST['id_proceso'] = '3';
    $POST['version'] = '1';
    $POST['dni_usuario_ejecucion'] = '11111111H';

//---------------------------------------------------------------------------------------------------------------------

    $pruebas->peticionCurlNoTest($POST);
    $pruebas->desconectarCurl($pruebas->cliente);

    return $pruebas->resultadoTest;

}
?>