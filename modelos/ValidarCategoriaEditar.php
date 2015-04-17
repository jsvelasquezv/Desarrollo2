<?php
require_once 'CategoriaEditar.php';
require_once 'Validaciones.php';

Class ValidarCategoriaEditar
{
	private $categoriaEditarModel;
	private $validarEdicion;
	private $responseEdicion;


	/**
	 * [__construct description]
	 */
	function __construct()
	{
		$this->categoriaEditarModel = new CategoriaEditar();
		$this->validarEdicion = new Validaciones();
	}

	/**
	 * [validaEditarCategoria description]
	 * @param  [type] $nombre           [description]
	 * @param  [type] $nuevoNombre      [description]
	 * @param  [type] $nuevaDescripcion [description]
	 * @return [type]                   [description]
	 */
	public function validaEditarCategoria($nombre, $nombreNuevo, $nuevaDescripcion)
	{
		if (!$this->validarEdicion->esAlfabetico($nombreNuevo)) {
			$this->responseEdicion[1] = "El nombre debe ser alfabetico";
		}
		if ($this->validarEdicion->esMenor($nombreNuevo, 3)) {
			$this->responseEdicion[2] = "El nombre debe contener minimo 3 caracteres";
		}
		if ($this->validarEdicion->esMayor($nombreNuevo, 30)) {
			$this->responseEdicion[3] = "El nombre debe contener maximo 30 caracteres";
		}
		if (!$this->validarEdicion->esAlfanumerico($nuevaDescripcion)) {
			$this->responseEdicion[4] = "La descripcion debe ser alfanumerica";
		}
		if ($this->validarEdicion->esMenor($nuevaDescripcion, 3)) {
			$this->responseEdicion[5] = "La descripcion debe contener minimo 3 caracteres";
		}
		if ($this->validarEdicion->esMayor($nuevaDescripcion, 150)) {
			$this->responseEdicion[6] = "La descripcion debe contener maximo 150 caracteres";
		}		
		if (empty($this->responseEdicion)) {
			$this->categoriaEditarModel->editarCategoria($nombre, $nombreNuevo, $nuevaDescripcion);
			session_start();
			unset($_SESSION['exitoEditarCategoria']);
		}
	}


    /**
     * Gets the value of responseEdicion.
     *
     * @return mixed
     */
    public function getResponseEdicion()
    {
        return $this->responseEdicion;
    }
}
	//Prueba
	//$e = new ValidarCategoriaEditar();
	//$e->validaEditarCategoria("Salud", "Muebles", "Articulos para la sala desde 3000 pesos");
	//$err = $e->getResponseEdicion();
	//foreach ($err as $key) {
	//	echo $key;
	//}
?>