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
		private $validar;

		public function __construct()
		{
			$this->validar = new Validaciones();
		}

		public function setCoordinadorP($coordinador) //coordinador:CoordinadorPerfil
		{
			$this->coordinadorP = $coordinador;
		}

		public function validarRegistoPerfil($nombre, $descripcion, $permisoGestionarUsuarios, $permisoVender, $permisoGestionarPerfiles)
		{
			if ($nombre =="" or $descripcion =="" or $permisoGestionarUsuarios =="" 
				or $permisoVender =="" or $permisoGestionarPerfiles =="") {
				$response[0] = "Todos los campos son requeridos";
			}
			if ($this->validar->esMayor($nombre,30)) {
				$response[1] = "El nombre debe contener maximo 30 caracteres";
			}
			if ($this->validar->esMenor($nombre,4)){
				$response[2] = "El nombre debe contener minimo 4 caracteres";
			}
		}

		public function validarConsultaPerfil($nombrePerfil) //perfil:string
		{
			# code...
		}

		public function validarModificarPerfil($perfil) //perfil:PerfilVO
		{
			# code...
		}

		public function validarDarDeBajaPerfil($nombrePerfil) //nombrePerfil:string
		{
			# code...
		}

	}
?>