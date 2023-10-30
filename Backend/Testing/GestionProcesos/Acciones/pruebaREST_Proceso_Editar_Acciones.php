<?php

function pruebaREST_Proceso_Editar_Acciones(){

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

	//insertar proceso
	$POST = $vaciarPost;
	$POST['controller'] = 'process';
	$POST['action'] = 'add';
	$POST['nombre'] = 'procesoTestEditar';
	$POST['descripcion'] = 'Nueva insercion de proceso por parte del test';
	$POST['formula'] = 'formula';
	$POST['fecha_creacion'] = '2022-08-01';
	$POST['fecha_modificacion'] = '2022-08-01';
	$POST['id_categoria'] = '1';
	$POST['dni_usuario_creacion'] = '62167251E';
	$POST['dni_usuario_modificacion'] = '62167251E';
	$POST['activo'] = '0';

	$prueba = 'Insertar proceso';
	$codeEsperado = 'ANADIR_PROCESO_OK';
	$pruebas->peticionCurlNoTestRespuesta($POST);

    //Buscar proceso
    $POST = $vaciarPost;
    $POST['controller'] = 'process';
    $POST['action'] = 'search';
    $POST['nombre_proceso'] = 'procesoTestEditar';
    $id = $pruebas->peticionCurlNoTestRespuesta($POST);
    $infoProceso = (array)$id['resource'][0];

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//ERRORES_PROCESO
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
    
    //EDITAR_PROCESO_OK
    $POST = $vaciarPost;
    $POST['controller'] = 'process';
    $POST['action'] = 'edit';
    $POST['id_proceso'] = $infoProceso['id_proceso'];
    $POST['version'] = $infoProceso['version'];
    $POST['nombre'] = 'nombre modificado';
	$POST['descripcion'] = 'Nueva insercion de proceso por parte del test';
	$POST['formula'] = 'formula';
	$POST['fecha_creacion'] = '2022-08-01';
	$POST['fecha_modificacion'] = '2022-08-01';
	$POST['id_categoria'] = '1';
	$POST['dni_usuario_creacion'] = '62167251E';
	$POST['dni_usuario_modificacion'] = '62167251E';
	$POST['activo'] = '1';

    $prueba = 'Editar un proceso que no existe';
    $codeEsperado = 'EDITAR_PROCESO_OK';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //PROCESO_NO_EXISTE
    $POST = $vaciarPost;
    $POST['controller'] = 'process';
    $POST['action'] = 'edit';
    $POST['id_proceso'] = '999999';
    $POST['version'] = '999999';
    $POST['nombre'] = 'nombre modificado';
	$POST['descripcion'] = 'Nueva insercion de proceso por parte del test';
	$POST['formula'] = 'formula';
	$POST['fecha_creacion'] = '2022-08-01';
	$POST['fecha_modificacion'] = '2022-08-01';
	$POST['id_categoria'] = '1';
	$POST['dni_usuario_creacion'] = '62167251E';
	$POST['dni_usuario_modificacion'] = '62167251E';
	$POST['activo'] = '1';
    $prueba = 'Editar un proceso que no existe';
    $codeEsperado = 'PROCESO_NO_EXISTE';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);
	
//---------------------------------------------------------------------------------------------------------------------

	//login correcto
	$POST = $vaciarPost;
	$POST['controller'] = 'auth';
	$POST['action'] = 'login';
	$POST['dni'] = '12345678Z';
	$POST['password'] = '21232f297a57a5a743894a0e4a801fc3';

	$pruebas->peticionLogin($POST);

//---------------------------------------------------------------------------------------------------------------------


    //PROCESO_DENEGADA_EDITAR_PROCESO
    $POST = $vaciarPost;
    $POST['controller'] = 'process';
    $POST['action'] = 'edit';
    $POST['id_proceso'] = $infoProceso['id_proceso'];
    $POST['version'] = $infoProceso['version'];
    $POST['nombre'] = 'nombre modificado';
	$POST['descripcion'] = 'Nueva insercion de proceso por parte del test';
	$POST['formula'] = 'formula';
	$POST['fecha_creacion'] = '2022-08-01';
	$POST['fecha_modificacion'] = '2022-08-01';
	$POST['id_categoria'] = '1';
	$POST['dni_usuario_creacion'] = '62167251E';
	$POST['dni_usuario_modificacion'] = '62167251E';
	$POST['activo'] = '1';

    $prueba = 'Solo el usuario formulador o moderador pueden editar los datos de un proceso';
    $codeEsperado = 'PERMISOS_KO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    $pruebas->desconectarCurl($pruebas->cliente);

    return $pruebas->resultadoTest;

}
?>