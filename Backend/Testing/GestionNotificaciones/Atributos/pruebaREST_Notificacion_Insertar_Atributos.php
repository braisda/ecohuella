<?php

function pruebaREST_Notificacion_Insertar_Atributos(){

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
												//ERRORES_ATRIBUTO TITULO
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

   //NOTIFICACION_TITULO_VACIO
   $POST = $vaciarPost;
   $POST['controller'] = 'notification';
   $POST['action'] = 'add';
   $POST['titulo'] = '';

   $prueba = 'Titulo de notificacion vacío';
   $codeEsperado = 'TITULO_VACIO';
   $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

   //NOTIFICACION_TITULO_MENOR_QUE_3
   $POST['titulo'] = 'ro';

   $prueba = 'Titulo de notificacion con titulo menor que 3';
   $codeEsperado = 'TITULO_MENOR_QUE_3';
   $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

   //NOTIFICACION_TITULO_MAYOR_QUE_48
   $POST['titulo'] = 'notificacionTesttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttt';

   $prueba = 'Titulo de notificacion con titulo mayor que 48';
   $codeEsperado = 'TITULO_MAYOR_QUE_45';
   $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

   //NOTIFICACION_TITULO_FORMATO_INCORRECTO
   $POST['titulo'] = 'notificacion&est';

   $prueba = 'Titulo de notificacion que contenga caracteres diferentes a números, letras y espacios';
   $codeEsperado = 'TITULO_FORMATO_INCORRECTO';
   $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//ERRORES_ATRIBUTO CUERPO
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //CATEGORIA_CUERPO_VACIO
    $POST = $vaciarPost;
    $POST['controller'] = 'notification';
    $POST['action'] = 'add';
    $POST['titulo'] = 'notificacionTestDos';
    $POST['cuerpo'] = '';
    

    $prueba = 'Cuerpo de notificacion vacío';
    $codeEsperado = 'CUERPO_VACIA';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------
    
    //CATEGORIA_CUERPO_MENOR_QUE_3
    $POST['cuerpo'] = 'In';

    $prueba = 'Cuerpo de notificacion menor que 3';
    $codeEsperado = 'CUERPO_MENOR_QUE_3';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //CATEGORIA_CUERPO_MAYOR_QUE_200
    $POST['cuerpo'] = 'Iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii
    iiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiiii';

    $prueba = 'Cuerpo de notificacion mayor de 200';
    $codeEsperado = 'CUERPO_MAYOR_QUE_500';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //CATEGORIA_CUERPO_FORMATO_INCORRECTO
    $POST['cuerpo'] = 'Descrpc#on';

    $prueba = 'Cuerpo de notificacion con carcateres diferentes a números, letras y espacios en la cuerpo';
    $codeEsperado = 'CUERPO_FORMATO_INCORRECTO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//ERRORES_ATRIBUTO Fecha
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

	//FECHA_VACIA
    $POST['cuerpo'] = 'cuerpo';
	$POST['fecha'] = '';

	$prueba = 'La fecha no puede ser vacia.';
	$codeEsperado = 'FECHA_VACIA';
	$pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

	//FECHA_FORMATO_INCORRECTO
	$POST['fecha'] = '12-2021-06';

	$prueba = 'El formato de la fecha no es correcto: aaaa-mm-dd.';
	$codeEsperado = 'FECHA_FORMATO_INCORRECTO';
	$pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

	//FECHA_SOLO_NUMEROS_Y_GUIONES
	$POST['fecha'] = '2021-1$-06';

	$prueba = 'La fecha solo puede contener números y -.';
	$codeEsperado = 'FECHA_SOLO_NUMEROS_Y_GUIONES';
	$pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

	//FECHA_MENOR_QUE_10
	$POST['fecha'] = '2021-12-6';

	$prueba = 'La fecha no puede ser menor que 10 dígitos.';
	$codeEsperado = 'FECHA_MENOR_QUE_10';
	$pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

	//FECHA_MAYOR_QUE_10
	$POST['fecha'] = '202121212121-12-06';
	
	$prueba = 'La fecha no puede ser mayor que 10 dígitos.';
	$codeEsperado = 'FECHA_MAYOR_QUE_10';
	$pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

	//FECHA_IMPOSIBLE
	$POST['fecha'] = '3000-12-06';

	$prueba = 'La fecha no puede ser mayor a la fecha actual.';
	$codeEsperado = 'FECHA_IMPOSIBLE';
	$pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//ERRORES_ATRIBUTO LEIDA
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

   //LEIDA_NOTIFICACION_VACIO
   $POST['controller'] = 'notification';
   $POST['action'] = 'add';
   $POST['fecha'] = '2022-02-02';
   $POST['leida'] = '';
   

   $prueba = 'Leida de notificacion vacío';
   $codeEsperado = 'NOTIFICACION_LEIDA_VACIO';
   $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //LEIDA_NOTIFICACION_ERROR_FORMATO
    $POST['controller'] = 'notification';
    $POST['action'] = 'add';
    $POST['leida'] = '1$';
    

    $prueba = 'Leida de notificacion presenta un formato incorrecto';
    $codeEsperado = 'NOTIFICACION_LEIDA_ERROR_FORMATO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//ERRORES_ATRIBUTO DNI_REMITENTE
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //PROCESO_CREADOR_DNI_VACIO
    $POST['leida'] = '0';
    $POST['dni_usuario_remitente'] = '';

    $prueba = 'DNI remitente vacío';
    $codeEsperado = 'DNI_VACIO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //PROCESO_CREADOR_DNI_MENOR_QUE_9
    $POST['dni_usuario_remitente'] = '11111111';

    $prueba = 'DNI remitente menor que 9';
    $codeEsperado = 'DNI_MENOR_QUE_9';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //PROCESO_CREADOR_DNI_MAYOR_QUE_9
    $POST['dni_usuario_remitente'] = '11111111HH';

    $prueba = 'DNI remitente mayor que 9';
    $codeEsperado = 'DNI_MAYOR_QUE_9';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //PROCESO_CREADOR_DNI_FORMATO_INCORRECTO
    $POST['dni_usuario_remitente'] = '1234 5678';

	$prueba = 'El dni de usuario no puede contener más que letras y números, no se aceptan caracteres en blanco, ñ, acentos o carcateres especiales.';
	$codeEsperado = 'DNI_FORMATO_INCORRECTO';
	$pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

	//PROCESO_CREADORDNI_LETRA_INCORRECTA
	$POST['dni_usuario_remitente'] = '12345678A';

	$prueba = 'El dni de usuario debe ser real.';
	$codeEsperado = 'DNI_LETRA_INCORRECTA';

//---------------------------------------------------------------------------------------------------------------------

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//ERRORES_ATRIBUTO DNI_DESTINATARIO
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //PROCESO_CREADOR_DNI_VACIO
    $POST['dni_usuario_remitente'] = '62167251E';
    $POST['dni_usuario_destinatario'] = '';

    $prueba = 'DNI destinatario vacío';
    $codeEsperado = 'DNI_VACIO';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //PROCESO_CREADOR_DNI_MENOR_QUE_9
    $POST['dni_usuario_destinatario'] = '11111111';

    $prueba = 'DNI destinatario menor que 9';
    $codeEsperado = 'DNI_MENOR_QUE_9';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //PROCESO_CREADOR_DNI_MAYOR_QUE_9
    $POST['dni_usuario_destinatario'] = '11111111HH';

    $prueba = 'DNI destinatario mayor que 9';
    $codeEsperado = 'DNI_MAYOR_QUE_9';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //PROCESO_CREADOR_DNI_FORMATO_INCORRECTO
    $POST['dni_usuario_destinatario'] = '1234 5678';

	$prueba = 'El dni destinatario no puede contener más que letras y números, no se aceptan caracteres en blanco, ñ, acentos o carcateres especiales.';
	$codeEsperado = 'DNI_FORMATO_INCORRECTO';
	$pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $tipo, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

	//PROCESO_CREADORDNI_LETRA_INCORRECTA
	$POST['dni_usuario_destinatario'] = '12345678A';

	$prueba = 'El dni de usuario debe ser real.';
	$codeEsperado = 'DNI_LETRA_INCORRECTA';

//---------------------------------------------------------------------------------------------------------------------

	$pruebas->desconectarCurl($pruebas->cliente);

	return $pruebas->resultadoTest;

}

?>