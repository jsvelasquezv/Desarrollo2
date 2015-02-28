<?php
	/**
	* 
	*/
	require 'Usuario.php';
	require 'Validaciones.php';
	class LogicaUsuario
	{
		private $coordinadorU; #coordinadorU:CoordinadorUsuario
		private $responseRegistro;
		private $responseLogin;
		private $responseConsulta;
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
				$this->responseRegistro[0] = "Todos los campos son requeridos";
			}
			if ($this->validar->esMayor($nombre,30)) {
				$this->responseRegistro[1] = "El nombre debe contener maximo 30 caracteres";
			}
			if ($this->validar->esMenor($nombre,4)){
				$this->responseRegistro[2] = "El nombre debe contener minimo 4 caracteres";
			}
			if ($this->validar->esMayor($apellidos, 30)){
				$this->responseRegistro[3] = "El apellido debe contener maximo 30 caracteres";
			}
			if ($this->validar->esMenor($apellidos, 4)){
				$this->responseRegistro[4] = "El apellido debe contener minimo 4 caracteres";
			}
			if (!($this->validar->esAlfabetico($nombre))){
				$this->responseRegistro[5] = "El nombre debe ser alfabetico";
			}
			if (!($this->validar->esAlfabetico($apellidos))){
				$this->responseRegistro[6] = "El apellido debe ser alfabetico";
			}
			if (!($this->validar->esNumerico($documento))){
				$this->responseRegistro[7] = "El docuemnto debe ser numerico";
			}
			if ($this->validar->esMenor($password, 4)){
				$this->responseRegistro[8] = "El password debe contener minimo 4 caracteres";
			}
			if ($this->validar->esMayor($password, 30)){
				$this->responseRegistro[9] = "El password debe contener maximo 30 caracteres";
			}
			if ($this->validar->esMenor($nombreUsuario, 4)){
				$this->responseRegistro[10] = "El nombre de usuario debe contener minimo 4 caracteres";
			}
			if ($this->validar->esMayor($nombreUsuario, 30)){
				$this->responseRegistro[11] = "El nombre de usuario debe contener maximo 30 caracteres";
			}
			if (empty($this->responseRegistro)) 
			{
				$this->usuario->registrarUsuario($documento, $nombre, $apellidos, $email, 
			$nombreUsuario, $password, $tipoPerfil);
				$this->responseRegistro[0] = "Perfil creado con exito";			
			}	
			return $this->responseRegistro;
		}

		public function validarConsultaUsuario($documento) //documento:int
		{
			$usuario;
			if (!($this->validar->esNumerico($documento))){
				$this->responseConsulta[0] = "El documento debe ser numerico";
			}
			if (empty($this->responseConsulta)) {
				$usuario = $this->usuario->buscarUsuario($documento);
				$this->responseConsulta[0] = "Resultado de la busqueda";
			}
			return $usuario;

		}

		public function validarConsultaUsuarioN($nombreUsuario)
		{
			$usuario = $this->usuario->buscarUsuarioN($nombreUsuario);
			return $usuario;
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
			if ($this->validar->esMenor($password, 4)){
				$this->response[8] = "El password debe contener minimo 4 caracteres";
			}
			if ($this->validar->esMayor($password, 30)){
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

		public function validarLogin($nombreUsuario, $password)
		{
			$user = $this->usuario->buscarUsuarioN($nombreUsuario);
			//$user2 = $this->usuario->buscarUsuarioN($nombreUsuario);
			$user2 = $user;
			if (empty($user)) 
			{
				$this->responseLogin[0] = "El usuario no existe";
			}
			elseif($password != $user['password'])
			{
				$this->responseLogin[1] = "Contrasena incorrecta";
			}
			else
			{
				$this->responseLogin[0] = "Logueado con exito";
			}
			return $user;
		}

		public function getUsuarios()
		{
			$usuarios = $this->usuario->getUsuarios();
			return $usuarios;
		}
	}

	/*$logica = new LogicaUsuario();
	$log = $logica->validarLogin("juseve","j89s1994");
	foreach ($log as $key) {
		echo $key;
	}*/
?>