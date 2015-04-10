<?php 
	require_once '../modelos/ValidarConsultarUsuario.php';
	require_once '../modelos/ValidarConsultarPerfil.php';
	$logicaUsuario = new ValidarConsultarUsuario();
	$validarConsultar = new ValidarConsultarPerfil();
	session_start();
	$_SESSION['usuarios'] = $logicaUsuario->getUsuarios();
	$_SESSION['perfiles'] = $validarConsultar->consultarTodos();
	if (isset($_SESSION['exitoRegistrar'])) {
		$exitoRegistrar = $_SESSION['exitoRegistrar'];
	}
	if (isset($_SESSION['exitoModificar'])) {
		$exitoModificar = $_SESSION['exitoModificar'];
	}
	if (isset($_SESSION['eBuscar'])) {
		$eBuscar = $_SESSION['eBuscar'];
	}
	// foreach ($_SESSION['usuarios'] as $key => $value) {
	// 	echo $key['id'];
	// 	echo $key['nombre'];
	// }
	// echo 'hola';
 ?>