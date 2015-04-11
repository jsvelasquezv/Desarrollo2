<?php
require_once '../modelos/Notificacion.php';

Class CoordinadorNotificacion
{
	private $notifica;

	function __construct()
	{
		$this->notifica = new Notificacion();
	}

	public function enviaMail($username, asunto, contenido)
	{
		$this->notifica->enviarEmail($username, $asunto, $contenido);
	}
}
?>