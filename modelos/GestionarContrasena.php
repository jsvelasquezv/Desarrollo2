<?php 
	/**
	* 
	*/

	require_once '../mailer/PHPMailerAutoload.php';
	require_once '../mailer/class.phpmailer.php';
	require_once '../mailer/class.smtp.php';
	require_once 'Validaciones.php';
	require_once 'Usuario.php';

	class GestionarContrasena 
	{

		private $usuarioModelo;
		private $validaciones;
		private $response;

		function __construct()
		{
			$this->usuarioModelo = new Usuario();
			$this->validaciones = new Validaciones();
		}

		public function validarRecuperacion($email)
		{
			$usuario = $this->usuarioModelo->buscarUsuario($email);
			if (empty($usuario)) {
				$this->response[0] = 'El correo no esta registrado';
			}
			else
			{
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
			$content    = 'Tu contrasena es '.$contrasena;

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
			    	// echo 'Error sending mail : ' . $mailer->ErrorInfo;
			    	$this->response[1] = 'Error al enviar el correo: '.$mailer->ErrorInfo;
				}
			}
		}

		public function validarCambiarPass($username, $passVieja, $passNueva, $passNuevaC)
		{
			$usuario = $this->usuarioModelo->buscarUsuario($username);
			if ($usuario['password']!=$passVieja) {
				$this->response[0] = "Tu contrasena es incorrecta";
			}
			if ($passNueva != $passNuevaC) {
				$this->response[1] = "Las contrasenas deben coincidir";
			}
			if ($this->validaciones->esMenor($passNueva, 4)) {
				$this->response[2] = "La contrasena debe contener minimo 4 caracteres";	
			}
			if ($this->validaciones->esMayor($passNueva, 30)) {
				$this->response[3] = "La contrasena debe contener maximo 30 caracteres";
			}
			else if (empty($this->response)) 
			{
				$this->usuarioModelo->cambiarPass($username, $passNueva);
			}
		}

		public function getResponse()
		{
			return $this->response;
		}
	}
?>