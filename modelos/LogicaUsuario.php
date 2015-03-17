<?php
	/**
	* 
	*/
	require_once 'Usuario.php';
	require_once 'Validaciones.php';
	require_once 'Perfil.php';
	require_once 'LogicaPerfil.php';
	require_once '../mailer/PHPMailerAutoload.php';
	require_once '../mailer/class.phpmailer.php';
	require_once '../mailer/class.smtp.php';
	class LogicaUsuario
	{	
		private $responseRecuperacion;
		private $responseRegistro;
		private $responseLogin;
		private $responseConsulta;
		private $responseModificacion;
		private $responseMiModificacion;
		private $responseBaja;
		private $responseCambiarPass;
		private $responseBusqueda;
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
			if ($this->validar->esMenor($nombre,3)){
				$this->responseRegistro[2] = "El nombre debe contener minimo 3 caracteres";
			}
			if ($this->validar->esMayor($apellidos, 30)){
				$this->responseRegistro[3] = "El apellido debe contener maximo 30 caracteres";
			}
			if ($this->validar->esMenor($apellidos, 2)){
				$this->responseRegistro[4] = "El apellido debe contener minimo 2 caracteres";
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
			if ($this->validar->esMenor($nombreUsuario, 2)){
				$this->responseRegistro[12] = "El nombre de usuario debe contener minimo 2 caracteres";
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
			//echo $documento;
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
			$usuario = $this->usuario->buscarUsuario($nombreUsuario);
			return $usuario;
		}

		public function validarConsultarUsuarioE($email)
		{	
			$usuario = $this->usuario->buscarUsuarioE($email);
			if (empty($usuario)) {
				$this->responseBusqueda[0] = "Ingresa un email registrado";
			}
			return $usuario;
		}

		public function validarModificarUsuario($documento, $documentoN, $nombre, $apellido, $email, 
			$nombreUsuario, $tipoPerfil)
		{
			if ($nombre =="" or $apellido =="" 
				or $email =="" or $nombreUsuario ==""
				or $documentoN =="" or $tipoPerfil =="") {
				$this->responseModificacion[0] = "Todos los campos son requeridos";
			}
			if ($this->validar->esMayor($nombre,30)) {
				$this->responseModificacion[1] = "El nombre debe contener maximo 30 caracteres";
			}
			if ($this->validar->esMenor($nombre,3)){
				$this->responseModificacion[2] = "El nombre debe contener minimo 3 caracteres";
			}
			if ($this->validar->esMayor($apellido, 30)){
				$this->responseModificacion[3] = "El apellido debe contener maximo 30 caracteres";
			}
			if ($this->validar->esMenor($apellido, 2)){
				$this->responseModificacion[4] = "El apellido debe contener minimo 2 caracteres";
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
			if ($this->validar->esMenor($nombreUsuario, 2)){
				$this->responseModificacion[10] = "El nombre de usuario debe contener minimo 2 caracteres";
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

		public function validarModificarMiUsuario($documento, $nombre, $apellido, $email, 
			$nombreUsuario, $nombreUsuarioN)
		{
			// echo $documento;
			// echo $nombre;
			// echo $apellido;
			// echo $email;
			// echo $nombreUsuario;
			// echo $nombreUsuarioN;

			if ($nombre =="" or $apellido =="" 
				or $email =="" or $nombreUsuarioN ==""
				or $nombreUsuario =="" or $documento=="") {
				$this->responseMiModificacion[0] = "Todos los campos son requeridos";
			}
			if ($this->validar->esMayor($nombre,30)) {
				$this->responseMiModificacion[1] = "El nombre debe contener maximo 30 caracteres";
			}
			if ($this->validar->esMenor($nombre,3)){
				$this->responseMiModificacion[2] = "El nombre debe contener minimo 3 caracteres";
			}
			if ($this->validar->esMayor($apellido, 30)){
				$this->responseMiModificacion[3] = "El apellido debe contener maximo 30 caracteres";
			}
			if ($this->validar->esMenor($apellido, 2)){
				$this->responseMiModificacion[4] = "El apellido debe contener minimo 2 caracteres";
			}
			if (!($this->validar->esAlfabetico($nombre))){
				$this->responseMiModificacion[5] = "El nombre debe ser alfabetico";
			}
			if (!($this->validar->esAlfabetico($apellido))){
				$this->responseMiModificacion[6] = "El apellido debe ser alfabetico";
			}
			if (!($this->validar->esNumerico($documento))){
				$this->responseMiModificacion[7] = "El documento debe ser numerico";
			}
			if (($this->validar->esMayor($documento, 15))){
				$this->responseMiModificacion[8] = "El documento debe contener maximo 15 digitos";
			}
			if (($this->validar->esMenor($documento, 8))){
				$this->responseMiModificacion[9] = "El documento debe contener minimo 8 digitos";
			}
			if ($this->validar->esMenor($nombreUsuario, 2)){
				$this->responseMiModificacion[10] = "El nombre de usuario debe contener minimo 4 caracteres";
			}
			if ($this->validar->esMayor($nombreUsuario, 30)){
				$this->responseMiModificacion[11] = "El nombre de usuario debe contener maximo 30 caracteres";
			}
			$comparador = $this->usuario->buscarUsuario($nombreUsuario);
			if ($comparador['documento']!=$documento and (!empty($this->usuario->buscarUsuario($documento)))){
				$this->responseMiModificacion[12] = "El documento ya esta registrado";
			}
			//$comparado2 = $this->usuario->buscarUsuario($nombreUsuario);
			if ($comparador['nombre_usuario']!=$nombreUsuario and (!empty($this->usuario->buscarUsuario($nombreUsuario)))){
				$this->responseMiModificacion[13] = "El nombre de usuario ya esta registrado";
			}
			//$comparado3 = $this->usuario->buscarUsuarioE($documento);
			if ($comparador['email']!=$email and (!empty($this->usuario->buscarUsuarioE($email)))){
				$this->responseMiModificacion[14] = "El correo ya esta registrado";
			}
			// if (!empty($this->usuario->buscarUsuario($documento)){
			// 	$this->responseMiModificacion[12] = "El documento ya esta registrado";
			// }
			// if (!empty($this->usuario->buscarUsuarioE($email))) {
			// 	$this->responseMiModificacion[13] = "El email ya esta registrado";
			// }
			// if (!empty($this->usuario->buscarUsuario($nombreUsuario))) {
			// 	$this->responseMiModificacion[14] = "El nombre de usuario ya esta registrado";
			// }
			// if (!empty($this->responseMiModificacion)) {
			// 	session_start();
			// 	$_SESSION['eMiUsuario'];
			// }
			if (empty($this->responseMiModificacion))
			{
				//echo $tipoPerfil;
				$this->usuario->modificarMiUsuario($documento, $nombre, $apellido, $email, 
			$nombreUsuario, $nombreUsuarioN);
				//unset($_SESSION['eUpdateMiUsuario']);
				//header('Location: ../vistas/gestionarUsuarios.php');
			}
		}

		public function validarDardeBajaUsuario($documento) //documento:int
		{
			if (!($this->validar->esNumerico($documento))){
				$this->responseBaja[0] = "El documento debe ser numerico";
			}
			if (empty($this->responseBaja)) {
				$this->responseBaja[0] = "Usuario dado de baja con exito";
				$this->usuario->darDeBajaUsuario($documento);
				header('Location: ../vistas/gestionarUsuarios.php');
			}
		}

		public function validarLogin($nombreUsuario, $password)
		{
			$usuario = $this->usuario->buscarUsuario($nombreUsuario);
			//$user2 = $this->usuario->buscarUsuarioN($nombreUsuario);
			$user2 = $usuario;
			if (empty($usuario)) 
			{
				$this->responseLogin[0] = "El usuario no esta registrado";
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
				$_SESSION['user'] = $usuario['nombre_usuario'];
				$_SESSION['permisoDeVender'] = $perfilAsignado['permiso_vender'];
				$_SESSION['permisoDeGestionarPerfiles'] = $perfilAsignado['permiso_gestionar_perfiles'];
				$_SESSION['permisoDeGestionarUsuarios'] = $perfilAsignado['permiso_gestionar_usuarios'];
				session_start();
				unset($_SESSION['eLogin']);
				header('Location: ../index.php');
			}
		}

		public function validarRecuperacion($email)
		{
			$usuario = $this->usuario->buscarUsuarioE($email);
			if (empty($usuario)) {
				$this->responseRecuperacion[0] = 'El correo no esta registrado';
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
			    	$this->responseRecuperacion[1] = 'Error al enviar el correo: '.$mailer->ErrorInfo;
				}
			}
		}

		public function validarCambiarPass($username, $passVieja, $passNueva, $passNuevaC)
		{
			$usuario = $this->usuario->buscarUsuario($username);
			if ($usuario['password']!=$passVieja) {
				$this->responseCambiarPass[0] = "Tu contrasena es incorrecta";
			}
			if ($passNueva != $passNuevaC) {
				$this->responseCambiarPass[1] = "Las contrasenas deben coincidir";
			}
			if ($this->validar->esMenor($passNueva, 4)) {
				$this->responseCambiarPass[2] = "La contrasena debe contener minimo 4 caracteres";	
			}
			if ($this->validar->esMayor($passNueva, 30)) {
				$this->responseCambiarPass[3] = "La contrasena debe contener maximo 30 caracteres";
			}
			else if (empty($this->responseCambiarPass)) 
			{
				$this->usuario->cambiarPass($username, $passNueva);
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

		public function getResponseRecuperacion()
		{
			return $this->responseRecuperacion;
		}

		public function getResponseCambiarPass()
		{
			return $this->responseCambiarPass;
		}

		public function getResponseMiModificacion()
		{
			return $this->responseMiModificacion;
		}

		public function getResponseBusqueda()
		{
			return $this->responseBusqueda;
		}
	}

	// $logica = new LogicaUsuario();
	// echo $usuario = $logica->validarConsultarUsuarioE('');
	// $log = $logica->getResponseBusqueda();
	// $logica->validarRecuperacion('juseve200@gmail.com');
	// $log = $logica->getResponseRecuperacion();
	// foreach ($log as $key) {
	// 	echo $key;
	// }
?>