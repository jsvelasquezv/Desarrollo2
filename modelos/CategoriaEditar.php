<?php
require_once '../libs/rb.php';
require_once 'ConexionBD.php';
require_once 'Categoria.php';

Class CategoriaEditar
{
	function __construct(){}

	public function editarCategoria($nombre, $nuevoNombre, $nuevaDescripcion)
	{
		$editaCategoria = new Categoria($nuevoNombre, $nuevaDescripcion);
		R::selectDatabase('default');
		$categoriaBean = R::findOne('categoria', 'nombre = ?', [$nombre]);
		$categoriaBean->nombre = $editaCategoria->getNombre();
		$categoriaBean->descripcion = $editaCategoria->getDescripcion();
		R::store($categoriaBean);
        R::close();
	}
}
	//$editable = new CategoriaEditar();
	//$editable->editarCategoria("Muebles", "Salas", "Poltronas, mesas");
?>