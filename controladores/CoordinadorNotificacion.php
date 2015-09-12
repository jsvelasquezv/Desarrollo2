<?php
require_once '../modelos/Notificacion.php';

Class CoordinadorNotificacion
{
	private $notifica;

	/**
	 * [__construct description]
	 */
	function __construct()
	{
		$this->notifica = new Notificacion();
	}

	/**
	 * [enviaMail description]
	 * @param  [string] $correo    [description]
	 * @param  [string] $asunto    [description]
	 * @param  [string] $contenido [description]
	 */
	public function enviaMail($correo, $asunto, $contenido)
	{
		$this->notifica->enviarEmail($correo, $asunto, $contenido);
	}
}
//$coordinador = new CoordinadorNotificacion();
//$coordinador->enviaMail("vazuluagab@gmail.com", "prueba controlador notificacion", "esto es una prueba");
?>