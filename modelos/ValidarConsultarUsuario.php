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

		public function consultarUsuario($parametro)
		{
			if ($this->validaciones->esNumerico($parametro)) {
				$usuario = $this->usuarioModelo->buscarUsuario($parametro);
				return $usuario;
			}elseif ($this->validaciones->esAlfabetico($parametro)) {
				$usuario = $this->usuarioModelo->buscarUsuario($parametro);
				return $usuario;
			}
			else{
				if ($parametro == "") {
					$this->responseConsulta[0] = "El email es requerido";
				}
				if (!($this->validaciones->validarEmail($parametro))){
					$this->responseConsulta[1] = "Ingresa un email valido";
				}
				if (empty($this->responseConsulta)) {
					$usuario = $this->usuarioModelo->buscarUsuario($parametro);
					return $usuario;
				}
			}
		}

		public function getUsuarios()
		{
			$usuarios = $this->usuarioModelo->getUsuarios();
			return $usuarios;
		}
			
		public function getResponse()
		{
			return $this->responseConsulta;
		}


	}

	// $a = new ValidarConsultarUsuario();
	// $usuario = $a->consultarUsuario(116264525);
	// echo $usuario;
 ?>