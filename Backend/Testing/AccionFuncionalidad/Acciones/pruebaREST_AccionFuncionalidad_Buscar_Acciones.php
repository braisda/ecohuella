<?php

function pruebaREST_AccionFuncionalidad_Buscar_Acciones(){

	include_once './Testing/pruebaREST_class.php';

	$pruebas = new testRest();

    $tipo = 'Acción';
	$vaciarPost = NULL;

//---------------------------------------------------------------------------------------------------------------------

	//login correcto
	$POST = $vaciarPost;
	$POST['controller'] = 'auth';
	$POST['action'] = 'login';
	$POST['dni'] = '12345678Z';
	$POST['password'] = '21232f297a57a5a743894a0e4a801fc3';

	$pruebas->peticionLogin($POST);

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//ERRORES_ACCION
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    // RECORDSET_DATOS
    $POST = $vaciarPost;
    $POST['controller'] = 'actionFunctionality';
    $POST['action'] = 'search';

    $prueba = 'Buscar todas las acción-funcionalidad correctamente.';
    $codeEsperado = 'RECORDSET_DATOS';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    // RECORDSET_DATOS
    $POST = $vaciarPost;
    $POST['controller'] = 'actionFunctionality';
    $POST['action'] = 'search';
    $POST['id_accion'] = '1';
	$POST['id_funcionalidad'] = '1';

    $prueba = 'Buscar acción-funcionalidad correctamente.';
    $codeEsperado = 'RECORDSET_DATOS';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

    //---------------------------------------------------------------------------------------------------------------------

    // RECORDSET_DATOS
    $POST = $vaciarPost;
    $POST['controller'] = 'actionFunctionality';
    $POST['action'] = 'search';
    $POST['id_accion'] = '1';

    $prueba = 'Buscar acción-funcionalidad con acción pero sin funcionalidad correctamente.';
    $codeEsperado = 'RECORDSET_DATOS';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

    //---------------------------------------------------------------------------------------------------------------------

    // RECORDSET_DATOS
    $POST = $vaciarPost;
    $POST['controller'] = 'actionFunctionality';
    $POST['action'] = 'search';
	$POST['id_funcionalidad'] = '1';

    $prueba = 'Buscar acción-funcionalidad con funcionalidad pero sin acción correctamente.';
    $codeEsperado = 'RECORDSET_DATOS';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

    //---------------------------------------------------------------------------------------------------------------------


	//RECORDSET_VACIO
	$POST = $vaciarPost;
	$POST['controller'] = 'actionFunctionality';
	$POST['action'] = 'search';
	$POST['id_accion'] = '106';
	$POST['id_funcionalidad'] = '2';

	$prueba = 'Buscar acción-funcionalidad que no existe.';
	$codeEsperado = 'RECORDSET_VACIO';
	$pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    $pruebas->desconectarCurl($pruebas->cliente);

    return $pruebas->resultadoTest;

}
?>