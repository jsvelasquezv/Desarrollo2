<?php 
	require_once '../modelos/LogicaUsuario.php';
	$username = $_POST["username"]; 
	$contrasena = $_POST["password"];
	if(isset($_POST["ingresar"])){		
		$logica = new LogicaUsuario();
		$response = $logica->validarLogin($username, $contrasena);
		session_start();
		$_SESSION['user'] = $username;
		$_SESSION['logueado'] = true;
		header('Location: ../index.php');
	}elseif (isset($_POST["recuperar"])) {
		
		header('Location: ../index.php');
	}
	//unset($_SESSION);
?>