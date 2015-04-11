<?php
// require '../scripts/gestionarCarrito.php';
session_start();
require_once '../modelos/Carrito.php';

$nuevoUserUsuario = $_SESSION['user'];
if(isset($_GET['agrega'])){#si se hizo click en el dibujo del lapiz de la tabla(que significa editar), entonces....
	#Usuario logueado actualmente, quien esta editando
	$nombreAgregar = $_GET['agrega']; #capturo el valor de edit, que es igual a el nombre del producto (ver en vistas), luego, editar es igual al nombre del producto seleccionado
	$_SESSION['nombreAgrega'] = $_GET['agrega'];
	// echo "Soy edit".$edit;
	// echo "<br> Soy User:".$nuevoUserUsuario;
	$miCoordinadorCarrito = new CoordinadorCarrito(); #creo una instancia de la clase de Carrito
	$loQuieroAgregar = $miCoordinadorCarrito->obtenerProducto($nombreAgregar);#busco el bean segun el nombre
	//echo "Lo quiero agregar".$loQuieroAgregar;
	#Redirecciono por get hacia donde se va a editar el el Producto
	header('Location: ../vistas/agregarProducto.php?nombre='.$loQuieroAgregar['nombre'].'&cantidad='
		.$loQuieroAgregar['cantidad'].'&categoria='.$loQuieroAgregar['categoria_id']
		.'&valor='.$loQuieroAgregar['valor_unitario'].'&url='.$loQuieroAgregar['url_imagen']
		.'&estado='.$loQuieroAgregar['estado'].'&user='.$loQuieroAgregar['usuario_username']);

}
if(isset($_POST['agregarCarrito'])){
	
	$nombreAgrega = $_SESSION['nombreAgrega'];
	//echo $nombreAgrega;
	$miCarrito = new CoordinadorCarrito();
	$producto = $miCarrito->obtenerProducto($nombreAgrega);
	//La cantidad debe de ir incrementando de 1 en 1....falta agregar eso.
	$_SESSION['carrito'] = $miCarrito->agregar($producto['nombre'], $producto['cantidad'], $producto['valor_unitario'],
							$producto['url_imagen'], $producto['usuario_username'], $producto['categoria_id'], $producto['estado']);

		
	

	foreach ($_SESSION['carrito'] as $key) {
		//$key = array_push($_SESSION['carrito'], $producto);	 
		echo print_r($key);
	}

	// foreach ($_SESSION as $key) {
	// 	# code...
	// 	array_push($_SESSION['carrito'], $key);
	// }

	// echo "Fuera del for".print_r($_SESSION['carrito']);
	// foreach ($_SESSION['carrito'] as $key) {
	// 	echo "Dentro del for".print_r($key);
	// }
	//header('Location: ../vistas/compras.php');
	// foreach ($_SESSION['carrito'] as $key) {
	// 	print_r($key);
	// }

// 	$nombreAgrega = $_SESSION['nombreAgrega'];
// 	$arreglo = $_SESSION['carrito']->add($nombreAgrega);
// 	foreach ($arreglo as $key) {
// 		echo $key;
// 	}
}



/**
* 
*/
class CoordinadorCarrito
{

	function __construct() {
		
	}

	public function agregar($nombre, $cantidad, $valor, $url, $userUsuario, $idCategoria, $estado)
	{
		$miCarrito = new Carrito();
		$queryArray = $miCarrito->add($nombre, $cantidad, $valor, $url, $userUsuario, $idCategoria, $estado);
		return $queryArray;#Retorna un array, y dentro de ese array abran objetos producto
		//return $query;
			
	}
	public function obtenerProducto($nombre)
	{
		$miCarrito = new Carrito();
		$query = $miCarrito->obtenerProducto($nombre);
		return $query;
	}
}
// $cc = new CoordinadorCarrito();
// $miQuery = $cc->agregar("Cama", 1, 1200, "www.abc.com", "User", 2,"En venta");
// $cc->agregar("Cama", 1, 1200, "www.abc.com", "User", 2,"En venta");
// $cc->agregar("Lapicero", 1, 1200, "www.abc.com", "User", 2,"En venta");

//echo "<br>".$miQuery;
//echo print_r($miQuery);
?>









