<?php
	/**
	* 
	*/
	require_once '../modelos/LogicaUsuario.php';
	require_once '../modelos/LogicaPerfil.php';

	if(isset($_POST["ingresar"])){	
		$username = $_POST["username"]; 
		$contrasena = $_POST["password"];
		$coordinador = new CoordinadorUsuario();
		$coordinador->loguear($username, $contrasena);
	}elseif (isset($_POST["recuperar"])) {		
		header('Location: ../index.php');
	}elseif (isset($_POST["registrarse"])) {
		$documento = $_POST['documento'];
		$nombre = $_POST['nombre'];
		$apellidos = $_POST['apellido'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$perfilID = $_POST['perfilSelec'];
		$coordinador = new CoordinadorUsuario();
		$coordinador->registrarUsuario($documento, $nombre, $apellidos, $email, $username, $password, $perfilID);
	}elseif (isset($_POST["registrar"])) {
		$documento = $_POST['documento'];
		$nombre = $_POST['nombre'];
		$apellidos = $_POST['apellido'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$perfilID = $_POST['perfilSelec'];
		$coordinador = new CoordinadorUsuario();
		$coordinador->registrarUsuario($documento, $nombre, $apellidos, $email, $username, $password, $perfilID);
		header('Location: ../vistas/gestionarUsuarios.php');
	}elseif (isset($_GET['editUsuario'])) {
		$editUsuario = $_GET['editUsuario'];
		$coordinador = new CoordinadorUsuario();
		$editable = $coordinador->buscarUsuario($editUsuario);
		header('Location: ../vistas/editarUsuario.php?documento='.$editable['documento'].'&nombre='.$editable['nombre'].
			'&apellidos='.$editable['apellidos'].'&email='.$editable['email'].'&username='.$editable['nombre_usuario']);

	}elseif (isset($_POST['editar'])) {
		$documento = $_POST['antiguo'];
		$documentoN = $_POST['documento'];
		$nombre = $_POST['nombre'];
		$apellidos = $_POST['apellido'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$perfilID = $_POST['perfilSelec'];
		$coordinador = new CoordinadorUsuario();
		//echo $perfilID;
		$coordinador->modificarUsuario($documento, $documentoN, $nombre, $apellidos, $email, $username, $perfilID);
	}elseif (isset($_GET['down'])) {
		$coordinador = new CoordinadorUsuario();
		$coordinador->dardeBajaUsuario($_GET['down']);
	}


	class CoordinadorUsuario 
	{
		private $logicaUsuario; //LogicaUsuario
		private $logicaPerfil;
		
		public function __construct()
		{
			$this->logicaUsuario = new LogicaUsuario();
			$this->logicaPerfil = new LogicaPerfil();
		}

		public function loguear($nombreUsuario, $password)
		{
			$this->logicaUsuario->validarLogin($nombreUsuario,$password);	
			session_start();
			$_SESSION['eRegistroPerfil'] = $this->logicaUsuario->getResponseLogin();
			header('Location: ../index.php');	
		}

		public function registrarUsuario($documento, $nombre, $apellidos, $email, 
			$nombreUsuario, $password, $perfilID) 
		{
			$this->logicaUsuario->validarRegistroUsuario($documento, $nombre, $apellidos, $email, 
			$nombreUsuario, $password, $perfilID);
			$errores = $this->logicaUsuario->getResponseRegistrar();
			if (isset($errores)) {
				session_start();
				$_SESSION['eRegistroUsuario'] = $this->logicaUsuario->getResponseRegistrar();
			}else{
				header('Location: ../vistas/gestionarUsuarios.php');
			}
		}
		
		public function modificarUsuario($documento, $documentoN, $nombre, $apellidos, $email, 
			$nombreUsuario, $tipoPerfil)
		{
			//echo $tipoPerfil;
			$this->logicaUsuario->validarModificarUsuario($documento, $documentoN, $nombre, $apellidos, $email, 
			$nombreUsuario, $tipoPerfil);
			$errores = $this->logicaUsuario->getResponseModificar();
			if (isset($errores)) {
				session_start();
				$_SESSION['eUpdateUsuario'] = $this->logicaUsuario->getResponseModificar();
				header('Location: ../vistas/editarUsuario.php?documento='.$documento.'&nombre='.$nombre.'&apellidos='.$apellidos.'&email='.$email.
					'&username='.$nombreUsuario);
			}
			else {
				header('Location: ../vistas/gestionarUsuarios.php');
			}
		}
		public function buscarUsuario($documento)
		{
			$usuario = $this->logicaUsuario->validarConsultaUsuario($documento);
			return $usuario;
		}
		
		public function dardeBajaUsuario($idUsuario) //$idUsuario:int
		{
			$this->logicaUsuario->validarDardeBajaUsuario($idUsuario);
		}
	}
?>