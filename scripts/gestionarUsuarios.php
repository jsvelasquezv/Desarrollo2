<?php 
	require_once '../modelos/LogicaUsuario.php';
	require_once '../modelos/LogicaPerfil.php';
	$logicaUsuario = new LogicaUsuario();
	$logicaPerfil = new LogicaPerfil();
	session_start();
	$_SESSION['usuarios'] = $logicaUsuario->getUsuarios();
	$_SESSION['perfiles'] = $logicaPerfil->getPerfiles();
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