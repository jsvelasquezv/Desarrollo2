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
				$this->responseRegistro[7] = "El documento debe ser numerico";
			}
			if (($this->validar->esMayor($documento, 15))){
				$this->responseRegistro[8] = "El documento debe contener maximo 15 digitos";
			}
			if (($this->validar->esMenor($documento,8))){
				$this->responseRegistro[9] = "El documento debe contener minimo 8 digitos";
			}
			if ($this->validar->esMenor($password, 4)){
				$this->responseRegistro[10] = "El password debe contener minimo 4 caracteres";
			}
			if ($this->validar->esMayor($password, 30)){
				$this->responseRegistro[11] = "El password debe contener maximo 30 caracteres";
			}
			if ($this->validar->esMenor($nombreUsuario, 4)){
				$this->responseRegistro[12] = "El nombre de usuario debe contener minimo 4 caracteres";
			}
			if ($this->validar->esMayor($nombreUsuario, 30)){
				$this->responseRegistro[13] = "El nombre de usuario debe contener maximo 30 caracteres";
			}
			if (!empty($this->usuario->buscarUsuario($documento))) {
				$this->responseRegistro[14] = "El documento ya esta registrado";
			}
			if (!empty($this->usuario->buscarUsuarioE($email))) {
				$this->responseRegistro[15] = "El email ya esta registrado";
			}
			if (!empty($this->usuario->buscarUsuario($nombreUsuario))) {
				$this->responseRegistro[16] = "El nombre de usuario ya esta registrado";
			}
			if (empty($this->responseRegistro)) 
			{
				$usuarioCreado = $this->usuario->registrarUsuario($documento, $nombre, $apellidos, $email, 
					$nombreUsuario, $password, $ID);
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

		public function validarConsultarUsuarioE($email)
		{
			$usuario = $this->usuario->buscarUsuarioE($email);
			return $usuario;
		}

		public function validarModificarUsuario($documento, $documentoN, $nombre, $apellido, $email, 
			$nombreUsuario, $tipoPerfil)
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
				$this->responseModificacion[7] = "El documento debe ser numerico";
			}
			if (($this->validar->esMayor($documento, 15))){
				$this->responseModificacion[8] = "El documento debe contener maximo 15 digitos";
			}
			if (($this->validar->esMenor($documento, 8))){
				$this->responseModificacion[9] = "El documento debe contener minimo 8 digitos";
			}
			if ($this->validar->esMenor($nombreUsuario, 4)){
				$this->responseModificacion[10] = "El nombre de usuario debe contener minimo 4 caracteres";
			}
			if ($this->validar->esMayor($nombreUsuario, 30)){
				$this->responseModificacion[11] = "El nombre de usuario debe contener maximo 30 caracteres";
			}
			$comparador = $this->usuario->buscarUsuario($documento);
			if ($comparador['documento']!=$documentoN and (!empty($this->usuario->buscarUsuario($documentoN)))){
				$this->responseModificacion[12] = "El documento ya esta registrado";
			}
			//$comparado2 = $this->usuario->buscarUsuario($nombreUsuario);
			if ($comparador['nombre_usuario']!=$nombreUsuario and (!empty($this->usuario->buscarUsuario($nombreUsuario)))){
				$this->responseModificacion[13] = "El nombre de usuario ya esta registrado";
			}
			//$comparado3 = $this->usuario->buscarUsuarioE($documento);
			if ($comparador['email']!=$email and (!empty($this->usuario->buscarUsuarioE($email)))){
				$this->responseModificacion[14] = "El correo ya esta registrado";
			}
			// if (!empty($this->usuario->buscarUsuario($documento)){
			// 	$this->responseModificacion[12] = "El documento ya esta registrado";
			// }
			// if (!empty($this->usuario->buscarUsuarioE($email))) {
			// 	$this->responseModificacion[13] = "El email ya esta registrado";
			// }
			// if (!empty($this->usuario->buscarUsuario($nombreUsuario))) {
			// 	$this->responseModificacion[14] = "El nombre de usuario ya esta registrado";
			// }
			if (empty($this->responseModificacion))
			{
				//echo $tipoPerfil;
				$this->usuario->modificarUsuario($documento, $documentoN, $nombre, $apellido, $email, $nombreUsuario, $tipoPerfil);
				session_start();
				unset($_SESSION['eUpdateUsuario']);
				header('Location: ../vistas/gestionarUsuarios.php');
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
				header('Location: ../vistas/gestionarUsuarios.php');
			}
		}

		public function validarLogin($nombreUsuario, $password)
		{
			$usuario = $this->usuario->buscarUsuarioE($nombreUsuario);
			//$user2 = $this->usuario->buscarUsuarioN($nombreUsuario);
			$user2 = $usuario;
			if (empty($usuario)) 
			{
				$this->responseLogin[0] = "El correo no esta registrado";
			}
			elseif($password != $usuario['password'])
			{
				$this->responseLogin[1] = "Contrasena incorrecta";
			}
			elseif (empty($this->responseLogin)) 
			{
				$perfilAsignado = $this->perfil->buscarPerfil($usuario['tipo_perfil']);
				session_start();
				$_SESSION['logueado'] = true;
				$_SESSION['user'] = $usuario['email'];
				$_SESSION['permisoDeVender'] = $perfilAsignado['permiso_vender'];
				$_SESSION['permisoDeGestionarPerfiles'] = $perfilAsignado['permiso_gestionar_perfiles'];
				$_SESSION['permisoDeGestionarUsuarios'] = $perfilAsignado['permiso_gestionar_usuarios'];
				session_start();
				unset($_SESSION['eLogin']);
				header('Location: ../index.php');
			}
		}

		public function getUsuarios()
		{
			$usuarios = $this->usuario->getUsuarios();
			return $usuarios;
		}

		public function getResponseRegistrar()
		{
			return $this->responseRegistro;
		}

		public function getResponseLogin()
		{
			return $this->responseLogin;
		}

		public function getResponseModificar()
		{
			return $this->responseModificacion;
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