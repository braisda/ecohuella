<?php

function pruebaREST_Notificacion_Borrar_Acciones(){

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

//---------------------------------------------------------------------------------------------------------------------

    //insertar notificacion
	$POST = $vaciarPost;
	$POST['controller'] = 'notificaction';
	$POST['action'] = 'add';
	$POST['titulo'] = 'notificacionTest';
	$POST['cuerpo'] = 'Nueva insercion de notificacion por parte del test';
    $POST['fecha'] = '2023-01-01';
    $POST['leida'] = '0';
	$POST['dni_usuario_remitente'] = '14488423X';
    $POST['dni_usuario_destinatario'] = '14488423X';
    
    $pruebas->peticionCurlNoTest($POST);

    //Buscar notificacion
    $POST = $vaciarPost;
    $POST['controller'] = 'notification';
    $POST['action'] = 'search';
    $POST['nombre'] = 'notificacionTest';

    $id = $pruebas->peticionCurlNoTestRespuesta($POST);
    $infoNotificacion = (array)$id['resource'][0];

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//BORRADO
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //ELIMINAR_NOTIFICACION_OK
    $POST = $vaciarPost;
    $POST['controller'] = 'notification';
    $POST['action'] = 'finalDelete';
    $POST['id_notificacion'] = $infoNotificacion['id_notificacion'];

    $prueba = 'Borrado';
    $codeEsperado = 'ELIMINAR_NOTIFICACION_OK';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                                            //ERRORES_NOTIFICACION
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //NOTIFICACION_NO_EXISTE
    $POST = $vaciarPost;
    $POST['controller'] = 'notification';
    $POST['action'] = 'finalDelete';
    $POST['id_notificacion'] = $infoNotificacion['id_notificacion'];

    $prueba = 'Id de notificacion no existe';
    $codeEsperado = 'NOTIFICACION_NO_EXISTE';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    $pruebas->desconectarCurl($pruebas->cliente);

    return $pruebas->resultadoTest;

}
?>