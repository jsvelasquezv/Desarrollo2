<?php 
	require_once '../modelos/LogicaUsuario.php';
	$username = $_POST["username"]; 
	$contrasena = $_POST["password"];
	if(isset($_POST["ingresar"])){		
		$logica = new LogicaUsuario();
		$response = $logica->validarLogin($username, $contrasena);
		foreach ($response as $key) {
			echo $key;
		}
		session_start();
		$_SESSION['user'] = $username;
		$_SESSION['logueado'] = $true;
	}elseif (isset($_POST["recuperar"])) {
		
		header('Location: http://www.commentcamarche.net/forum/');
	}
?>