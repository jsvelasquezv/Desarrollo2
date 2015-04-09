<?php

/**
* 
*/
// require_once'../scripts/gestionarProductos.php';
require_once'ProductoBuscar.php';
class Carrito 
{
	// $producto = $_SESSION['productos'];
	private $numeroProductos;
	function __construct(){
		$this->numeroProductos = 0;
	}
			
	public function agregarAlCarrito($nombre){
		$producto = new ProductoBuscar();
		$query = $producto->getProductoPorNombre($nombre);
		$this->numeroProductos++;
		return $query;
	}

	public function retirarDelCarrito($nombre){
		$producto = new ProductoBuscar();
		$query = $producto->getProductoPorNombre($nombre);
		$this->numeroProductos--;
		unset($query);
	}
		
}		

// $carrito = new Carrito();
// $frijolito = $carrito->agregarAlCarrito("Boligrafo");
// echo $frijolito['id'];
?>


