<?php

function pruebaREST_Categoria_Insertar_Acciones(){

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

	//ANADIR_CATEGORIA_OK
	$POST = $vaciarPost;
	$POST['controller'] = 'category';
	$POST['action'] = 'add';
	$POST['nombre'] = 'categoriaTest';
	$POST['descripcion'] = 'Nueva insercion de categoria por parte del test';
    $POST['id_categoria_padre'] = '1';
	$POST['dni_usuario_creacion'] = '14488423X';
    $POST['dni_usuario_modificacion'] = '14488423X';

	$prueba = 'Insertar categoria';
	$codeEsperado = 'ANADIR_CATEGORIA_OK';
	$pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//ERRORES_categoria
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //CATEGORIA_DUPLICADA
    $prueba = 'categoria para insertar ya existente';
    $codeEsperado = 'CATEGORIA_DUPLICADA';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //Buscar categoria
    $POST = $vaciarPost;
    $POST['controller'] = 'category';
    $POST['action'] = 'search';
    $POST['nombre'] = 'categoriaTest';

    $id = $pruebas->peticionCurlNoTestRespuesta($POST);
    $infoCategoria = (array)$id['resource'][0];
    
//---------------------------------------------------------------------------------------------------------------------

    //borrado categoria
    $POST = $vaciarPost;
    $POST['controller'] = 'category';
    $POST['action'] = 'finalDelete';
    $POST['id_categoria'] = $infoCategoria['id_categoria'];

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
	$POST['controller'] = 'category';
	$POST['action'] = 'add';
	$POST['nombre'] = 'categoriaTest';
	$POST['descripcion'] = 'Nueva insercion de categoria por parte del test';
    $POST['id_categoria_padre'] = '1';
	$POST['dni_usuario_creacion'] = '14488423X';
    $POST['dni_usuario_modificacion'] = '14488423X';

	$prueba = 'Solo un usuario administrador puede insertar una categoria.';
	$codeEsperado = 'PERMISOS_KO';
	$pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    $pruebas->desconectarCurl($pruebas->cliente);

    return $pruebas->resultadoTest;

}
?>