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

		public function validarRegistroUsuario($documento, $nombre, $apellidos, $email, 
			$nombreUsuario, $password, $ID)
		{
			if ($nombre =="" or $apellidos =="" 
				or $email =="" or $nombreUsuario ==""
				or $password =="" or $documento =="" or $ID =="") {
				$this->responseRegistro[0] = "Todos los campos son requeridos";
			}
			if ($this->validaciones->esMayor($nombre,30)) {
				$this->responseRegistro[1] = "El nombre debe contener maximo 30 caracteres";
			}
			if ($this->validaciones->esMenor($nombre,3)){
				$this->responseRegistro[2] = "El nombre debe contener minimo 3 caracteres";
			}
			if ($this->validaciones->esMayor($apellidos, 30)){
				$this->responseRegistro[3] = "El apellido debe contener maximo 30 caracteres";
			}
			if ($this->validaciones->esMenor($apellidos, 2)){
				$this->responseRegistro[4] = "El apellido debe contener minimo 2 caracteres";
			}
			if (!($this->validaciones->esAlfabetico($nombre))){
				$this->responseRegistro[5] = "El nombre debe ser alfabetico";
			}
			if (!($this->validaciones->esAlfabetico($apellidos))){
				$this->responseRegistro[6] = "El apellido debe ser alfabetico";
			}
			if (!($this->validaciones->esNumerico($documento))){
				$this->responseRegistro[7] = "El documento debe ser numerico";
			}
			if (($this->validaciones->esMayor($documento, 15))){
				$this->responseRegistro[8] = "El documento debe contener maximo 15 digitos";
			}
			if (($this->validaciones->esMenor($documento,8))){
				$this->responseRegistro[9] = "El documento debe contener minimo 8 digitos";
			}
			if ($this->validaciones->esMenor($password, 4)){
				$this->responseRegistro[10] = "El password debe contener minimo 4 caracteres";
			}
			if ($this->validaciones->esMayor($password, 30)){
				$this->responseRegistro[11] = "El password debe contener maximo 30 caracteres";
			}
			if ($this->validaciones->esMenor($nombreUsuario, 2)){
				$this->responseRegistro[12] = "El nombre de usuario debe contener minimo 2 caracteres";
			}
			if ($this->validaciones->esMayor($nombreUsuario, 30)){
				$this->responseRegistro[13] = "El nombre de usuario debe contener maximo 30 caracteres";
			}
			if (!empty($this->usuarioModelo->buscarUsuario($documento))) {
				$this->responseRegistro[14] = "El documento ya esta registrado";
			}
			if (!empty($this->usuarioModelo->buscarUsuario($email))) {
				$this->responseRegistro[15] = "El email ya esta registrado";
			}
			if (!empty($this->usuarioModelo->buscarUsuario($nombreUsuario))) {
				$this->responseRegistro[16] = "El nombre de usuario ya esta registrado";
			}
			if (empty($this->responseRegistro)) 
			{
				$usuario = $this->usuarioModelo->registrarUsuario($documento, $nombre, $apellidos, $email, 
					$nombreUsuario, $password, $ID);
				return $usuario;
			}		
		}
	}
?>