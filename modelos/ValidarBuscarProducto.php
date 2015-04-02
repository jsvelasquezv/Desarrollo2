<?php
/**
* Clase que valida la busqueda (consulta) de un producto
*/
require_once'ProductoBuscar.php';
require_once'Validaciones.php';
class ValidarBuscarProducto
{
	private $responseBuscarProducto;#Vector de respuestas
	
	function __construct() {
	}
	#Funcion que valida la busqueda correcta de un producto
	public function validarBuscarProducto($nombre)
	{
		#necesito dos objetos, uno de la clase Validaciones y uno de la clase ProductoBuscar
		$miProductoBuscar = new ProductoBuscar();
		$misValidaciones = new Validaciones();
		#Si el nombre es alfabetico entonces se procede a buscar el producto
		if($misValidaciones->esAlfabetico($nombre)){
			$query = $miProductoBuscar->buscarProducto($nombre);#query almacena la consulta
			#si esa consulta está vacia es porque el producto no existe en la BD
			if(empty($query)){
				$this->responseBuscarProducto[0] = "El producto no existe";
			}
			#Si no está vacia se muestra la consulta
			else return $query;	
		}
		#Si el nombre no es alfabetico no se puedo iniciar la busqueda
		else $this->responseBuscarProducto[0] = "El nombre debe ser alfabetico";
	}

	#Funcion que me trae todos los productos de la base de datos
	public function buscarTodos(){
		$miProductoBuscar = new ProductoBuscar();
		$productos = $miProductoBuscar->getProductos();
		return $productos;
	}

	public function getResponse()
	{
		return $this->responseBuscarProducto;
	}
}

// $vbp = new ValidarBuscarProducto();
// $arreglo =  $vbp->buscarTodos();
// foreach ($arreglo as $key) {
// 	echo $key;
// }
// echo $vbp->getResponse()[0];

?>