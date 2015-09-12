<?php
require_once 'Validaciones.php';
require_once 'CategoriaCrear.php';

Class ValidarCategoriaCrear
{
	private $responseCategoriaCrear;
	private $categoriaCrearModelo;
	private $validar;

	function __construct()
	{
		$this->categoriaCrearModelo = new CategoriaCrear();
		$this->validar = new Validaciones();
	}

	public function validarCrearCategoria($nombre, $descripcion)
	{
		if ($nombre == "" or $descripcion == "") {
			$this->responseCategoriaCrear[0] = "Ingresa un nombre y una descripcion";
		}
		if (!$this->validar->esAlfabetico($nombre)) {
			$this->responseCategoriaCrear[1] = "El nombre debe ser alfabetico";
		}
		if ($this->validar->esMenor($nombre, 3)) {
			$this->responseCategoriaCrear[2] = "El nombre debe contener minimo 3 caracteres";
		}
		if ($this->validar->esMayor($nombre, 30)) {
			$this->responseCategoriaCrear[3] = "El nombre debe contener maximo 30 caracteres";
		}
		if (!$this->validar->esAlfanumerico($descripcion)) {
			$this->responseCategoriaCrear[4] = "La descripcion debe ser alfanumerica";
		}
		if ($this->validar->esMenor($descripcion, 3)) {
			$this->responseCategoriaCrear[5] = "La descripcion debe contener minimo 3 caracteres";
		}
		if ($this->validar->esMayor($descripcion, 150)) {
			$this->responseCategoriaCrear[6] = "La descripcion debe contener maximo 150 caracteres";
		}
		//Falta verificar que la categoria a crear no exista ya
		if (empty($this->responseCategoriaCrear)) {
			$this->categoriaCrearModelo->crearCategoria($nombre, $descripcion);
		}
	}

    /**
     * Gets the value of responseCategoriaCrear.
     *
     * @return mixed
     */
    public function getResponseCategoriaCrear()
    {
        return $this->responseCategoriaCrear;
    }
}
	//Prueba
	//$val = new ValidarCategoriaCrear();
	//$val->validarCrearCategoria("Salud", "Productos relacionados con el cuidado de la salud");
	//$error = $val->getResponseCategoriaCrear();
	//foreach ($error as $key) {
	//	echo $key;
	//}
?>