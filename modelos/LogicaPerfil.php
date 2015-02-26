<?php
	/**
	* 
	*/

	require 'Perfil.php';
	require 'Validaciones.php';

	class LogicaPerfil
	{
		
		private $coordinadorP; //CoordinadorPerfil
		private $response;
		private $perfil;
		private $validar; //Validaciones

		public function __construct()
		{
			$this->validar = new Validaciones();
			$this->perfil = new Perfil();
		}

		public function setCoordinadorP($coordinador) //coordinador:CoordinadorPerfil
		{
			$this->coordinadorP = $coordinador;
		}

		public function validarRegistroPerfil($nombre, $permisoGestionarUsuarios, 
			$permisoVender, $permisoGestionarPerfiles)
		{
			if ($nombre =="" or $permisoGestionarUsuarios =="" 
				or $permisoVender =="" or $permisoGestionarPerfiles =="") {
				$this->response[0] = "Todos los campos son requeridos";
			}
			if ($this->validar->esMayor($nombre,30)) {
				$this->response[1] = "El nombre debe contener maximo 30 caracteres";
			}
			if ($this->validar->esMenor($nombre,4)){
				$this->response[2] = "El nombre debe contener minimo 4 caracteres";
			}
			if (!($this->validar->esAlfabetico($nombre))){
				$this->response[3] = "El nombre debe ser alfabetico";
			}
			if (empty($this->response)) 
			{
				$this->perfil->registrarPerfil($nombre, $permisoGestionarUsuarios, 
					$permisoVender, $permisoGestionarPerfiles);
				$this->response[0] = "Perfil creado con exito";			
			}	
			return $this->response;
		}

		public function validarModificarPerfil($nombre, $permisoGestionarUsuarios, 
			$permisoVender, $permisoGestionarPerfiles)
		{
			if ($nombre =="") {
				$this->response[0] = "Ingrese un nombre";
			}
			if ($this->validar->esMayor($nombre,30)) {
				$this->response[1] = "El nombre debe contener maximo 30 caracteres";
			}
			if ($this->validar->esMenor($nombre,4)){
				$this->response[2] = "El nombre debe contener minimo 4 caracteres";
			}
			if (!($this->validar->esAlfabetico($nombre))){
				$this->response[3] = "El nombre debe ser alfabetico";
			}
			if (empty($this->response)) 
			{
				$this->perfil->modificarPerfil($nombre, $permisoGestionarUsuarios, 
					$permisoVender, $permisoGestionarPerfiles);
				$this->response[0] = "Perfil modificado con exito";			
			}	
			return $this->response;
		}
	}
	/*$logica = new LogicaPerfil();
	$status = $logica->validarModificarPerfil("root",0,0,0);
	foreach ($status as $key) {
		echo $key;
	}*/
?>