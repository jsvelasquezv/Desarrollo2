<?php
require_once '../modelos/ValidarCategoriaBuscar.php';

if(isset($_POST['buscarC'])){
	$nombre = $_POST['nombre'];
	$categoriaBuscada = new CoordinadorCategoriaBuscar();
	$registro = $categoriaBuscada->coordinaBuscarCategoria($nombre);
	if (empty($registro)) {
			session_start();
			$_SESSION['errorBuscarCategoria'] = "Se ha presentado un error en la busqueda";
			header('Location: ../vistas/categorias.php');
		}
		else{
			header('Location: ../vistas/editarCategoria.php?nombre='.$registro['nombre'].'&diagnostico='
		.$registro['descripcion']);
		}
}

Class CoordinadorCategoriaBuscar
{
	private $valCategoria;

	/**
	 * [__construct description]
	 */
	function __construct()
	{
		$this->valCategoria = new ValidarCategoriaBuscar();
	}

	/**
	 * [coordinaBuscarCategoria description]
	 * @param  [type] $nombre [description]
	 * @return [type]         [description]
	 */
	public function coordinaBuscarCategoria($nombre)
	{
		$categoria = $this->valCategoria->validarBusquedaCategoria($nombre);
		return $categoria;
	}
}

	//Prueba
	//$c = new CoordinadorCategoriaBuscar();
?>