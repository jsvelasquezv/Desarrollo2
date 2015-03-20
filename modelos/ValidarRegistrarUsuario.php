<?php 
	require_once 'Usuario.php';
	require_once 'Validaciones.php';

	/**
	* 
	*/
	class ValidarRegistrarUsuario
	{
		private $responseCrear;
		private $usuarioModelo;
		private $validaciones;
		
		function __construct()
		{
			$this->usuarioModelo = new Usuario();
			$this->validaciones = new Validaciones();
		}

		public function validarRegistrar($documento, $nombre, $apellidos, $email, 
			$nombreUsuario, $password, $ID)
		{
			if ($nombre =="" or $apellidos =="" 
				or $email =="" or $nombreUsuario ==""
				or $password =="" or $documento =="" or $ID =="") {
				$this->responseCrear[0] = "Todos los campos son requeridos";
			}
			if ($this->validaciones->esMayor($nombre,30)) {
				$this->responseCrear[1] = "El nombre debe contener maximo 30 caracteres";
			}
			if ($this->validaciones->esMenor($nombre,3)){
				$this->responseCrear[2] = "El nombre debe contener minimo 3 caracteres";
			}
			if ($this->validaciones->esMayor($apellidos, 30)){
				$this->responseCrear[3] = "El apellido debe contener maximo 30 caracteres";
			}
			if ($this->validaciones->esMenor($apellidos, 2)){
				$this->responseCrear[4] = "El apellido debe contener minimo 2 caracteres";
			}
			if (!($this->validaciones->esAlfabetico($nombre))){
				$this->responseCrear[5] = "El nombre debe ser alfabetico";
			}
			if (!($this->validaciones->esAlfabetico($apellidos))){
				$this->responseCrear[6] = "El apellido debe ser alfabetico";
			}
			if (!($this->validaciones->esNumerico($documento))){
				$this->responseCrear[7] = "El documento debe ser numerico";
			}
			if (($this->validaciones->esMayor($documento, 15))){
				$this->responseCrear[8] = "El documento debe contener maximo 15 digitos";
			}
			if (($this->validaciones->esMenor($documento,8))){
				$this->responseCrear[9] = "El documento debe contener minimo 8 digitos";
			}
			if ($this->validaciones->esMenor($password, 4)){
				$this->responseCrear[10] = "El password debe contener minimo 4 caracteres";
			}
			if ($this->validaciones->esMayor($password, 30)){
				$this->responseCrear[11] = "El password debe contener maximo 30 caracteres";
			}
			if ($this->validaciones->esMenor($nombreUsuario, 2)){
				$this->responseCrear[12] = "El nombre de usuario debe contener minimo 2 caracteres";
			}
			if ($this->validaciones->esMayor($nombreUsuario, 30)){
				$this->responseCrear[13] = "El nombre de usuario debe contener maximo 30 caracteres";
			}
			if ($this->validaciones->esMayor($email, 60)){
				$this->responseCrear[11] = "El correo debe contener maximo 60 caracteres";
			}
			if ($this->validaciones->esMenor($email, 6)){
				$this->responseCrear[12] = "El correo debe contener minimo 6 caracteres";
			}
			if (!$this->validaciones->validarEmail($email)){
				$this->responseCrear[13] = "Ingresa un correo valido";
			}
			if (!empty($this->usuarioModelo->buscarUsuario($documento))) {
				$this->responseCrear[14] = "El documento ya esta registrado";
			}
			if (!empty($this->usuarioModelo->buscarUsuario($email))) {
				$this->responseCrear[15] = "El email ya esta registrado";
			}
			if (!empty($this->usuarioModelo->buscarUsuario($nombreUsuario))) {
				$this->responseCrear[16] = "El nombre de usuario ya esta registrado";
			}
			if (empty($this->responseCrear)) 
			{
				$usuario = $this->usuarioModelo->registrarUsuario($documento, $nombre, $apellidos, $email, 
					$nombreUsuario, $password, $ID);
				return $usuario;
			}		
		}

		public function getResponse()
		{
			return $this->responseCrear;
		}
	}
?>