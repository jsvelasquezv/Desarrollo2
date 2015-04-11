<?php
require_once '../mailer/PHPMailerAutoload.php';
require_once '../mailer/class.phpmailer.php';
require_once '../mailer/class.smtp.php';
require_once 'Usuario.php';

Class Notificacion
{
	function __construct(){}

	public function enviarEmail($username, $asunto, $contenido)
	{
		$usuario = new Usuario();
		$datos = $usuario->buscarUsuario($username);
		$correo = $datos['email'];

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
		$subject    = $asunto;
		$content    = $contenido;

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
		//$this->response[1] = 'Error al enviar el correo: '.$mailer->ErrorInfo;
		}
	}	
}
?>