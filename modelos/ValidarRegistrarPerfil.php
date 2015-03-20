<?php 
	/**
	*  Done
	*/
	require_once 'Perfil.php';
	require_once 'Validaciones.php';

	class ValidarRegistrarPerfil
	{
		private $perfilModelo;
		private $validaciones;
		private $responseCrear;
		
		function __construct()
		{
			$this->perfilModelo = new Perfil();
			$this->validaciones = new Validaciones();
		}

		public function validarRegistrar($nombre, $permisoGestionarUsuarios, $permisoVender, $permisoGestionarPerfiles)
		{
			echo $nombre;
			echo $permisoGestionarUsuarios;
			echo $permisoVender;
			echo $permisoGestionarPerfiles;
			if ($nombre=="") {
				$this->responseCrear[0]="Ingresa un nombre";
			}
			if ($permisoGestionarUsuarios==0 and $permisoVender==0 and $permisoGestionarPerfiles==0) {
				$this->responseCrear[1]="Selecciona minimo un permiso";
			}
			if (!$this->validaciones->esAlfabetico($nombre)) {
				$this->responseCrear[2]="El nombre debe ser alfabetico";
			}
			if ($this->validaciones->esMenor($nombre,4)) {
				$this->responseCrear[3]="El nombre debe contener minimo 4 caracteres";
			}
			if ($this->validaciones->esMayor($nombre,30)) {
				$this->responseCrear[4]="El nombre debe contener maximo 30 caracteres";
			}
			if (!empty($this->perfilModelo->buscarPerfil($nombre))){
				$this->responseCrear[4]="El nombre ya existe";
			}
			if (!empty($this->responseCrear)){
				session_start();
				$_SESSION['eRegistroPerfil'] = $this->responseCrear;		
				//header('Location: ../vistas/gestionarPerfiles.php');		
			}else{
				session_start();
				$this->perfilModelo->registrarPerfil($nombre, $permisoGestionarUsuarios,
				 $permisoVender, $permisoGestionarPerfiles);
				$_SESSION['exitoRegistrar'] = 1;
				//header('Location: ../vistas/gestionarPerfiles.php');
			}
			// foreach ($_SESSION['eRegistroPerfil'] as $key ) {
				# code...
			// echo $key;
			// }
		}

		public function getResponse()
		{
			return $this->responseCrear;
		}
	}

	// $perfil = new ValidarRegistrarPerfil();
	// $perfil->validarRegistrarPerfil("hola mund",1,1,1);
	// echo $perfil->getResponse()[2];
?>