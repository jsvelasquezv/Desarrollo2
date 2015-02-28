<?php 
	require_once '../modelos/LogicaPerfil.php';
	$logica = new LogicaPerfil();
	session_start();
	$_SESSION['perfiles'] = $logica->getPerfiles();
	/*foreach ($_SESSION as $key ) {
		echo $key;
	}*/
 ?>