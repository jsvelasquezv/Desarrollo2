<?php 
	require_once '../modelos/ValidarConsultarPerfil.php';
	$validarConsulta = new ValidarConsultarPerfil();
	session_start();
	$_SESSION['perfiles'] = $validarConsulta->consultarTodos();
	if (isset($_SESSION['exitoRegistrar'])) {
		$exitoRegistrar = $_SESSION['exitoRegistrar'];

	}
	if (isset($_SESSION['exitoModificar'])) {
		$exitoModificar = $_SESSION['exitoModificar'];
		// foreach ($_SESSION['perfiles'] as $key) {
		// 	echo $key['id'];
		// 	echo $key['nombre'];
		// }
	}
	if (isset($_SESSION['eBuscarP'])) {
		$errorBuscarPerfil = $_SESSION['eBuscarP'];
	}
	// foreach ($_SESSION['perfiles'] as $key) {
	// 	echo $key['id'];
	// 	echo $key['nombre'];
	// }
 ?>