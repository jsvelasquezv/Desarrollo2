<?php
	/**
	* 
	*/
	require 'Usuario.php';
	require 'Validaciones.php';
	class LogicaUsuario
	{
		private $coordinadorU; #coordinadorU:CoordinadorUsuario
		private $response;
		private $usuario;
		private $validar; //Validaciones
		public function __construct()
		{
			$this->validar = new Validaciones();
			$this->usuario = new Usuario();
		}
		public function setCoordinador($coordinador) //coordinador:CoordinadorUsuario
		{
			$this->coordinadorU = $coordinador;
		}
		public function validarRegistroUsuario($documento, $nombre, $apellidos, $email, 
			$nombreUsuario, $password, $tipoPerfil)
		{
			if ($nombre =="" or $apellidos =="" 
				or $email =="" or $nombreUsuario ==""
				or $password =="" or $documento =="" or $tipoPerfil ="") {
				$this->response[0] = "Todos los campos son requeridos";
			}
			if ($this->validar->esMayor($nombre,30)) {
				$this->response[1] = "El nombre debe contener maximo 30 caracteres";
			}
			if ($this->validar->esMenor($nombre,4)){
				$this->response[2] = "El nombre debe contener minimo 4 caracteres";
			}
			if ($this->validar->esMayor($apellido, 30)){
				$this->response[3] = "El apellido debe contener maximo 30 caracteres";
			}
			if ($this->validar->esMenor($apellido, 4)){
				$this->response[4] = "El apellido debe contener minimo 4 caracteres";
			}
			if (!($this->validar->esAlfabetico($nombre))){
				$this->response[5] = "El nombre debe ser alfabetico";
			}
			if (!($this->validar->esAlfabetico($apellido))){
				$this->response[6] = "El apellido debe ser alfabetico";
			}
			if (!($this->validar->esNumerico($documento))){
				$this->response[7] = "El docuemnto debe ser numerico";
			}
			if ($this->validar->esMenor($passwrod, 4)){
				$this->response[8] = "El password debe contener minimo 4 caracteres";
			}
			if ($this->validar->esMayor($passwrod, 30)){
				$this->response[9] = "El password debe contener maximo 30 caracteres";
			}
			if ($this->validar->esMenor($nombreUsuario, 4)){
				$this->response[10] = "El nombre de usuario debe contener minimo 4 caracteres";
			}
			if ($this->validar->esMayor($nombreUsuario, 30)){
				$this->response[11] = "El nombre de usuario debe contener maximo 30 caracteres";
			}
			if (empty($this->response)) 
			{
				$this->perfil->registrarPerfil($nombre, $permisoGestionarUsuarios, 
					$permisoVender, $permisoGestionarPerfiles);
				$this->response[0] = "Perfil creado con exito";			
			}	
			return $this->response;
		}
		public function validarConsultaUsuario($documento) //documento:int
		{
			if (!($this->validar->esNumerico($documento))){
				$this->response[0] = "El docuemnto debe ser numerico";
			}
			if (empty($this->response)) {
				$this->usuario->buscarUsuario($documento);
				$this->response[0] = "Resultado de la busqueda";
			}
		}
		public function validarModificarUsuario($documento, $nombre, $apellidos, $email, 
			$nombreUsuario, $password, $tipoPerfil){
			if ($this->validar->esMayor($nombre,30)) {
				$this->response[1] = "El nombre debe contener maximo 30 caracteres";
			}
			if ($this->validar->esMenor($nombre,4)){
				$this->response[2] = "El nombre debe contener minimo 4 caracteres";
			}
			if ($this->validar->esMayor($apellido, 30)){
				$this->response[3] = "El apellido debe contener maximo 30 caracteres";
			}
			if ($this->validar->esMenor($apellido, 4)){
				$this->response[4] = "El apellido debe contener minimo 4 caracteres";
			}
			if (!($this->validar->esAlfabetico($nombre))){
				$this->response[5] = "El nombre debe ser alfabetico";
			}
			if (!($this->validar->esAlfabetico($apellido))){
				$this->response[6] = "El apellido debe ser alfabetico";
			}
			if (!($this->validar->esNumerico($documento))){
				$this->response[7] = "El docuemnto debe ser numerico";
			}
			if ($this->validar->esMenor($passwrod, 4)){
				$this->response[8] = "El password debe contener minimo 4 caracteres";
			}
			if ($this->validar->esMayor($passwrod, 30)){
				$this->response[9] = "El password debe contener maximo 30 caracteres";
			}
			if ($this->validar->esMenor($nombreUsuario, 4)){
				$this->response[10] = "El nombre de usuario debe contener minimo 4 caracteres";
			}
			if ($this->validar->esMayor($nombreUsuario, 30)){
				$this->response[11] = "El nombre de usuario debe contener maximo 30 caracteres";
			}
			return $this->response;
		}
		public function validarDardeBajaUsuario($documento) //documento:int
		{
			if (!($this->validar->esNumerico($documento))){
				$this->response[0] = "El docuemnto debe ser numerico";
			}
			if (empty($this->response)) {
				$this->usuario->darDeBajaUsuario($documento);
				$this->response[0] = "Usuario dado de baja con exito";
			}
		}
	}
?>