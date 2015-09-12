<?php
// require '../scripts/gestionarCarrito.php';
require_once '../modelos/ValidarCarrito.php';
require_once '../modelos/Carrito.php';

session_start();

$nuevoUserUsuario = $_SESSION['user'];

#Aca hago la gestion para cuando voy a agregar productos al carrito
if(isset($_GET['agregarAlCarrito'])){
	$cantidad = $_GET['cantidadAComprar'];
	// echo "Hola";
	// echo "<br>".$cantidad."<br>";
	$nombreAgrega = $_GET['nameProduct'];

	$miCoordinadorCarrito = new CoordinadorCarrito();
	$producto = $miCoordinadorCarrito->obtenerProducto($nombreAgrega);
	// print_r($producto);
	//La cantidad debe de ir incrementando de 1 en 1....falta agregar eso.


	$_SESSION['carrito'] = $miCoordinadorCarrito->agregar($producto['nombre'], $cantidad, $producto['valor_unitario'],
							$producto['url_imagen'], $producto['usuario_username'], $producto['categoria_id'], $producto['estado']);
	// print_r($_SESSION['carrito']);
	// foreach ($_SESSION['carrito'] as $key) {
	// 	echo $key['nombre'];
	// }
	
}
#Aca hago la gestion para cuando voy a remover del carrito
if (isset($_GET['nombre'])) {
	$_SESSION['exitoCarritoEliminar'] = 0;#Seteo una variable de session para luego usarla en las vistas para mandar un modal cuando se elimine el prodcto, no es necesario hacer validaciones para eliminar un producto del carrito
	$eliminar = $_GET['nombre']; #nombre del producto que quiero remover del carrito
	$miCoordinadorCarrito = new CoordinadorCarrito();
	$_SESSION['carrito'] =  $miCoordinadorCarrito->eliminar($eliminar);

	header('Location: ../vistas/compras.php');
	// foreach ($_SESSION['carrito'] as $key) {
	// 	echo "Hola".print_r($key);
	// }
}

/**
* 
*/
class CoordinadorCarrito
{

	private $miCarritoValidado;
	private $miCarrito;
	function __construct() {
		$this->miCarritoValidado = new ValidarCarrito();
		$this->miCarrito = new Carrito();
	}

	public function agregar($nombre, $cantidad, $valor, $url, $userUsuario, $idCategoria, $estado)
	{
		//$this->miCarrito = new Carrito();
		
		$queryArray = $this->miCarritoValidado->validarAgregarAlCarrito($nombre, $cantidad, $valor, $url, $userUsuario, $idCategoria, $estado);	
		$errores = $this->miCarritoValidado->getResponse();
		
		if (! empty($errores)) {#Si hay errores entonces los acumulamos en una nueva vriable de session
			// echo 'HOLA'.print_r($errores);
			$_SESSION['erroresCarritoAgregar'] = $errores;
			header('Location: ../vistas/compras.php');
		}
		else{#Si no hay errores entonces si podemos agregar el producto
			$_SESSION['exitoAgregarCarrito'] = 0;
			unset($_SESSION['erroresCarritoAgregar']);
			header('Location: ../vistas/compras.php');
			return $queryArray;
			
			//return $queryArray;#Retorna un array, y dentro de ese array habran objetos producto
		}
			
	}
	public function obtenerProducto($nombre)
	{
		//$this->miCarrito = new Carrito();
		$query = $this->miCarrito->obtenerProducto($nombre);
		return $query;
	}
	public function eliminar($nombre){
	       $query = $this->miCarrito->remove($nombre);			
	       return $query;

	}
}
// $cc = new CoordinadorCarrito();
// $miQuery = $cc->agregar("Cama", 1, 2, "www.abc.com", "User", 2,"En venta");
// foreach ($miQuery as $key) {
// 	echo $key;
// }
// $cc->agregar("Cama", 1, 1200, "www.abc.com", "User", 2,"En venta");
// $cc->agregar("Lapicero", 1, 1200, "www.abc.com", "User", 2,"En venta");

//echo "<br>".$miQuery;
//echo print_r($miQuery);
?>









