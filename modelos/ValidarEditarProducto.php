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
	 							   $nuevoUserUsuario, $nuevoIdCategoria, $nuevoEstado)
	{
		#Obejtos necesarios para esta gestion
		$misValidaciones = new Validaciones();
		$miProductoEditar = new ProductoEditar();
		$miProductoBuscar = new ProductoBuscar();
		#Se validan si los campos estan vacios, si deben de ser alfabeticos o no....y otras validaciones parecidas
		if($nuevoNombre == "" or $nuevaCantidad =="" or $nuevoValor == "" or $nuevoUserUsuario == "" or $nuevoIdCategoria == "" or $nuevaUrl == ""){
			$this->responseEditarProducto[0] = "Todos los campos son requeridos";
		}
		if(!$misValidaciones->esAlfabetico($nuevoNombre) ){
			$this->responseEditarProducto[1] = "El nuevo nombre debe ser alfabetico";
		}
		if ($misValidaciones->esMayor($nuevoNombre, 30)) {
			$this->responseEditarProducto[2] = "El nombre debe contener máximo 30 caracteres";
		}
		if ($misValidaciones->esMenor($nuevoNombre, 3)) {
			$this->responseEditarProducto[3] = "El nombre debe contener mínimo 3 caracteres";
		}
		if(!$misValidaciones->esNumerico($nuevaCantidad)){
			$this->responseEditarProducto[4] = "La cantidad debe ser numerica";
		}
		if(!$misValidaciones->esNumerico($nuevoValor)){
			$this->responseEditarProducto[5] = "El valor debe ser numerico";
		}
		if(!$misValidaciones->esAlfabetico($nuevoUserUsuario)){
			$this->responseEditarProducto[6] = "El nombre de usuario debe ser alfabético";
		}
		if(!$misValidaciones->esNumerico($nuevoIdCategoria)){
			$this->responseEditarProducto[7] = "El ID de la categoria debe ser numerico";
		}
		if (!$misValidaciones->esUrl($nuevaUrl)) {
			$this->responseEditarProducto[8] = "La url no tiene un formato válido";
		}
		// if (!$misValidaciones->esEstado($nuevoEstado)) {
		// 	$this->responseEditarProducto[9] = "Los unicos estados permitidos son 'En venta' y 'Vendido'";
		// }
		#Si pasa todos estos filtros el producto se podrá editar
		if(empty($this->responseEditarProducto)){
			$miProductoEditar->editarProducto($nombre, $nuevoNombre, $nuevaCantidad, $nuevoValor, $nuevaUrl,
	 							   $nuevoUserUsuario, $nuevoIdCategoria, $nuevoEstado);
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
// $vep->validarEditarProducto("Cama", 123, 4, 5666,"www.c.com","usuario", 5, "En venta");
// echo $vep->getResponse()[1];

?>