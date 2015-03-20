<?php 
	/**
	* 
	*/
	require_once 'Usuario.php';
	require_once 'Validaciones.php';

	class ValidarConsultarUsuario 
	{

		private $responseConsulta;
		private $validaciones;
		private $usuarioModelo;
		
		function __construct()
		{
			$this->validaciones = new Validaciones();
			$this->usuarioModelo = new Usuario();
		}

		public function consultarUsuario($email)
		{
			if ($email == "") {
				$this->responseConsulta[0] = "El email es requerido";
			}
			if (!($this->validaciones->validarEmail($email))){
				$this->responseConsulta[1] = "Ingresa un email valido";
			}
			if (empty($this->responseConsulta)) {
				$usuario = $this->usuarioModelo->consultarUsuario($email);
				return $usuario;
			}
		}

		public function getResponse()
		{
			return $this->responseConsulta;
		}


	}

 ?>