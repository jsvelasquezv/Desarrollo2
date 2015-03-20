<?php 
	/**
	* 
	*/
	require_once '../modelos/Perfil.php';
	require_once '../modelos/Validaciones.php';

	class ValidarModificarPerfil
	{
		private $perfilModelo;
		private $validaciones;
		private $responseModificar;
		
		function __construct()
		{
			$this->perfilModelo = new Perfil();
			$this->validaciones = new Validaciones();
		}

		public function validarModificar($nombre, $nuevoNombre, $permisoGestionarUsuarios, 
			$permisoVender, $permisoGestionarPerfiles)
		{
			// echo $nombre;
			// echo $nuevoNombre;
			// echo $permisoGestionarUsuarios;
			// echo $permisoVender;
			// echo $permisoGestionarPerfiles;	
			if ($nombre =="") {
				$this->responseModificar[0] = "Ingrese un nombre";
			}
			if ($permisoGestionarUsuarios==0 and $permisoGestionarPerfiles==0 and $permisoVender==0) {
				$this->responseModificar[1] = "Selecciona minimo un permiso";
			}
			if ($this->validaciones->esMayor($nuevoNombre,30)) {
				$this->responseModificar[2] = "El nuevoNombre debe contener maximo 30 caracteres";
			}
			if ($this->validaciones->esMenor($nuevoNombre,4)) {
				$this->responseModificar[3] = "El nuevoNombre debe contener minimo 4 caracteres";
			}
			if (!($this->validaciones->esAlfabetico($nuevoNombre))) {
				$this->responseModificar[4] = "El nombre debe ser alfabetico";
			}
			if (!empty($this->perfilModelo->buscarPerfil($nuevoNombre))) {
				$this->responseRegistrar[5] = "El nombre ya existe";
			}
			if (empty($this->responseModificar)) {
				$this->perfilModelo->modificarPerfil($nombre, $nuevoNombre, $permisoGestionarUsuarios, 
					$permisoVender, $permisoGestionarPerfiles);
				session_start();
				unset($_SESSION['eUpdatePerfil']);
			}
		}

		public function getResponse()
		{
			return $this->responseModificar;
		}
	}

	// $validaciones = new ValidarModificarPerfil();
	// $validaciones->modificarPerfil("hola", "hola mundo", 1,0,1);
?>