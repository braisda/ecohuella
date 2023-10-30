<?php

function pruebaREST_Parametro_Editar_Acciones(){

	include_once './Testing/pruebaREST_class.php';

	$pruebas = new testRest();

    $tipo = 'Acción';
	$vaciarPost = NULL;

//---------------------------------------------------------------------------------------------------------------------

	//login correcto
	$POST = $vaciarPost;
	$POST['controller'] = 'auth';
	$POST['action'] = 'login';
	$POST['dni'] = '62167251E';
	$POST['password'] = '21232f297a57a5a743894a0e4a801fc3';

	$pruebas->peticionLogin($POST); 

//---------------------------------------------------------------------------------------------------------------------

	//insertar parametro
	$POST = $vaciarPost;
	$POST['controller'] = 'parameter';
	$POST['action'] = 'add';
	$POST['nombre'] = 'parametroTestForEdit';
	$POST['descripcion'] = 'Nueva insercion de parametro del test';
    $POST['unidad'] = 'KM';
	$POST['dni_usuario_creacion'] = '62167251E';
    $POST['dni_usuario_modificacion'] = '62167251E';
	$POST['id_proceso'] = '1';
	$POST['version'] = '1';
    
    $pruebas->peticionCurlNoTest($POST);

    //Buscar parametro
    $POST = $vaciarPost;
    $POST['controller'] = 'parameter';
    $POST['action'] = 'search';
    $POST['nombre'] = 'parametroTestForEdit';
    $id = $pruebas->peticionCurlNoTestRespuesta($POST);
    $infoParametro = (array)$id['resource'][0];

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//ERRORES_PARAMETRO
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
    //EDITAR_PARAMETRO_OK
    $POST = $vaciarPost;
    $POST['controller'] = 'parameter';
    $POST['action'] = 'edit';
	$POST['id_parametro'] = $infoParametro['id_parametro'];
	$POST['nombre'] = 'parametroTestForEdit';
	$POST['descripcion'] = 'editado';
	$POST['unidad'] = 'editada';
    $POST['version'] = '1';
    $POST['dni_usuario_modificacion'] = '96082852F';

	$prueba = 'Parametro editado con éxito.';
	$codeEsperado = 'EDITAR_PARAMETRO_OK';
	$pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //PARAMETRO_NO_EXISTE
    $POST = $vaciarPost;
    $POST['controller'] = 'parameter';
    $POST['action'] = 'edit';
	$POST['id_parametro'] = '9999';
	$POST['nombre'] = 'parametroTestForEdit';
	$POST['descripcion'] = 'editado';
	$POST['unidad'] = 'editada';
    $POST['version'] = '1';
    $POST['dni_usuario_modificacion'] = '96082852F';

    $prueba = 'Editar una parametro que no existe';
    $codeEsperado = 'PARAMETRO_NO_EXISTE';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);
	
//---------------------------------------------------------------------------------------------------------------------

	//login correcto
	$POST = $vaciarPost;
	$POST['controller'] = 'auth';
	$POST['action'] = 'login';
	$POST['dni'] = '12345678Z';
	$POST['password'] = '21232f297a57a5a743894a0e4a801fc3';

	$pruebas->peticionLogin($POST);
	
    //PERMISOS_KO
    $POST = $vaciarPost;
    $POST['controller'] = 'parameter';
    $POST['action'] = 'edit';
	$POST['id_parametro'] = $infoParametro['id_parametro'];
    $POST['version'] = '1';
	$POST['descripcion'] = 'editado';
	$POST['unidad'] = 'editada';
    $POST['dni_usuario_modificacion'] = '96082852F';

    $prueba = 'Solo el usuario formulador puede editar los datos de un parametro';
    $codeEsperado = 'PERMISOS_KO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    $pruebas->desconectarCurl($pruebas->cliente);

    return $pruebas->resultadoTest;

}
?>