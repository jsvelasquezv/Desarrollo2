<?php
require_once'../modelos/Comision.php';
$comisionActual = new Comision();
session_start();
$_SESSION['comision'] = $comisionActual->mostrarComision();

if (isset($_SESSION['errorComision'])) {
		$errorComision = $_SESSION['errorComision'];
	}
if(isset($_SESSION['exitoComision'])){
	$exitoComision = $_SESSION['exitoComision'];
}
?>