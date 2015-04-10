<?php

/**
* 
*/
// require_once'../scripts/gestionarProductos.php';
require_once'ProductoBuscar.php';
class Carrito 
{
	// $producto = $_SESSION['productos'];
	private $carrito;
	private $numeroProductos;
	//seteamos el carrito exista o no exista en el constructor
	public function __construct()
	{
		$this->numeroProductos = 0;
	}
			
	public function obtenerProducto($nombre){
		$producto = new ProductoBuscar();
		$query = $producto->getProductoPorNombre($nombre);
		$this->numeroProductos++;
		return $query;
	}

	public function add($nombre)
	{
		$producto = $this->obtenerProducto($nombre);
		$carrito[$this->numeroProductos] = $producto;
		// foreach ($carrito as $key ) {
		// 	echo $key;
		// }
		$this->numeroProductos++;
	}
	public function getAnadido()
	{
		return $this->carrito;
	}

	public function retirarDelCarrito($nombre){
		$producto = new ProductoBuscar();
		$query = $producto->getProductoPorNombre($nombre);
		$this->numeroProductos--;
		unset($query);
	}
		
}		

$carrito = new Carrito();
$frijolito = $carrito->add("Cama");
echo $carrito->getAnadido()[0];
//$frijolito = $carrito->add("Lapicero");
// foreach ($carrito as $key) {
// 	echo $key;
// }

?>


