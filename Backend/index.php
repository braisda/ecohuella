<?php
include_once './Core/codes.php';
include_once './Core/fillException.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH, OPTIONS');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
if ((!isset($_POST['controller']) and !isset($_POST['action'])) or
	!isset($_POST['controller']) or !isset($_POST['action'])
) {
	invalidRequest('PETICION_INVALIDA');
}

define('controller', $_POST['controller']);
define('action', $_POST['action']);

$rest = controller;
$action = action;

if ($rest != 'auth') {
	include_once './Controller/authController.php';
	$auth = new auth();
	$auth->tokenVerify();
}
if (file_exists('./Controller/' . $rest . 'Controller.php')) {
	include_once './Controller/' . $rest . 'Controller.php';
	$restName = new $rest;
} else {
	invalidRequest('CONTROLADOR_NO_ENCONTRADO');
}

$controllerMethods = get_class_methods($restName);

if (in_array($action, $controllerMethods)) {
	$restName->$action();
} else {
	invalidRequest('ACCION_NO_ENCONTRADA');
}

function invalidRequest($mensaje)
{
	header('Content-type: application/json');
	echo (json_encode(array('ok' => 'false', 'code' => $mensaje)));
	exit();
}
