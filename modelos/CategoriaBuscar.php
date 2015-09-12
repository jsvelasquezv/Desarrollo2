<?php
require_once '../libs/rb.php';
require_once 'ConexionBD.php';
require_once 'Categoria.php';

Class CategoriaBuscar
{
	/**
	 * [__construct description]
	 */
	function __construct(){}


	/**
	 * [buscarCategoria description]
	 * @param  [type] $nombre [description]
	 * @return [type]         [description]
	 */
	public function buscarCategoria($nombre)
	{
		R::selectDatabase('default');
		$categoria = R::findOne('categoria', 'nombre = ?',[$nombre]);
		R::close();#se cierra el almacén de Beans
		return $categoria;
	}


	/**
	 * [mostrarCategorias description]
	 * @return [type] [description]
	 */
	public function mostrarCategorias()
	{
		R::selectDatabase('default');
		$todosBean = R::findAll('categoria');
		R::close();
		return $todosBean;
	}
}
	//Pruebas
	 //$categoriaBuscar = new CategoriaBuscar();
	 //$categorias = $categoriaBuscar->mostrarCategorias();
	 //foreach ($categorias as $key) {
	 	//echo $key['nombre'];
	 	//echo $key['descripcion'];}
	 //$allCategorias = $categoriaBuscar->buscarCategoria("Aseo");
	 //echo $allCategorias['descripcion'];
?>