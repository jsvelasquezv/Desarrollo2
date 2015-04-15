<?php

if (isset($_SESSION['exitoAgregarCarrito'])) {
	$exitoAgregarCarrito = $_SESSION['exitoAgregarCarrito'];
}

if(isset($_SESSION['erroresCarritoAgregar'])){
	$erroresCarritoAgregar = $_SESSION['erroresCarritoAgregar'];
}

if(isset($_SESSION['exitoCarritoEliminar'])){
	$exitoEliminarCarrito = $_SESSION['exitoCarritoEliminar'];
}

// foreach ($_SESSION['erroresCarritoAgregar'] as $key) {
// 	echo $key;
// }
?>