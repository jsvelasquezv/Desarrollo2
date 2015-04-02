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
	#Funcion que me retorna todos los productos presentes en la base de datos
	public function getProductos(){
		R::selectDatabase('default');
        $producto = R::findAll('producto');
        R::close();
        return $producto;
	}
}

	// $pb = new ProductoBuscar();
	// $arreglo = $consulta = $pb->getProductos();

	// foreach ($arreglo as $key) {
	// 	echo $key;
	// }
	
?>