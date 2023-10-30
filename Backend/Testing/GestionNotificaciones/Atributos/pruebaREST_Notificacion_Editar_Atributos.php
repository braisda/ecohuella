<?php

function pruebaREST_Notificacion_Editar_Atributos(){

	include_once './Testing/pruebaREST_class.php';

	$pruebas = new testRest();

    $tipo = 'Atributo';
	$vaciarPost = NULL;

//---------------------------------------------------------------------------------------------------------------------

	//login correcto
	$POST = $vaciarPost;
	$POST['controller'] = 'auth';
	$POST['action'] = 'login';
	$POST['dni'] = '14488423X';
	$POST['password'] = '21232f297a57a5a743894a0e4a801fc3';

	$pruebas->peticionLogin($POST);

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//ERRORES_ATRIBUTO ID_NOTIFICACION
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //ID_NOTIFICACION_VACIO
    $POST = $vaciarPost;
    $POST['controller'] = 'notification';
    $POST['action'] = 'edit';
    $POST['id_notificacion'] = '';
    $POST['leida'] = '1';

    $prueba = 'ID de notificacion vacío';
    $codeEsperado = 'ID_VACIO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //ID_NOTIFICACION_ERROR_FORMATO
    $POST['id_notificacion'] = '/&%$';
    $POST['leida'] = '1';
    
    $prueba = 'Id de notificacion presenta un formato incorrecto';
    $codeEsperado = 'ID_NOTIFICACION_ERROR_FORMATO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//ERRORES_ATRIBUTO LEIDA
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

   //LEIDA_NOTIFICACION_VACIO
   $POST['controller'] = 'notification';
   $POST['action'] = 'edit';
   $POST['id_notificacion'] = '1';
   $POST['leida'] = '';
   

   $prueba = 'Leida de notificacion vacío';
   $codeEsperado = 'NOTIFICACION_LEIDA_VACIO';
   $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //LEIDA_NOTIFICACION_ERROR_FORMATO
    $POST['controller'] = 'notification';
    $POST['action'] = 'edit';
    $POST['id_notificacion'] = '1';
    $POST['leida'] = '/&%$';

    $prueba = 'Leida de notificacion presenta un formato incorrecto';
    $codeEsperado = 'NOTIFICACION_LEIDA_ERROR_FORMATO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

	$pruebas->desconectarCurl($pruebas->cliente);

	return $pruebas->resultadoTest;

}

?>