<?php
/**
* Clase que valida la modificacion de los datos de un Producto, ese producto debe de estar creado
*previamente
*/
require_once'ProductoEditar.php';
require_once'Validaciones.php';
require_once'ProductoBuscar.php';


class ValidarEditarProducto
{
	private $responseEditarProducto;#Vector de respuestas

	function __construct() {
		
	}
	#funcion que me valida la modificacion (cuando edite), un producto el parametro $nombre es para
	#que cuando vaya a editar, primero busque (con la variable $nombre), si ya existe un nombre
	#igual, (no se edita un nombre para poner el mismo nombre)
	public function validarEditarProducto($nombre, $nuevoNombre, $nuevaCantidad, $nuevoValor, $nuevaUrl,
	 							   $nuevoIdUsuario, $nuevoIdCategoria)
	{
		#Obejtos necesarios para esta gestion
		$misValidaciones = new Validaciones();
		$miProductoEditar = new ProductoEditar();
		$miProductoBuscar = new ProductoBuscar();
		#Se validan si los campos estan vacios, si deben de ser alfabeticos o no....y otras validaciones parecidas
		if($nuevoNombre == "" or $nuevaCantidad =="" or $nuevoValor == "" or $nuevoIdUsuario == "" or $nuevoIdCategoria == "" or $nuevaUrl == ""){
			$this->responseEditarProducto[0] = "Todos los campos son requeridos";
		}
		if(! ($misValidaciones->esAlfabetico($nuevoNombre)) ){
			$this->responseEditarProducto[1] = "El nuevo nombre debe ser alfabetico";
		}
		if(!$misValidaciones->esNumerico($nuevaCantidad)){
			$this->responseEditarProducto[2] = "La cantidad debe ser numerica";
		}
		if(!$misValidaciones->esNumerico($nuevoValor)){
			$this->responseEditarProducto[3] = "El valor debe ser numerico";
		}
		if(!$misValidaciones->esNumerico($nuevoIdUsuario)){
			$this->responseEditarProducto[4] = "El ID del usuario debe ser numerico";
		}
		if(!$misValidaciones->esNumerico($nuevoIdCategoria)){
			$this->responseEditarProducto[5] = "El ID de la categoria debe ser numerico";
		}
		if (!$misValidaciones->esUrl($nuevaUrl)) {
			$this->responseEditarProducto[6] = "La url no tiene un formato válido";
		}
		#Si se quiere cambiar un nombre por otro iguale entonces saldra este mensaje
		if(! empty($miProductoBuscar->buscarProducto($nombre))){
			$this->responseEditarProducto[7] = "Ya existe un producto con ese nombre, intente con otro";
		}
		#Si pasa todos estos filtros el producto se podrá editar
		else{
			$miProductoEditar->editarProducto($nombre, $nuevoNombre, $nuevaCantidad, $nuevoValor, $nuevaUrl,
	 							   $nuevoIdUsuario, $nuevoIdCategoria);
			session_start();
			unset($_SESSION['exitoEditarProducto']);

		}
	}

	public function getResponse()
	{
		return $this->responseEditarProducto;
	}
}
// $vep = new ValidarEditarProducto();
// $vep->validarEditarProducto("Camaro", "Camaro", 4, 5666,"www.c.com",4, 5);

?>