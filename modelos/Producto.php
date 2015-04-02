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
	private $idUsuario;
	private $idCategoria;
	#private $estado;

	function __construct($nombre, $cantidad, $valor, $url, $idUsuario, $idCategoria) {
		$this->nombre = $nombre;
		$this->valor = $valor;
		$this->cantidad = $cantidad;
		$this->url = $url;
		$this->idUsuario = $idUsuario;
		$this->idCategoria = $idCategoria;
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

	public function obtenerIdUsuario()
	{
		return $this->idUsuario;
	}

	public function obtenerIdCategoria()
	{
		return $this->idCategoria;
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

	public function cambiarIdUsuario($idUsuario)
	{
		$this->idUsuario = $idUsuario;
	}

	public function cambiarIdCategoria($idCategoria)
	{
		$this->idCategoria = $idCategoria;
	}
}
?>