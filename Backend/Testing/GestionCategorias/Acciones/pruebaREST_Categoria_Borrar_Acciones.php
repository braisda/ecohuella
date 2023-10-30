<?php

function pruebaREST_Categoria_Borrar_Acciones(){

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
												//BORRADO
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //ELIMINAR_CATEGORIA_OK
    $POST = $vaciarPost;
    $POST['controller'] = 'category';
    $POST['action'] = 'delete';
    $POST['id_categoria'] = $infoCategoria['id_categoria'];

    $prueba = 'Borrado';
    $codeEsperado = 'ELIMINAR_CATEGORIA_OK';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

    // BORRADO FISICO (Para que funcione siguiente test con el id lade categoria anterior)
    $POST = $vaciarPost;
    $POST['controller'] = 'category';
    $POST['action'] = 'finalDelete';
    $POST['id_categoria'] = $infoCategoria['id_categoria'];

    $pruebas->peticionCurlNoTest($POST);

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
                                            //ERRORES_CATEGORIA
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //CATEGORIA_NO_EXISTE
    $POST = $vaciarPost;
    $POST['controller'] = 'category';
    $POST['action'] = 'delete';
    $POST['id_categoria'] = $infoCategoria['id_categoria'];

    $prueba = 'Id de categoria no existe';
    $codeEsperado = 'CATEGORIA_NO_EXISTE';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //CATEGORIA_RAIZ_NO_SE_PUEDE_BORRAR                  
    $POST = $vaciarPost;
    $POST['controller'] = 'category';
    $POST['action'] = 'delete';
    $POST['id_categoria'] = 1;

    $prueba = 'No se puede eliminar la categoria base';
    $codeEsperado = 'CATEGORIA_RAIZ_NO_SE_PUEDE_BORRAR';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //CATEGORIA_TIENE_HIJOS
    $POST = $vaciarPost;
    $POST['controller'] = 'category';
    $POST['action'] = 'delete';
    $POST['id_categoria'] = '2';

    $prueba = 'No se puede borrar una categoria con hijos.';
    $codeEsperado = 'CATEGORIA_TIENE_HIJOS';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

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
    $POST['action'] = 'delete';
    $POST['id_categoria'] = $infoCategoria['id_categoria'];

    $prueba = 'Solo el moderador puede eliminar un categoria del sistema.';
    $codeEsperado = 'PERMISOS_KO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

    //login correcto
	$POST = $vaciarPost;
	$POST['controller'] = 'auth';
	$POST['action'] = 'login';
	$POST['dni'] = '14488423X';
	$POST['password'] = '21232f297a57a5a743894a0e4a801fc3';

	$pruebas->peticionLogin($POST);
    
    //borrado categoria
    $POST = $vaciarPost;
    $POST['controller'] = 'category';
    $POST['action'] = 'finalDelete';
    $POST['id_categoria'] = $infoCategoria['id_categoria'];

    $pruebas->peticionCurlNoTest($POST);

//---------------------------------------------------------------------------------------------------------------------

    $pruebas->desconectarCurl($pruebas->cliente);

    return $pruebas->resultadoTest;

}
?>