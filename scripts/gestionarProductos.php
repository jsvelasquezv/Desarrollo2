<?php
require_once'../modelos/ValidarBuscarProducto.php';

$validarBusqueda = new ValidarBuscarProducto();
session_start();
$_SESSION['productos'] = $validarBusqueda->buscarTodos();
if(isset($_SESSION['exitoBuscarProducto'])){
	$exitoBuscarProducto = $_SESSION['exitoBuscarProducto'];
}
#===========================================================
if(isset($_SESSION['exitoEditarProducto'])){
	$exitoEditarProducto = $_SESSION['exitoEditarProducto'];
	// echo $exitoEditarProducto;
}
#===========================================================
if(isset($_SESSION['exitoCrearProducto'])){
	$exitoCrearProducto = $_SESSION['exitoCrearProducto'];
	// echo $exitoCrearProducto;
}


// foreach ($_SESSION['productos'] as $key) {
// 		echo 'id = '.$key['id']."<br>";
// 		echo 'nombre = '.$key['nombre']."<br>";
// 	}

?>