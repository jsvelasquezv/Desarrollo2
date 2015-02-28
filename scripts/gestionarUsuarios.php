<?php 
	require_once '../modelos/LogicaUsuario.php';
	$logica = new LogicaUsuario();
	session_start();
	$_SESSION['usuarios'] = $logica->getUsuarios();
 ?>