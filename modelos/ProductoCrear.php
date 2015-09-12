<?php
/**
* Clase que permite crear un producto y guardarlo en la base de datos
*/
require_once '../libs/rb.php';
require_once 'ConexionBD.php';
require_once 'Producto.php';
class ProductoCrear
{
	private $reponseCrear;
	function __construct() {
		
	}
	#Funcion que crea un producto con los parametros que se muestra
	public function crearProducto($nombre, $cantidad, $valor, $url, $userUsuario, $idCategoria, $estado)
	{
		#creo una nueva instancia de Producto con los paramtros de un producto
		$miProducto = new Producto($nombre, $cantidad, $valor, $url, $userUsuario, $idCategoria, $estado);
		R::selectDatabase('default');#Eligo la bd por defecto (tienda.sql)
		$producto = R::dispense('producto');#creo un nuevo bean de tipo producto (producto es el nombre de la tabla en la base de datos)
		#Importante: el bean hace referencia a la tabla de la base de datos, y sus atributos seran cada
		#uno de los campos de esa tabla Por ejemplo: producto->url_imagen se traduce como, de la tabla producto
		#seleccione el campo url_imagen.
		$producto->nombre = $miProducto->obtenerNombre();
		$producto->cantidad = $miProducto->obtenerCantidad();
		$producto->valor_unitario = $miProducto->obtenerValor();
		$producto->url_imagen = $miProducto->obtenerURL();
		$producto->usuario_username = $miProducto->obtenerUserUsuario();
		$producto->categoria_id = $miProducto->obtenerIdCategoria();
		$producto->estado = $miProducto->obtenerEstado();
		R::store($producto);#Se alamcena el bean ya creado en el almacén
        R::close();#se cierra el amacén
	}


}
	// $pc = new ProductoCrear();
	// $pc->crearProducto("Libro", 2, 20000, "www.libro.com", 1, 3);
?>