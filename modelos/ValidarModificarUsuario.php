<?php 
	/**
	* 
	*/
	require_once 'Validaciones.php';
	require_once 'Usuario.php';
	class ValidarModificarUsuario 
	{
		private $responseModificar;
		private $validaciones;
		private $usuarioModelo;

		function __construct()
		{
			$this->validaciones = new Validaciones();
			$this->usuarioModelo = new Usuario();
		}

		public function validarModificar($documento, $documentoN, $nombre, $apellido, $email, 
			$nombreUsuario, $tipoPerfil, $estado)
		{
			if ($nombre =="" or $apellido =="" 
				or $email =="" or $nombreUsuario ==""
				or $documentoN =="" or $tipoPerfil =="") {
				$this->responseModificar[0] = "Todos los campos son requeridos";
			}
			if ($this->validaciones->esMayor($nombre,30)) {
				$this->responseModificar[1] = "El nombre debe contener maximo 30 caracteres";
			}
			if ($this->validaciones->esMenor($nombre,3)){
				$this->responseModificar[2] = "El nombre debe contener minimo 3 caracteres";
			}
			if ($this->validaciones->esMayor($apellido, 30)){
				$this->responseModificar[3] = "El apellido debe contener maximo 30 caracteres";
			}
			if ($this->validaciones->esMenor($apellido, 2)){
				$this->responseModificar[4] = "El apellido debe contener minimo 2 caracteres";
			}
			if (!($this->validaciones->esAlfabetico($nombre))){
				$this->responseModificar[5] = "El nombre debe ser alfabetico";
			}
			if (!($this->validaciones->esAlfabetico($apellido))){
				$this->responseModificar[6] = "El apellido debe ser alfabetico";
			}
			if (!($this->validaciones->esNumerico($documento))){
				$this->responseModificar[7] = "El documento debe ser numerico";
			}
			if (($this->validaciones->esMayor($documento, 15))){
				$this->responseModificar[8] = "El documento debe contener maximo 15 digitos";
			}
			if (($this->validaciones->esMenor($documento, 8))){
				$this->responseModificar[9] = "El documento debe contener minimo 8 digitos";
			}
			if ($this->validaciones->esMenor($nombreUsuario, 2)){
				$this->responseModificar[10] = "El nombre de usuario debe contener minimo 2 caracteres";
			}
			if ($this->validaciones->esMayor($nombreUsuario, 30)){
				$this->responseModificar[11] = "El nombre de usuario debe contener maximo 30 caracteres";
			}
			$comparador = $this->usuarioModelo->buscarUsuario($documento);
			if ($comparador['documento']!=$documentoN and (!empty($this->usuarioModelo->buscarUsuario($documentoN)))){
				$this->responseModificar[12] = "El documento ya esta registrado";
			}
			//$comparado2 = $this->usuarioModelo->buscarUsuario($nombreUsuario);
			if ($comparador['nombre_usuario']!=$nombreUsuario and (!empty($this->usuarioModelo->buscarUsuario($nombreUsuario)))){
				$this->responseModificar[13] = "El nombre de usuario ya esta registrado";
			}
			//$comparado3 = $this->usuarioModelo->buscarUsuarioE($documento);
			if ($comparador['email']!=$email and (!empty($this->usuarioModelo->buscarUsuarioE($email)))){
				$this->responseModificar[14] = "El correo ya esta registrado";
			}
			// if (!empty($this->usuario->buscarUsuario($documento)){
			// 	$this->responseModificar[12] = "El documento ya esta registrado";
			// }
			// if (!empty($this->usuario->buscarUsuarioE($email))) {
			// 	$this->responseModificar[13] = "El email ya esta registrado";
			// }
			// if (!empty($this->usuario->buscarUsuario($nombreUsuario))) {
			// 	$this->responseModificar[14] = "El nombre de usuario ya esta registrado";
			// }
			if (empty($this->responseModificar))
			{
				$this->usuarioModelo->modificarUsuario($documento, $documentoN, $nombre, $apellido, $email, $nombreUsuario, $tipoPerfil, $estado);
				session_start();
				unset($_SESSION['eUpdateUsuario']);
			}
		}

		public function validarModificarMi($documento, $nombre, $apellido, $email, 
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
				$this->responseModificar[0] = "Todos los campos son requeridos";
			}
			if ($this->validaciones->esMayor($nombre,30)) {
				$this->responseModificar[1] = "El nombre debe contener maximo 30 caracteres";
			}
			if ($this->validaciones->esMenor($nombre,3)){
				$this->responseModificar[2] = "El nombre debe contener minimo 3 caracteres";
			}
			if ($this->validaciones->esMayor($apellido, 30)){
				$this->responseModificar[3] = "El apellido debe contener maximo 30 caracteres";
			}
			if ($this->validaciones->esMenor($apellido, 2)){
				$this->responseModificar[4] = "El apellido debe contener minimo 2 caracteres";
			}
			if (!($this->validaciones->esAlfabetico($nombre))){
				$this->responseModificar[5] = "El nombre debe ser alfabetico";
			}
			if (!($this->validaciones->esAlfabetico($apellido))){
				$this->responseModificar[6] = "El apellido debe ser alfabetico";
			}
			if (!($this->validaciones->esNumerico($documento))){
				$this->responseModificar[7] = "El documento debe ser numerico";
			}
			if (($this->validaciones->esMayor($documento, 15))){
				$this->responseModificar[8] = "El documento debe contener maximo 15 digitos";
			}
			if (($this->validaciones->esMenor($documento, 8))){
				$this->responseModificar[9] = "El documento debe contener minimo 8 digitos";
			}
			if ($this->validaciones->esMenor($nombreUsuario, 2)){
				$this->responseModificar[10] = "El nombre de usuario debe contener minimo 4 caracteres";
			}
			if ($this->validaciones->esMayor($nombreUsuario, 30)){
				$this->responseModificar[11] = "El nombre de usuario debe contener maximo 30 caracteres";
			}
			$comparador = $this->usuarioModelo->buscarUsuario($nombreUsuario);
			if ($comparador['documento']!=$documento and (!empty($this->usuarioModelo->buscarUsuario($documento)))){
				$this->responseModificar[12] = "El documento ya esta registrado";
			}
			//$comparado2 = $this->usuario->buscarUsuario($nombreUsuario);
			if ($comparador['nombre_usuario']!=$nombreUsuario and (!empty($this->usuariModeloo->buscarUsuario($nombreUsuario)))){
				$this->responseModificar[13] = "El nombre de usuario ya esta registrado";
			}
			//$comparado3 = $this->usuario->buscarUsuarioE($documento);
			if ($comparador['email']!=$email and (!empty($this->usuarioModelo->buscarUsuario($email)))){
				$this->responseModificar[14] = "El correo ya esta registrado";
			}
			// if (!empty($this->usuario->buscarUsuario($documento)){
			// 	$this->responseModificar[12] = "El documento ya esta registrado";
			// }
			// if (!empty($this->usuario->buscarUsuarioE($email))) {
			// 	$this->responseModificar[13] = "El email ya esta registrado";
			// }
			// if (!empty($this->usuario->buscarUsuario($nombreUsuario))) {
			// 	$this->responseModificar[14] = "El nombre de usuario ya esta registrado";
			// }
			// if (!empty($this->responseModificar)) {
			// 	session_start();
			// 	$_SESSION['eMiUsuario'];
			// }
			if (empty($this->responseModificar))
			{
				//echo $tipoPerfil;
				$this->usuarioModelo->modificarMiUsuario($documento, $nombre, $apellido, $email, 
			$nombreUsuario, $nombreUsuarioN);
				//unset($_SESSION['eUpdateMiUsuario']);
				//header('Location: ../vistas/gestionarUsuarios.php');
			}
		}


		public function getResponse ()
		{
			return $this->responseModificar;
		}
	}

?>