<?php
	/**
	* 
	*/

	require_once 'Perfil.php';
	require_once 'Validaciones.php';

	class LogicaPerfil
	{
		
		private $coordinadorP; //CoordinadorPerfil
		private $responseModificar;
		private $responseRegistrar;
		private $responseConsultar;
		private $perfil;
		private $validar; //Validaciones

		public function __construct()
		{
			$this->validar = new Validaciones();
			$this->perfil = new Perfil();
		}

		public function validarRegistrarPerfil($nombre, $permisoGestionarUsuarios, 
			$permisoVender, $permisoGestionarPerfiles)
		{
			if ($nombre =="") {
				$this->responseRegistrar[0] = "Ingresa un nombre";
			}
			if ($this->validar->esMayor($nombre,30)) {
				$this->responseRegistrar[1] = "El nombre debe contener maximo 30 caracteres";
			}
			if ($this->validar->esMenor($nombre,4)){
				$this->responseRegistrar[2] = "El nombre debe contener minimo 4 caracteres";
			}
			if (!($this->validar->esAlfabetico($nombre))){
				$this->responseRegistrar[3] = "El nombre debe ser alfabetico";
			}
			if (!empty($this->perfil->buscarPerfil($nombre))) 
			{
				$this->responseRegistrar[4] = "El nombre ya existe";
			}
			if (empty($this->responseRegistrar)) 
			{
				$this->perfil->registrarPerfil($nombre, $permisoGestionarUsuarios, 
					$permisoVender, $permisoGestionarPerfiles);
				session_start();
				unset($_SESSION['eRegistroPerfil']);
			}	
			// echo $nombre;
			// echo $permisoGestionarUsuarios;
			// echo $permisoVender;
			// echo $permisoGestionarPerfiles;
		}

		public function validarModificarPerfil($nombre, $nuevoNombre, $permisoGestionarUsuarios, 
			$permisoVender, $permisoGestionarPerfiles)
		{
			if ($nombre =="") {
				$this->responseModificar[0] = "Ingrese un nombre";
			}
			if ($this->validar->esMayor($nuevoNombre,30)) {
				$this->responseModificar[1] = "El nuevoNombre debe contener maximo 30 caracteres";
			}
			if ($this->validar->esMenor($nuevoNombre,4)){
				$this->responseModificar[2] = "El nuevoNombre debe contener minimo 4 caracteres";
			}
			if (!($this->validar->esAlfabetico($nuevoNombre))){
				$this->responseModificar[3] = "El nombre debe ser alfabetico";
			}
			if (!empty($this->perfil->buscarPerfil($nuevoNombre))) 
			{
				$this->responseRegistrar[4] = "El nombre ya existe";
			}
			if (empty($this->responseModificar)) 
			{
				$this->perfil->modificarPerfil($nombre, $nuevoNombre, $permisoGestionarUsuarios, 
					$permisoVender, $permisoGestionarPerfiles);
				session_start();
				unset($_SESSION['eUpdatePerfil']);
			}
			// echo $nombre;
			// echo $permisoGestionarUsuarios;
			// echo $permisoVender;
			// echo $permisoGestionarPerfiles;	
		}

		public function validarConsultarPerfil($parametro)
		{
			$perfilBuscado = $this->perfil->buscarPerfil($parametro);
			if(empty($perfilBuscado))
			{
				$this->responseConsultar[0] = "No exite el perfil ";
			}
			else
			{
				return $perfilBuscado;
			}
		}

		public function getPerfiles()
		{
			$perfiles = $this->perfil->getPerfiles();
			// echo $perfiles;
			return $perfiles;
		}

		public function getResponseRegistrar()
		{
			return $this->responseRegistrar;
		}

		public function getResponseModificar()
		{
			return $this->responseModificar;
		}
	}
	 // $perfil = new LogicaPerfil();
	 // $perfil->validarRegistrarPerfil("Hola",1,1,1);
	// $perfiles = $perfil->getPerfiles();
	// foreach ($perfiles as $key) {
	// 	echo $key['id'];
	// 	echo $key['nombre'];
	// }

	// $logica = new LogicaPerfil();
	// $logica->getPerfiles();
	/*
	$logica->validarModificarPerfil('Root', 'Admin', 1,1,1);*/
	/*//$status = $logica->validarModificarPerfil("root",0,0,0);
	$status = $logica->validarRegistrarPerfil("Admin",1,1,1);
	foreach ($status as $key) {
		echo $key;
	}*/
?>