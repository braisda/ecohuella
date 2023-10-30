<?php 

function pruebaREST_ObtenerContrasenaCorreo_Acciones(){


	include_once './Testing/pruebaREST_class.php';
	
	$pruebas = new testRest();
	
//---------------------------------------------------------------------------------------------------------------------

	$accion = 'Accion';
	$vaciarPost = NULL;

//---------------------------------------------------------------------------------------------------------------------

	//login correcto
	$POST = $vaciarPost;
	$POST['controller'] = 'auth';
	$POST['action'] = 'login';
	$POST['dni'] = '12345678Z';
	$POST['contrasena'] = '21232f297a57a5a743894a0e4a801fc3';

	$pruebas->peticionLogin($POST);

	//registrar correcto
	$POST = $vaciarPost;
	$POST['controller'] = 'auth';
	$POST['action'] = 'register';
	$POST['dni'] = '53300040R';
	$POST['password'] = '21232f297a57a5a7f3894a0e4a801fc3';
	$POST['nombre'] = 'Javier';
	$POST['apellidos_usuario'] = 'Cruz Dominguez';
	$POST['fecha_nac'] = '2021-12-06';
	$POST['direccion'] = 'salvador Dalí portal 10º piso 6º A ';
	$POST['telefono'] = '696696696';
	$POST['email'] = 'jcdRegistro3@gmail.com';
	$POST['id_rol'] = '2';

	$pruebas->peticionCurlNoTest($POST);

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//CORREO
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

	//RECUPERAR_CONTRASENA_EMAIL_OK
	$POST = $vaciarPost;
	$POST['controller'] = 'auth';
	$POST['action'] = 'getPasswordEmail';
	$POST['dni'] = '53300040R';
	$POST['email'] = 'jcdRegistro3@gmail.com';

	$prueba = 'La contraseña ha sido cambiada, revise su correo.';
	$codeEsperado = 'RECOVER_PASSWORD_EMAIL_OK';
	$pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $accion, $prueba, $codeEsperado);

//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&
												//ERRORES_ACCION
//&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&&

    //USUARIO_NO_EXISTE
    $POST = $vaciarPost;
    $POST['controller'] = 'auth';
    $POST['action'] = 'getPasswordEmail';
    $POST['dni'] = '89813482T';
    $POST['email'] = 'admin@admin.es';

    $prueba = 'El usuario no existe en el sistema.';
    $codeEsperado = 'USUARIO_NO_EXISTE';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $accion, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //EMAIL_NO_EXISTE
    $POST = $vaciarPost;
	$POST['controller'] = 'auth';
	$POST['action'] = 'getPasswordEmail';
	$POST['dni'] = '12345678Z';
    $POST['email'] = 'falso@falso.es';

    $prueba = 'El correo electrónico no existe.';
    $codeEsperado = 'EMAIL_NO_EXISTE';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $accion, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    //USUARIO_EMAIL_NO_COINCIDEN
    $POST = $vaciarPost;
	$POST['controller'] = 'auth';
	$POST['action'] = 'getPasswordEmail';
	$POST['dni'] = '12345678Z';
    $POST['email'] = 'admin2@admin.es';

    $prueba = 'El usuario y el correo electrónico no coinciden.';
    $codeEsperado = 'USUARIO_EMAIL_NO_COINCIDEN';
    $pruebas->hacerPrueba($POST, $POST['controller'], $POST['action'], $accion, $prueba, $codeEsperado);

//---------------------------------------------------------------------------------------------------------------------

    $pruebas->desconectarCurl($pruebas->cliente);

    return $pruebas->resultadoTest;

}
?>
