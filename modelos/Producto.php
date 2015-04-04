<?php
/**
* Clase que contiene los gets y sets de un producto
*/
class Producto
{
	private $nombre;
	private $cantidad;
	private $valor;
	private $url; #Url de la imagen
	private $userUsuario;#Usuario que creo hace acciones sobre el producto
	private $idCategoria;
	private $estado;

	function __construct($nombre, $cantidad, $valor, $url, $userUsuario, $idCategoria, $estado) {
		$this->nombre = $nombre;
		$this->valor = $valor;
		$this->cantidad = $cantidad;
		$this->url = $url;
		$this->userUsuario = $userUsuario;
		$this->idCategoria = $idCategoria;
		$this->estado = $estado;
	}


	#==========================GETS==============================
	public function obtenerNombre()
	{
		return $this->nombre;
	}

	public function obtenerCantidad()
	{
		return $this->cantidad;
	}

	public function obtenerValor()
	{
		return $this->valor;
	}

	public function obtenerURL()
	{
		return $this->url;
	}

	public function obtenerUserUsuario()
	{
		return $this->userUsuario;
	}

	public function obtenerIdCategoria()
	{
		return $this->idCategoria;
	}
	public function obtenerEstado()
	{
		return $this->estado;
	}

	#===============SETS=============================
	public function cambiarNombre($nombre)
	{
		$this->nombre = $nombre;
	}

	public function cambiarValor($valor)
	{
		$this->valor = $valor;
	}

	public function cambiarCantidad($cantidad)
	{
		$this->cantidad = $cantidad;
	}

	public function cambiarImagen($url)
	{
		$this->url = $url;
	}

	public function cambiarUserUsuario($userUsuario)
	{
		$this->userUsuario = $userUsuario;
	}

	public function cambiarIdCategoria($idCategoria)
	{
		$this->idCategoria = $idCategoria;
	}

	public function cambiarEstado($estado)
	{
		$this->estado = $estado;
	}
}
?>