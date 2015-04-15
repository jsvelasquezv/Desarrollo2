<?php

if (isset($_SESSION['exitoAgregarCarrito'])) {
	$exitoAgregarCarrito = $_SESSION['exitoAgregarCarrito'];
}

if(isset($_SESSION['erroresCarritoAgregar'])){
	$erroresCarritoAgregar = $_SESSION['erroresCarritoAgregar'];
}

// foreach ($_SESSION['erroresCarritoAgregar'] as $key) {
// 	echo $key;
// }
?>