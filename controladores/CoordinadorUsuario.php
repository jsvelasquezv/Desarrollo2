<?php
	/**
	* 
	*/
	require_once '../modelos/LogicaUsuario.php';
	require_once '../modelos/LogicaPerfil.php';
	require_once '../modelos/ValidarConsultarUsuario.php';
	require_once '../modelos/ValidarRegistrarUsuario.php';
	require_once '../modelos/ValidarModificarUsuario.php';
	require_once '../modelos/ValidarLogin.php';

	if (isset($_POST['cancelarRI'])) {
		session_start();
		unset($_SESSION['eRegistroUsuario']);
		header('Location: ../index.php');
	}

	if (isset($_POST['buscar'])) {
		$documento = $_POST['emailB'];
		$coordinador = new CoordinadorUsuario();
		$editable = $coordinador->buscarUsuarioE($documento);
		if (empty($editable)) {
			session_start();
			$_SESSION['eBuscar'] = 1;
			header('Location: ../vistas/gestionarUsuarios.php');
		}
		else{
			header('Location: ../vistas/editarUsuario.php?documento='.$editable['documento'].'&nombre='.$editable['nombre'].
				'&apellidos='.$editable['apellidos'].'&email='.$editable['email'].'&username='.$editable['nombre_usuario']);			
		}
	}

	if (isset($_GET['user'])) {
		session_start();
		$usuario = $_SESSION['user'];
		echo $usuario;

		$coordinador = new CoordinadorUsuario();
		$editable = $coordinador->buscarUsuarioN($usuario);
		//echo $editable;
		header('Location: ../vistas/editarMiUsuario.php?documento='.$editable['documento'].'&nombre='.$editable['nombre'].
			'&apellidos='.$editable['apellidos'].'&email='.$editable['email'].'&username='.$editable['nombre_usuario']);
	}
	if (isset($_POST['editMiUsuario'])) {
		$documento = $_POST['Midocumento'];
		$nombre = $_POST['Minombre'];
		$apellidos = $_POST['Miapellido'];
		$email = $_POST['Miemail'];
		$username = $_POST['Miusername'];

		$coordinador = new CoordinadorUsuario();
		session_start();
		$coordinador->modificarMiUsuario($documento, $nombre, $apellidos, $email, 
			$_SESSION['user'], $username);	
	}

	if (isset($_POST['cambiarPass'])) {
		$passVieja = $_POST['passwordVieja'];
		$passNueva = $_POST['passwordNueva'];
		$passNuevaC = $_POST['passwordNuevaC'];
		$coordinador = new CoordinadorUsuario();
		session_start();
		$coordinador->cambiarPass($_SESSION['user'],$passVieja, $passNueva, $passNuevaC);
	}
	if(isset($_POST["ingresar"])){	
		$username = $_POST["username"]; 
		$contrasena = $_POST["password"];
		$coordinador = new CoordinadorUsuario();
		$coordinador->loguear($username, $contrasena);
	}elseif (isset($_POST["recuperar"])) {		
		if (isset($_POST['correo'])) {
			$correo = $_POST['correo'];
			$coordinador = new CoordinadorUsuario();
			$coordinador->recuperar($correo);
		}		
	}elseif (isset($_POST["registrarse"])) {
		$documento = $_POST['documento'];
		$nombre = $_POST['nombre'];
		$apellidos = $_POST['apellido'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$perfilID = $_POST['perfilSelec'];
		$coordinador = new CoordinadorUsuario();
		$coordinador->registrarUsuario($documento, $nombre, $apellidos, $email, $username, $password, $perfilID, $estado, 'index');
	}elseif (isset($_POST["registrar"])) {
		$documento = $_POST['documento'];
		$nombre = $_POST['nombre'];
		$apellidos = $_POST['apellido'];
		$email = $_POST['email'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$perfilID = $_POST['perfilSelec'];
		$estado = $_POST['estado'];
		$coordinador = new CoordinadorUsuario();
		$coordinador->registrarUsuario($documento, $nombre, $apellidos, $email, $username, $password, $perfilID, $estado);

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
		$estado = $_POST['estado'];
		$coordinador = new CoordinadorUsuario();
		$coordinador->modificarUsuario($documento, $documentoN, $nombre, $apellidos, $email, $username, $perfilID, $estado);
	
	}elseif (isset($_GET['down'])) {
		$coordinador = new CoordinadorUsuario();
		$coordinador->dardeBajaUsuario($_GET['down']);
	}


	class CoordinadorUsuario 
	{
		private $logicaUsuario; //LogicaUsuario
		private $logicaPerfil;
		private $validarConsultarUsuario;
		private $validarRegistrarUsuario;
		private $validarModificarUsuario;
		private $valdiarLogin;

		public function __construct()
		{
			$this->logicaUsuario = new LogicaUsuario();
			$this->logicaPerfil = new LogicaPerfil();
			$this->validarConsultarUsuario = new ValidarConsultarUsuario();
			$this->validarRegistrarUsuario = new ValidarRegistrarUsuario();
			$this->validarLogin = new ValidarLogin();
			//$this->validarModificarUsuario = new ValidarModificarUsuario();
		}

		public function loguear($nombreUsuario, $password)
		{
			$this->validarLogin->validarLogin($nombreUsuario,$password);
			$errores = $this->validarLogin->getResponse();
			//session_start();
			/*foreach ($errores as $key) {
				echo $key;
			}*/
			if (!empty($errores)) {
				$_SESSION['eLogin'] = $errores;
				header('Location: ../index.php');	
			}	
			else
			{
				$_SESSION['exitoLogin'] = 1;
				header('Location: ../index.php');
			}
		}

		public function cambiarPass($username, $passVieja, $passNueva, $passNuevaC)
		{
			$this->logicaUsuario->validarCambiarPass($username, $passVieja, $passNueva, $passNuevaC);
			$errores = $this->logicaUsuario->getResponseCambiarPass();
			if (!empty($errores)) {
				session_start();
				$_SESSION['eCambiarPass'] = $this->logicaUsuario->getResponseCambiarPass();
				header('Location: ../index.php');
			}
			else
			{
				session_start();
				$_SESSION['exitoCambiarPass'] = 1;
				header('Location: ../index.php');
			}
		}

		public function registrarUsuario($documento, $nombre, $apellidos, $email, 
			$nombreUsuario, $password, $perfilID, $estado, $origen) 
		{
			$this->validarRegistrarUsuario->validarRegistrar($documento, $nombre, $apellidos, $email, 
			$nombreUsuario, $password, $perfilID, $estado);
			$errores = $this->validarRegistrarUsuario->getResponse();
			foreach ($errores as $key) {
				echo $key;
			}
			if (!empty($errores)) {
				session_start();
				$_SESSION['eRegistroUsuario'] = $errores;
				if ($origen=='index') {
					header('Location: ../index.php');
				}else{
					header('Location: ../vistas/registrarUsuario.php');
				}
			}else {
				session_start();
				$_SESSION['exitoRegistrar'] = 1;
				header('Location: ../vistas/gestionarUsuarios.php');
			}
		}
		
		public function modificarUsuario($documento, $documentoN, $nombre, $apellidos, $email, 
			$nombreUsuario, $tipoPerfil, $estado)
		{
			echo $estado;
			$this->logicaUsuario->validarModificarUsuario($documento, $documentoN, $nombre, $apellidos, $email, 
			$nombreUsuario, $tipoPerfil, $estado);
			$errores = $this->logicaUsuario->getResponseModificar();
			if (!empty($errores)) {
				session_start();
				$_SESSION['eUpdateUsuario'] = $this->logicaUsuario->getResponseModificar();
				header('Location: ../vistas/editarUsuario.php?documento='.$documento.'&nombre='.$nombre.'&apellidos='.$apellidos.'&email='.$email.
					'&username='.$nombreUsuario);
			}
			else {
				session_start();
				$_SESSION['exitoModificar'] = 1;
				header('Location: ../vistas/gestionarUsuarios.php');
			}
		}

		public function modificarMiUsuario($documento, $nombre, $apellidos, $email, 
			$nombreUsuario, $nombreUsuarioN)
		{
			//echo $tipoPerfil;
			$this->logicaUsuario->validarModificarMiUsuario($documento, $nombre, $apellidos, $email, 
			$nombreUsuario, $nombreUsuarioN);
			$errores = $this->logicaUsuario->getResponseMiModificacion();
			//session_start();
			if (!empty($errores)) {
				
				$_SESSION['eMiUsuario'] = $errores;
				foreach ($errores as $key) {
					echo $key;
				}
				 header('Location: ../vistas/editarMiUsuario.php?documento='.$documento.'&nombre='.$nombre.'&apellidos='.$apellidos.'&email='.$email.
					'&username='.$nombreUsuario);
			}
			else {
				$_SESSION['user'] = $nombreUsuarioN;
				$_SESSION['exitoModificarMiUsuario'] = 1;
				header('Location: ../index.php');
			}
		}

		public function recuperar($email)
		{
			$this->logicaUsuario->validarRecuperacion($email);
			$errores = $this->logicaUsuario->getResponseRecuperacion();
			if (!empty($errores)) {
				session_start();
				$_SESSION['eRecuperacion'] = $this->logicaUsuario->getResponseRecuperacion();
			}else
			{
				session_start();
				if (isset($_SESSION['eRecuperacion'])) {
					unset($_SESSION['eRecuperacion']);
				}
				$_SESSION['exitoRecuperacion'] = 1;
			}
			header('Location: ../index.php');
		}

		public function buscarUsuario($documento)
		{
			//echo $documento;
			$usuario = $this->logicaUsuario->validarConsultaUsuario($documento);
			return $usuario;
		}

		public function buscarUsuarioN($documento)
		{
			$usuario = $this->logicaUsuario->validarConsultaUsuarioN($documento);
			return $usuario;
		}

		public function buscarUsuarioE($email)
		{
			$usuario = $this->logicaUsuario->validarConsultarUsuarioE($email);
			return $usuario;
		}
		
		public function dardeBajaUsuario($idUsuario) //$idUsuario:int
		{
			$this->logicaUsuario->validarDardeBajaUsuario($idUsuario);
		}
	}
?>