<?php 
	require_once '../modelos/LogicaPerfil.php';
	$logica = new LogicaPerfil();
	session_start();
	$_SESSION['perfiles'] = $logica->getPerfiles();
	if (isset($_SESSION['exitoRegistrar'])) {
		$exitoRegistrar = $_SESSION['exitoRegistrar'];
	}
	if (isset($_SESSION['exitoModificar'])) {
		$exitoModificar = $_SESSION['exitoModificar'];
	}
	if (isset($_SESSION['eBuscarP'])) {
		$errorBuscarPerfil = $_SESSION['eBuscarP'];
	}

	// foreach ($_SESSION['perfiles'] as $key) {
	// 	echo $key['id'];
	// 	echo $key['nombre'];
	// }
 ?>