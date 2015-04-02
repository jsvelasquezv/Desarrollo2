<?php
require_once'../modelos/ValidarBuscarProducto.php';
// require_once'../controladores/CoordinadorProductoCrear.php';
$validarBusqueda = new ValidarBuscarProducto();
session_start();
$_SESSION['productos'] = $validarBusqueda->buscarTodos();
if(isset($_SESSION['exitoBuscarProducto'])){
	$exitoBuscarProducto = $_SESSION['exitoBuscarProducto'];
}
#===========================================================
if(isset($_SESSION['exitoEditarProducto'])){
	$exitoEditarProducto = $_SESSION['exitoEditarProducto'];
}
#===========================================================
if(isset($_SESSION['exitoCrearProducto'])){
	$exitoCrearProducto = $_SESSION['exitoCrearProducto'];
}
// else{
// 	$erroresCrearProducto = $_SESSION['erroresCrearProducto'];
// }
// foreach ($_SESSION['productos'] as $key) {
// 		echo 'id = '.$key['id']."<br>";
// 		echo 'nombre = '.$key['nombre']."<br>";
// 	}

?>