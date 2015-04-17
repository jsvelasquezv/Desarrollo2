<?php
require_once 'Comision.php';
require_once 'Validaciones.php';
Class ValidarComision
{
	private $responseComision;
	private $validacion;

	/**
	 * [__construct description]
	 */
	function __construct()
	{
		$this->validacion = new Validaciones();
	}

	/**
	 * [validaComision description]
	 * @param  [type] $comision [description]
	 * @return [type]           [description]
	 */
	public function validaComision($comision)
	{
		if (!$this->validacion->esNumerico($comision)) {
			$this->responseComision[0] = "El porcentaje debe ser numerico";

		}
		if($this->validacion->esMayor($comision, 6)){
			$this->responseComision[1] = "El porcentaje no puede contener mas de 5 digitos";
		}
		if($this->validacion->esMenor($comision, 3)){
			$this->responseComision[2] = "El porcentaje debe contener minimo 2 digitos";
		}
		else
		{
			$nuevaComision = new Comision();
			$nuevaComision->editarComision($comision);
		}
	}

    /**
     * Gets the value of responseComision.
     *
     * @return mixed
     */
    public function getResponseComision()
    {
        return $this->responseComision;
    }
}
	//$com = new ValidarComision();
	//$com->validaComision("123");
	//$er = $com->getResponseComision();
	//echo $er;
?>