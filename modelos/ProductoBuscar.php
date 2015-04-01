<?php
/**
* Clase que me permitira buscar un producto
*/
require_once '../libs/rb.php';
require_once 'ConexionBD.php';
class ProductoBuscar
{
	
	function __construct() {
		
	}
	#Funcion para buscar un producto, el producto se busca segun su nombre
	public function buscarProducto($nombre)
	{
		R::selectDatabase('default');#Se selecciona la BD por default (tienda.sql)
		$producto = R::findOne('producto', 'nombre = ?',[$nombre]);#Asi se busca un (finOne) producto, recibe el nombre de la tabla, el campo donde va a buscar, y el nombre para que compare con ese campo
		R::close();#se cierra el almacén de Beans
		return $producto;	
	}
}

	// $pb = new ProductoBuscar();
	// $consulta = $pb->buscarProducto("Moto Mas Grande");
	// echo $consulta;
?>