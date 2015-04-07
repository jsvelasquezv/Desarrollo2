<?php
// require_once'../modelos/ValidarBuscarProducto.php';
require_once '../modelos/ProductoBuscar.php';

$busqueda = new ProductoBuscar();
session_start();
#userName del usuario que se encuntra logueado en el momento lo obtengo con esta variable de session
$userUsuario = $_SESSION['user'];
$_SESSION['productos'] = $busqueda->getProductosUser($userUsuario);#Esta variable de sesion me guarda los productos que el usuario ha creado
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