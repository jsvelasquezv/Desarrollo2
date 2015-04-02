<?php
/**
* 
*/
require_once'../libs/rb.php';
require_once'ConexionBD.php';
require_once'Producto.php';
class ProductoEditar
{
	
	function __construct() {
	
	}
	#Funcion que permite editar un producto que ha sido previamente ya creado, recibe los nuevos
	#parametros que seran reemplazados por los antiguas, el parametro nombre me busca el producto
	#que quiero editar y me trae ese registro, ya con todo el registro si se procede con la actualización.
	public function editarProducto($nombre, $nuevoNombre, $nuevaCantidad, $nuevoValor, $nuevaUrl,
	 							   $nuevoUserUsuario, $nuevoIdCategoria)
	{
		$miProducto = new Producto($nuevoNombre, $nuevaCantidad, $nuevoValor, $nuevaUrl,
	 							   $nuevoUserUsuario, $nuevoIdCategoria);#Se crea un nuevo producto con los nuevos parametros
		R::selectDatabase('default');#Se selecciona la BD por default (tienda.sql)
        $producto = R::findOne('producto', 'nombre = ?',[$nombre]);#Se busca el registro por el nombre
		
		#Se actualizan todos los campos del registro que ya traje con la linea anterior
		$producto->nombre = $miProducto->obtenerNombre();
		$producto->cantidad = $miProducto->obtenerCantidad();
		$producto->valor_unitario = $miProducto->obtenerValor();
		$producto->url_imagen = $miProducto->obtenerURL();
		$producto->usuario_username = $miProducto->obtenerUserUsuario();
		$producto->categoria_id = $miProducto->obtenerIdCategoria();
		R::store($producto);#Se guarda el bean en el almacén
        R::close();#Se cierra el amacén.
	}
}
 // $pe = new ProductoEditar();
 // $pe->editarProducto("Materazi", "Camaro", 10, 1000000, "www.supercarro.com", 5, 6);
?>