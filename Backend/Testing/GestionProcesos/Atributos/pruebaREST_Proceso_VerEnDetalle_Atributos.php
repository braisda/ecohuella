<?php

function pruebaREST_Proceso_VerEnDetalle_Atributos(){

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
												//ERRORES_ATRIBUTO ID_PROCESO
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

   //ID_PROCESO_VACIO 
   $POST = $vaciarPost;
   $POST['controller'] = 'process';
   $POST['action'] = 'searchBy';
   $POST['id_proceso'] = '';
   

   $prueba = 'Id de proceso vacío';
   $codeEsperado = 'ID_VACIO';
   $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

   //VERSION_PROCESO_VACIO 
   $POST = $vaciarPost;
   $POST['controller'] = 'process';
   $POST['action'] = 'searchBy';
   $POST['id_proceso'] = '1';
   $POST['version'] = '';
   

   $prueba = 'Version de proceso vacío';
   $codeEsperado = 'VERSION_VACIO';
   $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //ID_PROCESO_ERROR_FORMATO
    $POST = $vaciarPost;
    $POST['controller'] = 'process';
    $POST['action'] = 'searchBy';
    $POST['id_proceso'] = '1$';
    

    $prueba = 'Id de proceso presenta un formato incorrecto';
    $codeEsperado = 'ID_PROCESO_ERROR_FORMATO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

    //VERSION_ERROR_FORMATO
    $POST = $vaciarPost;
    $POST['controller'] = 'process';
    $POST['action'] = 'searchBy';
    $POST['id_proceso'] = '1';
    $POST['version'] = '1$';
        
    
    $prueba = 'Version de proceso presenta un formato incorrecto';
    $codeEsperado = 'VERSION_ERROR_FORMATO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

	$pruebas->desconectarCurl($pruebas->cliente);

	return $pruebas->resultadoTest;

}

?>