<?php

function pruebaREST_Notificacion_Insertar_Acciones(){

	include_once './Testing/pruebaREST_class.php';

	$pruebas = new testRest();

    $tipo = 'Acción';
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
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//INSERTAR
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

	//ANADIR_NOTIFICACION_OK
	$POST = $vaciarPost;
	$POST['controller'] = 'notification';
	$POST['action'] = 'add';
	$POST['titulo'] = 'notificacionTest';
	$POST['cuerpo'] = 'Nueva insercion de notificacion por parte del test';
    $POST['fecha'] = '2021-01-01';
	$POST['leida'] = '0';
	$POST['dni_usuario_remitente'] = '14488423X';
    $POST['dni_usuario_destinatario'] = '14488423X';

	$prueba = 'Insertar notificacion';
	$codeEsperado = 'ANADIR_NOTIFICACION_OK';
	$pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//ERRORES_notificacion
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //Buscar notificacion
    $POST = $vaciarPost;
    $POST['controller'] = 'notification';
    $POST['action'] = 'search';
    $POST['titulo'] = 'notificacionTest';

    $id = $pruebas->peticionCurlNoTestRespuesta($POST);
    $infoCategoria = (array)$id['resource'][0];
    
//---------------------------------------------------------------------------------------------------------------------

    //borrado notificacion
    $POST = $vaciarPost;
    $POST['controller'] = 'notification';
    $POST['action'] = 'finalDelete';
    $POST['id_notificacion'] = $infoCategoria['id_notificacion'];

    $pruebas->peticionCurlNoTest($POST);

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
	$POST['controller'] = 'notification';
	$POST['action'] = 'add';
	$POST['titulo'] = 'notificacionTest';
	$POST['cuerpo'] = 'Nueva insercion de notificacion por parte del test';
    $POST['fecha'] = '2021-01-01';
	$POST['leida'] = '0';
	$POST['dni_usuario_remitente'] = '12345678Z';
    $POST['dni_usuario_destinatario'] = '14488423X';

	$prueba = 'Solo un usuario administrador puede insertar una notificacion.';
	$codeEsperado = 'PERMISOS_KO';
	$pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    $pruebas->desconectarCurl($pruebas->cliente);

    return $pruebas->resultadoTest;

}
?>