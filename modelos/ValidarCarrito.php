<?php
/**
* 
*/
require_once 'Carrito.php';
require_once 'Validaciones.php';
class ValidarCarrito
{
	private $responseCarrito;

	function __construct() {
		
	}

	public function validarAgregarAlCarrito($nombre, $cantidad, $valor, $url, $userUsuario, $idCategoria, $estado)
	{
		$misValidaciones = new Validaciones();
		$miCarrito = new Carrito();

		if ($cantidad == "") {
			$this->responseCarrito[0] = "El campo cantidad es obligatorio";
		}
		if (! $misValidaciones->esNumerico($cantidad)) {
			$this->responseCarrito[1] = "La cantidad debe de ser numerica";
		}
		if ($cantidad > $miCarrito->getCantidad($nombre)) {
			$this->responseCarrito[2] = "La cantidad del producto que desea no está disponible";
		}
		if (! empty($this->responseCarrito)) {
			$conflictos = $this->responseCarrito;
			
		}
		else{
			$conflictos = 0;
			return $miCarrito->add($nombre, $cantidad, $valor, $url, $userUsuario, $idCategoria, $estado);
		}

	}


	public function getResponse(){
		return $this->responseCarrito;
	}
}

// $vc = new ValidarCarrito();
// $vc->validarAgregarAlCarrito("Nevecon","asd", 12, "www,ejemplo.com", "sssss", 2, "En venta");
// echo "Errores ".$vc->getResponse()[1];

?>