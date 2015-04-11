<?php

/**
* 
*/
// require_once'../scripts/gestionarProductos.php';
require_once'../modelos/Producto.php';
require_once '../modelos/ProductoBuscar.php';
class Carrito {
	//atributos de la clase
   	private $num_productos;
   	//var $array_id_prod;
   	private $producto;
   	//private $array_precio_prod;

	//constructor. Realiza las tareas de inicializar los objetos cuando se instancian
	//inicializa el numero de productos a 0
	function __construct() {
	 	// $this->num_productos=0;
	 } 
	
	//Introduce un producto en el carrito. Recibe los datos del producto
	//Se encarga de introducir los datos en los arrays del objeto carrito
	//luego aumenta en 1 el numero de productos
	function add($nombre, $cantidad, $valor, $url, $userUsuario, $idCategoria, $estado){
		$cantidad = 1;
		$miProducto = new Producto($nombre, $cantidad, $valor, $url, $userUsuario, $idCategoria, $estado);
		if (isset($_SESSION['carrito'])) {
			$carro = $_SESSION['carrito'];
			array_push($carro, $miProducto);
			$this->producto = $carro;
		}
		else {
			$carro[0]=$miProducto;
			$this->producto = $carro;
		}
		foreach ($this->producto as $key) {
			print_r($key);
		}
		// array_push($this->producto, $miProducto);
		$this->num_productos++;
		return $this->producto;
	}


	public function obtenerProducto($nombre)
	{
		$producto = new ProductoBuscar();
		$query = $producto->getProductoPorNombre($nombre);
		return $query;		
	}	
	
	###################################################
	public function remove($nombre){

		$producto_buscar = new ProductoBuscar();
		$carro = $_SESSION['carrito'];

		foreach ($carro as $key) {
			if ($key->obtenerNombre() == $nombre) {
				$llave = array_search($producto_buscar->getProductoPorNombre($nombre),$carro);
				unset($carro[$llave]);
				
			}
		}
		$this->producto = $carro;
		return $this->producto;
	}
		
	public function getArrayProducto(){
		return $this->producto;
	}
}		

// $carrito = new Carrito();
// $carrito->add("Cama", 1, 1200, "www.abc.com", "User", 2,"En venta");
// $carrito->add("Lapicero", 1, 1200, "www.abc.com", "User", 2,"En venta");
// $carrito->add("Nevecon", 1, 1200, "www.abc.com", "User", 2,"En venta");
//echo $carrito->getAnadido()[0];
//$frijolito = $carrito->add("Lapicero");
// foreach ($carrito as $key) {
// 	echo $key;
// }

?>


