<?php

/**
* 
*/
// require_once'../scripts/gestionarProductos.php';
require_once'../modelos/Producto.php';
require_once '../modelos/ProductoBuscar.php';
require_once '../modelos/Validaciones.php';
class Carrito {
	//atributos de la clase
   	//private $num_productos;
   	//var $array_id_prod;
   	private $arrayDeProductos;
   	private $misValidaciones;
   	//private $array_precio_prod;

	//constructor. Realiza las tareas de inicializar los objetos cuando se instancian
	//inicializa el numero de productos a 0
	function __construct() {
	 	$this->misValidaciones = new Validaciones();
	 } 
	
	//Introduce un producto en el carrito. Recibe los datos del producto
	//Se encarga de introducir los datos en los arrays del objeto carrito
	//luego aumenta en 1 el numero de productos
	function add($nombre, $cantidad, $valor, $url, $userUsuario, $idCategoria, $estado){

		$new_product = array(array("nombre"=> $nombre, "cantidad"=>$cantidad, "valor"=>$valor, "url"=>$url,
								   "username"=>$userUsuario, "idCategoria"=>$idCategoria, "estado"=>$estado));
		
		if (isset($_SESSION['carrito'])) {#Si la variable de session está seteada entonces
			$found = false;#establecesmo a false la variable encontrado
			foreach ($_SESSION['carrito'] as $product) {#para cada producto que este en la variable de session
				if ($product["nombre"] == $nombre) {#Si el nombre de el producto que este en la variable de session es igual al nombre del nuevo producto entonces
					$producto[] = array('nombre'=>$product["nombre"], 'cantidad'=>$cantidad,#la cantidad no se actualiza
										'valor'=>$product["valor"], 'url'=>$product["url"], 'username'=>$product["username"],
										'idCategoria'=>$product["idCategoria"], 'estado'=>$product["estado"]
										);
					$found = true;
				}#fin if
				else{
					$producto[] = array('nombre'=>$product["nombre"], 'cantidad'=>$product['cantidad'],#la cantidad se actualiza
										    'valor'=>$product["valor"], 'url'=>$product["url"], 'username'=>$product["username"],
										    'idCategoria'=>$product["idCategoria"], 'estado'=>$product["estado"]
										);
				}#fin else		
			}#fin for
			if ($found == false) {#Si no se encontró el producto en la variable de session
				$this->arrayDeProductos = array_merge($producto, $new_product);
			}
			else $this->arrayDeProductos = $producto;
		}#fin if(SESSION['carrito'])
		else $this->arrayDeProductos = $new_product;

		//print_r($this->arrayDeProductos);
		return $this->arrayDeProductos;
	}#fin add

	#Funcion que me trae la cantidad de productos disponibles en Stock, segun el nombre del producto
	public function getCantidad($nombre)
	{
		// echo isset($_SESSION['todosLosProductos']);
		if (isset($_SESSION['todosLosProductos'])) {
			// echo "hola";
			foreach ($_SESSION['todosLosProductos'] as $key) {
				if ($key["nombre"] == $nombre) {
					$cantidad = $key["cantidad"];
				}
			}
		}
		//echo $cantidad;
		return $cantidad;
	}

	public function remove($nombre){
		if (isset($_SESSION['carrito'])) {
			foreach ($_SESSION['carrito'] as $product) {
				if ($product["nombre"] != $nombre) {
					echo "Hola1";
					$cantidad = $product["cantidad"];
					$producto[] = array('nombre'=>$product["nombre"], 'cantidad'=>$cantidad,#la cantidad se actualiza
										    'valor'=>$product["valor"], 'url'=>$product["url"], 'username'=>$product["username"],
										    'idCategoria'=>$product["idCategoria"], 'estado'=>$product["estado"]
										);
				}
				$this->arrayDeProductos = $producto;
			}
		}
		return $this->arrayDeProductos;
	}

	public function obtenerProducto($nombre)
	{
		$producto = new ProductoBuscar();
		$query = $producto->getProductoPorNombre($nombre);
		return $query;		
	}	
	
	###################################################
		
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


