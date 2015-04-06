<?php
require_once 'CategoriaBuscar.php';
require_once 'Validaciones.php';

Class ValidarCategoriaBuscar
{
	private $categoriaBuscarModelo;
	private $validaBusquedaCat;
	private $responseBuscarCategoria;

	/**
	 * [__construct description]
	 */
	function __construct()
	{
		$this->categoriaBuscarModelo = new CategoriaBuscar();
		$this->validaBusquedaCat = new Validaciones();
	}

	/**
	 * [validarBusquedaCategoria description]
	 * @param  [type] $nombre [description]
	 * @return [type]         [description]
	 */
	public function validarBusquedaCategoria($nombre)
	{
		if (!$this->validaBusquedaCat->esAlfabetico($nombre)) {
			$this->responseBuscarCategoria = "El nombre debe ser alfabetico";
		}
		elseif ($this->validaBusquedaCat->esMenor($nombre, 3)) {
			$this->responseBuscarCategoria = "El nombre debe contener minimo 3 caracteres";
		}
		elseif ($this->validaBusquedaCat->esMayor($nombre, 30)) {
			$this->responseBuscarCategoria = "El nombre debe contener maximo 30 caracteres";
		}
		else
		{
			$categoria = $this->categoriaBuscarModelo->buscarCategoria($nombre);
			if(empty($categoria)){
				$this->responseBuscarCategoria = "No existe la categoria ".$nombre;
			}
			else{
				return $categoria;
			}	
		}
	}


    /**
     * Gets the value of responseBuscarCategoria.
     *
     * @return mixed
     */
    public function getResponseBuscarCategoria()
    {
        return $this->responseBuscarCategoria;
    }
}
	//Prueba
	//$val = new ValidarCategoriaBuscar();
	//$val->validarBusquedaCategoria("ho");
	//$cat = $val->validarBusquedaCategoria("Aseo");
	//$error = $val->getResponseBuscarCategoria();
	//echo $error;
	//echo $cat['nombre'];
?>