<?php
require '../scripts/gestionarCarrito.php';

$nuevoUserUsuario = $_SESSION['user'];
if(isset($_GET['agrega'])){#si se hizo click en el dibujo del lapiz de la tabla(que significa editar), entonces....
	#Usuario logueado actualmente, quien esta editando
	$nombreAgregar = $_GET['agrega']; #capturo el valor de edit, que es igual a el nombre del producto (ver en vistas), luego, editar es igual al nombre del producto seleccionado
	$_SESSION['nombreAgrega'] = $_GET['agrega'];
	// echo "Soy edit".$edit;
	// echo "<br> Soy User:".$nuevoUserUsuario;
	$miCarrito = new Carrito(); #creo una instancia de la clase de Carrito
	$loQuieroAgregar = $miCarrito->obtenerProducto($nombreAgregar);#busco el bean segun el nombre
	#Redirecciono por get hacia donde se va a editar el el Producto
	header('Location: ../vistas/agregarProducto.php?nombre='.$loQuieroAgregar['nombre'].'&cantidad='
		.$loQuieroAgregar['cantidad'].'&categoria='.$loQuieroAgregar['categoria_id']
		.'&valor='.$loQuieroAgregar['valor_unitario'].'&url='.$loQuieroAgregar['url_imagen']
		.'&estado='.$loQuieroAgregar['estado'].'&user='.$loQuieroAgregar['usuario_username']);

}
// if(isset($_POST['agregarCarrito'])){
// 	$nombreAgrega = $_SESSION['nombreAgrega'];
// 	$arreglo = $_SESSION['carrito']->add($nombreAgrega);
// 	foreach ($arreglo as $key) {
// 		echo $key;
// 	}
// }



/**
* 
*/
class CoordinadorCarrito
{
	
	function __construct() {

	}

	public function agregar($nombre)
	{
		$miCarrito = new Carrito();
		$query = $miCarrito->agregarAlCarrito($nombre);
		return $query;
			
	}
}
// $cc = new CoordinadorCarrito();
// $miQuery = $cc->agregar("Escoba");
// //echo "<br>".$miQuery;
// echo is_array($miQuery);
?>









