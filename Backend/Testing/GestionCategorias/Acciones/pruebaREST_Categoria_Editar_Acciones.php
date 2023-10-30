<?php

function pruebaREST_Categoria_Editar_Acciones(){

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

	//insertar categoria
	$POST = $vaciarPost;
	$POST['controller'] = 'category';
	$POST['action'] = 'add';
	$POST['nombre'] = 'categoriaTest';
	$POST['descripcion'] = 'Nueva insercion de categoria por parte del test';
    $POST['id_categoria_padre'] = '1';
	$POST['dni_usuario_creacion'] = '14488423X';
    $POST['dni_usuario_modificacion'] = '14488423X';
    
    $pruebas->peticionCurlNoTest($POST);

	//Buscar categoria
    $POST = $vaciarPost;
    $POST['controller'] = 'category';
    $POST['action'] = 'search';
    $POST['nombre'] = 'categoriaTest';

    $id = $pruebas->peticionCurlNoTestRespuesta($POST);
    $infoCategoria = (array)$id['resource'][0];

    //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
    //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//ERRORES_CATEGORIA
    //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
    //&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //EDITAR_CATEGORIA_OK
    $POST['action'] = 'edit';
	$POST['id_categoria'] = $infoCategoria['id_categoria'];
	$POST['nombre'] = 'categoriaTest';
	$POST['descripcion'] = 'Descripcion modificada';
    $POST['id_categoria_padre'] = '1';
	$POST['dni_usuario_creacion'] = '14488423X';
    $POST['dni_usuario_modificacion'] = '14488423X';

	$prueba = 'Categoria editada con éxito.';
	$codeEsperado = 'EDITAR_CATEGORIA_OK';
	$pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

    //borrado categoria
    $POST = $vaciarPost;
    $POST['controller'] = 'category';
    $POST['action'] = 'finalDelete';
    $POST['id_categoria'] = $infoCategoria['id_categoria'];

    $pruebas->peticionCurlNoTest($POST);

//---------------------------------------------------------------------------------------------------------------------

    //CATEGORIA_NO_EXISTE
    $POST = $vaciarPost;
    $POST['controller'] = 'category';
    $POST['action'] = 'edit';
    $POST['id_categoria'] = $infoCategoria['id_categoria'];
	$POST['nombre'] = 'categoriaTest';
	$POST['descripcion'] = 'Descripcion modificada';
    $POST['id_categoria_padre'] = '1';
	$POST['dni_usuario_creacion'] = '14488423X';
    $POST['dni_usuario_modificacion'] = '14488423X';

    $prueba = 'Editar una categoria que no existe';
    $codeEsperado = 'CATEGORIA_NO_EXISTE';
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
    $POST['controller'] = 'category';
    $POST['action'] = 'edit';
    $POST['id_categoria'] = '1';
	$POST['nombre'] = 'categoriaTest';
	$POST['descripcion'] = 'Descripcion modificada';
    $POST['id_categoria_padre'] = '1';
	$POST['dni_usuario_creacion'] = '14488423X';
    $POST['dni_usuario_modificacion'] = '14488423X';

    $prueba = 'Solo el usuario moderador puede editar los datos de un categoria';
    $codeEsperado = 'PERMISOS_KO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    $pruebas->desconectarCurl($pruebas->cliente);

    return $pruebas->resultadoTest;

}
?>