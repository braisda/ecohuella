<?php

function pruebaREST_Proceso_Insertar_Acciones(){

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

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//INSERTAR
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

	//PROCESO_INSERTAR_OK
	$POST = $vaciarPost;
	$POST['controller'] = 'process';
	$POST['action'] = 'add';
	$POST['id_proceso'] = '';
	$POST['version'] = '1';
	$POST['nombre'] = 'procesoTest';
	$POST['descripcion'] = 'Nueva insercion de proceso por parte del test';
	$POST['formula'] = '';
	$POST['fecha_creacion'] = '2022-08-01';
	$POST['fecha_modificacion'] = '2022-08-01';
	$POST['activo'] = '0';
	$POST['id_categoria'] = '1';
	$POST['dni_usuario_creacion'] = '62167251E';
	$POST['dni_usuario_modificacion'] = '62167251E';

	$prueba = 'Insertar proceso';
	$codeEsperado = 'ANADIR_PROCESO_OK';
	$pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//ERRORES_proceso
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //PROCESO_YA_EXISTE
	$POST['id_proceso'] = '1';
	$POST['version'] = '1';
    $prueba = 'proceso para insertar ya existente';
    $codeEsperado = 'PROCESO_YA_EXISTE';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

	//login correcto
	$POST = $vaciarPost;
	$POST['controller'] = 'auth';
	$POST['action'] = 'login';
	$POST['dni'] = '12345678Z';
	$POST['password'] = '21232f297a57a5a743894a0e4a801fc3';

	$pruebas->peticionLogin($POST); 
   
    //PROCESODENEGADA_INSERTAR_PROCESO
	$POST = $vaciarPost;
	$POST['controller'] = 'process';
	$POST['action'] = 'add';
	$POST['nombre'] = 'procesoTest';
	$POST['descripcion'] = 'Nueva insercion de proceso por parte del test';
	$POST['fecha_creacion'] = '2022-08-01';
	$POST['fecha_modificacion'] = '2022-08-01';
	$POST['id_categoria'] = '1';
	$POST['dni_usuario_creacion'] = '62167251E';
	$POST['dni_usuario_modificacion'] = '62167251E';

	$prueba = 'Solo un usuario resposable del la categoría puede insertar un proceso en la misma.';
	$codeEsperado = 'PERMISOS_KO';
	$pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    $pruebas->desconectarCurl($pruebas->cliente);

    return $pruebas->resultadoTest;

}
?>