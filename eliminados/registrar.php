<?php 
	require_once '../modelos/LogicaUsuario.php';
	$nombre = $_POST["nombre"]; 
	$apellido = $_POST["apellido"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	$documento = $_POST["documento"];
	$email = $_POST["email"];
	$tipo_perfil = $_POST["perfilA"];
	$usuario = new LogicaUsuario();
	$usuario->validarRegistroUsuario($documento, $nombre, $apellido, $email, $username, $password, $tipo_perfil);
	header('Location: ../index.php');
?>