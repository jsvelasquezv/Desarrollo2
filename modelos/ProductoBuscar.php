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
	public function buscarProducto($nombre, $userUsuario)
	{
		R::selectDatabase('default');#Se selecciona la BD por default (tienda.sql)
		// $producto = R::getAll('SELECT * FROM producto WHERE nombre = :nombre AND usuario_username = :user',
		// 						[':nombre' => $nombre, ':user' => $userUsuario]	);#Asi se busca un (finOne) producto, recibe el nombre de la tabla, el campo donde va a buscar, y el nombre para que compare con ese campo
		$producto = R::findOne('producto', 'nombre = ? AND usuario_username = ?', [$nombre, $userUsuario]);
		R::close();#se cierra el almacén de Beans
		return $producto;	
	}

	#Esta funcion me trae de la base de datos todos los productos que un usuario halla creado, es importante
	#saber que un usuario no puede ver los productos creados por otros usuarios, es por eso que
	#se hace esta funcion, en las vistas se mostrara solo aquellos productos creados por un usuario y solo
	#por ese usuario
	public function getProductosUser($userUsuario){
		R::selectDatabase('default');#Se selecciona la BD por default (tienda.sql)
		$producto = R::findAll('producto', 'usuario_username = ?',[$userUsuario]);#Asi se busca un (finAll) producto, recibe el nombre de la tabla, el campo donde va a buscar, y el nombre para que compare con ese campo
		R::close();#se cierra el almacén de Beans
		return $producto;
	}
	#Esta funcion me retorna un producto de acuerdo a su nombre, se usa en el carrito de compras para 
	#agregar al carro un producto
	public function getProductoPorNombre($nombre){
		R::selectDatabase('default');#Se selecciona la BD por default (tienda.sql)
		$producto = R::findOne('producto', 'nombre = ?', [$nombre]);#Me retorna todos los productos de la base de datos
		R::close();#se cierra el almacén de Beans
		return $producto;
	}
	#Esta funcion me retorna todos los productos de la base de datos
	public function getProductosVenta($estado){
		R::selectDatabase('default');#Se selecciona la BD por default (tienda.sql)
		$producto = R::findAll('producto', 'estado = ?', [$estado]);#Me retorna todos los productos de la base de datos
		R::close();#se cierra el almacén de Beans
		return $producto;
	}


}

	// $pb = new ProductoBuscar();
	// // print $pb->existeElNombre("Mot");
	// $arreglo = $consulta = $pb->getProductoPorNombre("Boligrafo");

	// echo $arreglo;
	
?>