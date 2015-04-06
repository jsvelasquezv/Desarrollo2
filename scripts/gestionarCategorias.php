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
}
#===========================================================
if(isset($_SESSION['exitoCrearCategoria'])){
	$exitoCrearCategoria = $_SESSION['exitoCrearCategoria'];
}
?>