<?php
require_once'../modelos/CategoriaBuscar.php';
$busquedaCat = new CategoriaBuscar();
session_start();
$_SESSION['categorias'] = $busquedaCat->mostrarCategorias();
if(isset($_SESSION['exitoBuscarCategoria'])){
	$exitoBuscarCategoria = $_SESSION['exitoBuscarCategoria'];
}
#===========================================================
if(isset($_SESSION['exitoEditarCategoria'])){
	$exitoEditarCategoria = $_SESSION['exitoEditarCategoria'];
	//echo $exitoEditarCategoria;
}
#===========================================================
if(isset($_SESSION['exitoCreacionCategoria'])){
	$exitoCrearCategoria = $_SESSION['exitoCreacionCategoria'];
	//echo $exitoCrearCategoria;
}
if (isset($_SESSION['errorBuscarCategoria'])) {
		$errorBuscarCategoria = $_SESSION['errorBuscarCategoria'];
	}
?>