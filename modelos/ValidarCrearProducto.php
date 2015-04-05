<?php
/**
* Clase que valida si en verdad se puede o no crear y guardar un producto nuevo en la base de datos
* Valida que los campos que se van a ingresar a la bd sean correctos	
*/
require_once 'Validaciones.php';
require_once 'ProductoCrear.php';
class ValidarCrearProducto
{
	#Array que me guardara en una posicion determinada el tipo de error que fiera lugar
	private $responseValidarProducto;

	function __construct() {
		
	}
	#Funcion que valida si se crea o no el Producto
	public function validarCrearProducto($nombre, $cantidad, $valor, $url, $userUsuario, $idCategoria, $estado)
	{
		#Necestio dos obejtos, uno de Validaciones y uno ProductoCrear
		$miProductoCrear = new ProductoCrear();
		$misValidaciones = new Validaciones();
		#Se valida si los campos estan vacios, si son numericos o si son alfabeticos segun el caso
		#Cada mensaje de error se guarda en una posicion en un array (responseValidarProducto)
		if($nombre == "" or $cantidad =="" or $valor == "" or $userUsuario == "" or $idCategoria == ""
			or $url ==""){
			$this->responseValidarProducto[0] = "Todos los campos son requeridos";
		}
		if ($misValidaciones->esMayor($nombre, 30)) {
			$this->responseValidarProducto[1] = "El nombre debe contener máximo 30 caracteres";
		}
		if ($misValidaciones->esMenor($nombre, 3)) {
			$this->responseValidarProducto[2] = "El nombre debe contener mínimo 3 caracteres";
		}
		if(! ($misValidaciones->esAlfabetico($nombre)) ){
			$this->responseValidarProducto[3] = "El nombre debe ser alfabetico";
		}
		if(!$misValidaciones->esNumerico($cantidad)){
			$this->responseValidarProducto[4] = "La cantidad debe ser numerica";
		}
		if(!$misValidaciones->esNumerico($valor)){
			$this->responseValidarProducto[5] = "El valor debe ser numerico";
		}
		if(!$misValidaciones->esAlfabetico($userUsuario)){
			$this->responseValidarProducto[6] = "Error en el logueo, un usuario tiene un user numerico";
		}
		if(!$misValidaciones->esNumerico($idCategoria)){
			$this->responseValidarProducto[7] = "El ID de la categoria debe ser numerico";
		}
		if (!$misValidaciones->esUrl($url)) {
			$this->responseValidarProducto[8] = "La url no tiene un formato válido";
		}
		// if(!$misValidaciones->esEstado($estado)){
		// 	$this->responseValidarProducto[7] = "'En venta' y 'Vendido' son los dos únicos estados posibles";
		// }
		#Si el array no esta vacio, es porque sucedio un error, en caso tal se crea una variable
		#que me guarda ese error
		if (!empty($this->responseValidarProducto)) {
			$conflictos = $this->responseValidarProducto;
		}
		#Si se pasan todos los filtros entonces es porque no hay errores, asi que se puede crear y guardar
		#el producto en la BD.
		else{
			$miProductoCrear->crearProducto($nombre, $cantidad, $valor, $url, $userUsuario, $idCategoria, "En venta");
			$conflictos = 0;#No hay conflictos
		}

	}
	public function getResponse()
	{
		return $this->responseValidarProducto;
	}
}
// $vcp = new ValidarCrearProducto();
// $vcp->validarCrearProducto("Yate", 1, 1120, "www.yate muy bonito", "Admin", 5, "Abono una parte");
// echo $vcp->getResponse()[0];
// echo $vcp->getResponse()[1];
// echo $vcp->getResponse()[2];
// echo $vcp->getResponse()[3];
// echo $vcp->getResponse()[4];
// echo $vcp->getResponse()[5];
// echo $vcp->getResponse()[6];
// echo $vcp->getResponse()[7];

?>