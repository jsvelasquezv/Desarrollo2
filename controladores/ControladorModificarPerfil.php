<?php 
	/**
	* 
	*/
	require_once '../modelos/Perfil.php';
	require_once '../modelos/Validaciones.php';

	class ClassName ControladorModificarPerfil
	{
		private $perfil;
		private $Validaciones;
		private $responseModificar;
		
		function __construct()
		{
			$this->perfil = new Perfil();
			$this->validaciones = new Validaciones();
		}

		public function modificarPerfil($nombre, $nuevoNombre, $permisoGestionarUsuarios, 
			$permisoVender, $permisoGestionarPerfiles)
		{
			if ($nombre=="") {
				$this->responseModificar[0]="Ingresa un nombre";
			}
			if ($permisoGestionarUsuarios==0 or $permisoVender==0 or $permisoGestionarPerfiles==0) {
				$this->responseModificar[1]="Selecciona minimo un perfil";
			}
			if ($this->validaciones->esAlfabetico($nombre)) {
				$this->responseModificar[2]="El nombre debe ser alfabetico";
			}
			if ($this->validaciones->esMenor($nombre,4) {
				$this->responseModificar[3]="El nombre debe contener minimo 4 caracteres";
			}
			if ($this->validaciones->esMayor($nombre,30) {
				$this->responseModificar[4]="El nombre debe contener maximo 30 caracteres";
			}
			if (!empty($this->perfil->buscarPerfil($nuevoNombre))){
				$this->responseModificar[4]="El nombre ya existe";
			}
			if (empty($this->responseModificar)) 
			{
				$this->perfil->modificarPerfil($nombre, $nuevoNombre, $permisoGestionarUsuarios, 
					$permisoVender, $permisoGestionarPerfiles);
				session_start();
				unset($_SESSION['eUpdatePerfil']);
			}
		}
	}
?>