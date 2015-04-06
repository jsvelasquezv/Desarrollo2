<?php
require_once '../modelos/ValidarCategoriaCrear.php';

if (isset($_POST['crear'])) {
	$nombre = $_POST['nombre'];
	$descripcion = $_POST['diagnostico'];		
	$CoordinadorCategoriaCrear = new CoordinadorCategoriaCrear();
	$CoordinadorCategoriaCrear->creaCategoria($nombre, $descripcion);
}

Class CoordinadorCategoriaCrear
{
	private $validaCreacion;

	/**
	 * [__construct description]
	 */
	function __construct()
	{
		$this->validaCreacion = new ValidarCategoriaCrear();
	}

	/**
	 * [creaCategoria description]
	 * @param  [type] $nombre      [description]
	 * @param  [type] $descripcion [description]
	 * @return [type]              [description]
	 */
	public function creaCategoria($nombre, $descripcion)
	{
		$this->validaCreacion->validarCrearCategoria($nombre, $descripcion);
		$erroresCrearCategoria = $this->validaCreacion->getResponseCategoriaCrear();
		if (!empty($erroresCrearCategoria)) {
			session_start();
			$_SESSION['erroresCreacionCategoria'] = $erroresCrearCategoria;		
			header('Location: ../vistas/categorias.php');		
		}
		else{
			$_SESSION['erroresCreacionCat'] = 0;
			unset($_SESSION['erroresCreacionCategoria']);
			header('Location: ../vistas/categorias.php');
		}
			
		foreach ($_SESSION['erroresCreacionCategoria'] as $elementos ) {
			echo $elementos;
		}
	}
}
	//Prueba
	//$prueb = new CoordinadorCategoriaCrear();
	//$prueb->creaCategoria(1234,"Productos relacionados con el cuidado personal");
?>