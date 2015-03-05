<?php
	/**
	* 
	*/
	require_once '../modelos/LogicaUsuario.php';
	require_once '../modelos/LogicaPerfil.php';
	require_once '../mailer/PHPMailerAutoload.php';
	require_once '../mailer/class.phpmailer.php';
	require_once '../mailer/class.smtp.php';

	if (isset($_POST['cancelarRI'])) {
		session_start();
		unset($_SESSION['eRegistroUsuario']);
		header('Location: ../index.php');
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
		$coordinador->registrarUsuario($documento, $nombre, $apellidos, $email, $username, $password, $perfilID, 'index');
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
			$errores = $this->logicaUsuario->getResponseLogin();
			if (isset($errores)) {
				session_start();
				$_SESSION['eLogin'] = $this->logicaUsuario->getResponseLogin();
				header('Location: ../index.php');	
			}	
		}

		public function registrarUsuario($documento, $nombre, $apellidos, $email, 
			$nombreUsuario, $password, $perfilID, $origen) 
		{
			$this->logicaUsuario->validarRegistroUsuario($documento, $nombre, $apellidos, $email, 
			$nombreUsuario, $password, $perfilID);
			$errores = $this->logicaUsuario->getResponseRegistrar();
			if (isset($errores)) {
				session_start();
				$_SESSION['eRegistroUsuario'] = $this->logicaUsuario->getResponseRegistrar();
				if ($origen=='index') {
					header('Location: ../index.php');
				}else{
					header('Location: ../vistas/gestionarUsuarios.php');
				}
			}else {
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

		public function recuperar($email)
		{
			$usuario = $this->logicaUsuario->validarConsultarUsuarioE($email);
			$correo = $usuario['email'];
			$contrasena = $usuario['password'];

			$crendentials = array(
  			'email'     => 'proyectodesarrollo2@gmail.com',    //Your GMail adress
    		'password'  => 'Desarrollo2Proyecto'               //Your GMail password
    		);
    		$smtp = array(
			'host' => 'smtp.gmail.com',
			'port' => 587,
			'username' => $crendentials['email'],
			'password' => $crendentials['password'],
			'secure' => 'tls' //SSL or TLS
			);

			$to         = $correo; //The 'To' field
			$subject    = 'Recuperacion de Contrasena';
			$content    = $contrasena;

			$mailer = new PHPMailer();

			//SMTP Configuration
			$mailer->isSMTP();
			$mailer->SMTPAuth   = true; //We need to authenticate
			$mailer->Host       = $smtp['host'];
			$mailer->Port       = $smtp['port'];
			$mailer->Username   = $smtp['username'];
			$mailer->Password   = $smtp['password'];
			$mailer->SMTPSecure = $smtp['secure']; 

			//Now, send mail :
			//From - To :
			$mailer->From       = $crendentials['email'];
			$mailer->FromName   = 'Proyecto Desarrollo2'; //Optional
			$mailer->addAddress($to);  // Add a recipient

			//Subject - Body :
			$mailer->Subject        = $subject;
			$mailer->Body           = $content;
			$mailer->isHTML(true); //Mail body contains HTML tags

			//Check if mail is sent :
			if(!$mailer->send()) {
			    echo 'Error sending mail : ' . $mailer->ErrorInfo;
			    header('Location: ../index.php');
			} else {
			    echo 'Message sent !';
			    header('Location: ../index.php');
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