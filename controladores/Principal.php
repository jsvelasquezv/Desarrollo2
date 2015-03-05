<?php 
	/**
	* 
	*/
	require_once 'modelos/LogicaPerfil.php';
	require_once 'modelos/LogicaUsuario.php';

	if (isset($_POST['ingresar'])) {
		$username = $_POST['username'];
		$contrasena = $_POST['password'];
		$principal = new Principal();
		$principal->loguear($username,$contrasena);
	}

	class Principal 
	{
		private $logicaPerfil; 
		private $logicaUsuario; 

		function __construct()
		{
			$this->logicaPerfil = new LogicaPerfil();
			$this->logicaUsuario =  new LogicaUsuario();
		}

		public function salir()
		{
			session_start();
			session_destroy();
			header('Location: ../index.php');
		}

		public function loguear($username, $contrasena)
		{
			$this->logicaUsuario->validarLogin($username, $contrasena);
			$this->logicaUsuario->getResponse();
		}
	}
?>