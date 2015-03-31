<?php 
	require_once '../modelos/LogicaPerfil.php';
	$logicaPerfil = new LogicaPerfil();
	session_start();
	$_SESSION['perfilesCargados']=$logicaPerfil->getPerfiles();
	header('Location: ../index.php');
?>