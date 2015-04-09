<?php
require_once '../modelos/ValidarCategoriaEditar.php';
require_once '../modelos/ValidarCategoriaBuscar.php';

if (isset($_GET['edit'])) {
	$nombreA = $_GET['edit'];
	$categoriaBuscada = new ValidarCategoriaBuscar();
	$registro = $categoriaBuscada->validarBusquedaCategoria($nombreA);
	header('Location: ../vistas/editarCategoria.php?nombre='.$registro['nombre'].'&diagnostico='
		.$registro['descripcion']);
}

if(isset($_POST['editar']))
{
	$nombre = $_POST['nombre'];
	$nombreAntiguo = $_POST['antiguo'];
	$descripcion = $_POST['diagnostico'];
	$edicion = new CoordinadorCategoriaEditar();
	$edicion->editarCategoriaCoordinador($nombreAntiguo, $nombre, $descripcion);

}

Class CoordinadorCategoriaEditar
{
	private $validaEdicion;
	private $buscar;

	/**
	 * [__construct description]
	 */
	function __construct()
	{
		$this->validaEdicion = new ValidarCategoriaEditar();
		$this->buscar = new ValidarCategoriaBuscar();
	}


	/**
	 * [editarCategoriaCoordinador description]
	 * @param  [type] $nombre           [description]
	 * @param  [type] $nuevoNombre      [description]
	 * @param  [type] $nuevaDescripcion [description]
	 * @return [type]                   [description]
	 */
	public function editarCategoriaCoordinador($nombre, $nuevoNombre, $nuevaDescripcion)
	{
		$edita = $this->validaEdicion->validaEditarCategoria($nombre, $nuevoNombre, $nuevaDescripcion);
		$error = $this->validaEdicion->getResponseEdicion();
		$categoria = $this->buscar->validarBusquedaCategoria($nombre);
		if (!empty($error)) {
			session_start();
			$_SESSION['erroresEditarCategoria'] = $error;	
			header('Location: ../vistas/editarCategoria.php?nombre='.$categoria['nombre'].'&diagnostico='
			.$categoria['descripcion']);
		}
		else
		{
			session_start();
			$_SESSION['exitoEditarCategoria'] = "Edicion exitosa";
			unset($_SESSION['erroresEditarCategoria']);#Libero memoria eliminando la variable de session erroresEditarProducto
			header('Location: ../vistas/categorias.php');
		}
	}
}
	//$prueba = new CoordinadorCategoriaEditar();
	//$prueba->editarCategoriaCoordinador("Celulares", "hjdgfir", "ertyui64fh6");
?>