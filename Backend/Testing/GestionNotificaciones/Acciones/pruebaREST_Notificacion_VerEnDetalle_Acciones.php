<?php

function pruebaREST_Notificacion_VerEnDetalle_Acciones(){

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
	$POST['titulo'] = 'notificacionTestBorrado';
	$POST['cuerpo'] = 'Nueva insercion de notificacion por parte del test';
    $POST['fecha'] = '2021-01-01';
	$POST['leida'] = '0';
	$POST['dni_usuario_remitente'] = '14488423X';
    $POST['dni_usuario_destinatario'] = '14488423X';

	$prueba = 'Insertar notificacion';
	$codeEsperado = 'ANADIR_NOTIFICACION_OK';
	$pruebas->peticionCurlNoTestRespuesta($POST);

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//ERRORES_notificacion
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //Buscar notificacion
    $POST = $vaciarPost;
    $POST['controller'] = 'notification';
    $POST['action'] = 'search';
    $POST['titulo'] = 'notificacionTestBorrado';

    $id = $pruebas->peticionCurlNoTestRespuesta($POST);
    $infoCategoria = (array)$id['resource'][0];

//---------------------------------------------------------------------------------------------------------------------

    //RECORDSET_DATOS
    $POST = $vaciarPost;
    $POST['controller'] = 'notification';
    $POST['action'] = 'searchBy';
    $POST['id_notificacion'] = $infoCategoria['id_notificacion'];

    $prueba = 'Ver en detalle una notificacion';
    $codeEsperado = 'RECORDSET_DATOS';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //borrado notificacion
    $POST = $vaciarPost;
    $POST['controller'] = 'notification';
    $POST['action'] = 'finalDelete';
    $POST['id_notificacion'] = $infoCategoria['id_notificacion'];

    $pruebas->peticionCurlNoTest($POST);

//---------------------------------------------------------------------------------------------------------------------

    //RECORDSET_VACIO
    $POST = $vaciarPost;
    $POST['controller'] = 'notification';
    $POST['action'] = 'searchBy';
    $POST['id_notificacion'] = $infoCategoria['id_notificacion'];

    $prueba = 'Ver en detalle una categoria que no existe en el sistema';
    $codeEsperado = 'RECORDSET_VACIO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    $pruebas->desconectarCurl($pruebas->cliente);

    return $pruebas->resultadoTest;

}
?>