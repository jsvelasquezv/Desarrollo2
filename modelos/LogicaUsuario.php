<?php
	/**
	* 
	*/
	require_once 'Usuario.php';
	require_once 'Validaciones.php';
	require_once 'Perfil.php';
	require_once 'LogicaPerfil.php';
	class LogicaUsuario
	{
		private $responseRegistro;
		private $responseLogin;
		private $responseConsulta;
		private $responseModificacion;
		private $responseBaja;
		private $usuario;
		private $validar; //Validaciones
		private $perfil;

		public function __construct()
		{
			$this->validar = new Validaciones();
			$this->usuario = new Usuario();
			$this->perfil = new Perfil();
			$this->logicaPerfil = new LogicaPerfil();
		}

		public function validarRegistroUsuario($documento, $nombre, $apellidos, $email, 
			$nombreUsuario, $password, $ID)
		{
			if ($nombre =="" or $apellidos =="" 
				or $email =="" or $nombreUsuario ==""
				or $password =="" or $documento =="" or $ID =="") {
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
				$usuarioCreado = $this->usuario->registrarUsuario($documento, $nombre, $apellidos, $email, 
					$nombreUsuario, $password, $ID);
				$this->responseRegistro[0] = "Perfil creado con exito";		
				return $usuarioCreado;
			}		
		}

		public function validarConsultaUsuario($documento) //documento:int
		{
			if ($documento == "") {
				$this->responseConsulta[0] = "Ingrese un numero de documento";
			}
			if (!($this->validar->esNumerico($documento))){
				$this->responseConsulta[1] = "El documento debe ser numerico";
			}
			if (empty($this->responseConsulta)) {
				$usuarioColsultado;
				$usuarioColsultado = $this->usuario->buscarUsuario($documento);
				return $usuarioColsultado;
			}
		}

		public function validarConsultaUsuarioN($nombreUsuario)
		{
			$usuario = $this->usuario->buscarUsuarioN($nombreUsuario);
			return $usuario;
		}

		public function validarModificarUsuario($documento, $nombre, $apellidos, $email, 
			$nombreUsuario, $password, $tipoPerfil)
		{
			if ($this->validar->esMayor($nombre,30)) {
				$this->responseModificacion[1] = "El nombre debe contener maximo 30 caracteres";
			}
			if ($this->validar->esMenor($nombre,4)){
				$this->responseModificacion[2] = "El nombre debe contener minimo 4 caracteres";
			}
			if ($this->validar->esMayor($apellido, 30)){
				$this->responseModificacion[3] = "El apellido debe contener maximo 30 caracteres";
			}
			if ($this->validar->esMenor($apellido, 4)){
				$this->responseModificacion[4] = "El apellido debe contener minimo 4 caracteres";
			}
			if (!($this->validar->esAlfabetico($nombre))){
				$this->responseModificacion[5] = "El nombre debe ser alfabetico";
			}
			if (!($this->validar->esAlfabetico($apellido))){
				$this->responseModificacion[6] = "El apellido debe ser alfabetico";
			}
			if (!($this->validar->esNumerico($documento))){
				$this->responseModificacion[7] = "El docuemnto debe ser numerico";
			}
			if ($this->validar->esMenor($password, 4)){
				$this->responseModificacion[8] = "El password debe contener minimo 4 caracteres";
			}
			if ($this->validar->esMayor($password, 30)){
				$this->responseModificacion[9] = "El password debe contener maximo 30 caracteres";
			}
			if ($this->validar->esMenor($nombreUsuario, 4)){
				$this->responseModificacion[10] = "El nombre de usuario debe contener minimo 4 caracteres";
			}
			if ($this->validar->esMayor($nombreUsuario, 30)){
				$this->responseModificacion[11] = "El nombre de usuario debe contener maximo 30 caracteres";
			}
			if (empty($this->responseModificacion))
			{
				$usuarioModificado = $this->usuario->modificarUsuario();
				header('Location: ../index.php');
			}
		}

		public function validarDardeBajaUsuario($documento) //documento:int
		{
			if (!($this->validar->esNumerico($documento))){
				$this->responseBaja[0] = "El documento debe ser numerico";
			}
			if (empty($this->response)) {
				$this->responseBaja[0] = "Usuario dado de baja con exito";
				$this->usuario->darDeBajaUsuario($documento);
			}
		}

		public function validarLogin($nombreUsuario, $password)
		{
			$usuario = $this->usuario->buscarUsuario($nombreUsuario);
			//$user2 = $this->usuario->buscarUsuarioN($nombreUsuario);
			$user2 = $usuario;
			if (empty($usuario)) 
			{
				$this->responseLogin[0] = "El usuario no existe";
			}
			elseif($password != $usuario['password'])
			{
				$this->responseLogin[1] = "Contrasena incorrecta";
			}
			elseif (!empty($this->responseLogin)) 
			{
				foreach ($this->responseLogin as $key) {
					echo $key;
				}
				header('Location: ../index.php');
			}
			else
			{
				$perfilAsignado = $this->perfil->buscarPerfil($usuario['tipo_perfil']);
				session_start();
				$_SESSION['logueado'] = true;
				$_SESSION['user'] = $usuario['nombre_usuario'];
				$_SESSION['permisoDeVender'] = $perfilAsignado['permiso_vender'];
				$_SESSION['permisoDeGestionarPerfiles'] = $perfilAsignado['permiso_gestionar_perfiles'];
				$_SESSION['permisoDeGestionarUsuarios'] = $perfilAsignado['permiso_gestionar_usuarios'];
				header('Location: ../index.php');
			}
		}

		public function getUsuarios()
		{
			$usuarios = $this->usuario->getUsuarios();
			return $usuarios;
		}

		public function getResponseRegistro()
		{
			return $this->responseRegistro;
		}

		public function getResponseLogin()
		{
			return $this->responseLogin;
		}

		public function getResponseDarDeBaja()
		{
			return $this->responseDarDeBaja;
		}
	}

	/*$logica = new LogicaUsuario();
	$log = $logica->validarLogin("juseve","j89s1994");
	foreach ($log as $key) {
		echo $key;
	}*/
?>