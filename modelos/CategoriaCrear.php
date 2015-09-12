<?php
require_once '../libs/rb.php';
require_once 'ConexionBD.php';
require_once 'Categoria.php';

Class CategoriaCrear
{
	/**
	 * [__construct description]
	 */
	function __construct(){}

	/**
	 * [crearCategoria description]
	 * @param  [type] $nombre      [description]
	 * @param  [type] $descripcion [description]
	 * @return [type]              [description]
	 */
	public function crearCategoria($nombre, $descripcion)
	{
		$categoriaObj = new Categoria($nombre, $descripcion);
		R::selectDatabase('default');
		$categoriaBean = R::dispense('categoria');
		$categoriaBean->nombre = $categoriaObj->getNombre();
		$categoriaBean->descripcion = $categoriaObj->getDescripcion();
		R::store($categoriaBean);
        R::close();
	}
}
	//Prueba
	//$crea = new CategoriaCrear();
	//$crea->crearCategoria("Aseo", "Productos relacionados con el cuidado personal");
?>