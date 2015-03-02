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
			if ($nombre =="" or $permisoGestionarUsuarios =="" 
				or $permisoVender =="" or $permisoGestionarPerfiles =="") {
				$this->responseRegistrar[0] = "Todos los campos son requeridos";
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
				$this->responseRegistrar[0] = "Perfil creado con exito";			
			}	
			return $this->responseRegistrar;
		}

		public function validarModificarPerfil($nombre, $permisoGestionarUsuarios, 
			$permisoVender, $permisoGestionarPerfiles)
		{
			if ($nombre =="") {
				$this->responseModificar[0] = "Ingrese un nombre";
			}
			if ($this->validar->esMayor($nombre,30)) {
				$this->responseModificar[1] = "El nombre debe contener maximo 30 caracteres";
			}
			if ($this->validar->esMenor($nombre,4)){
				$this->responseModificar[2] = "El nombre debe contener minimo 4 caracteres";
			}
			if (!($this->validar->esAlfabetico($nombre))){
				$this->responseModificar[3] = "El nombre debe ser alfabetico";
			}
			if (empty($this->responseModificar)) 
			{
				$this->perfil->modificarPerfil($nombre, $permisoGestionarUsuarios, 
					$permisoVender, $permisoGestionarPerfiles);
				$this->responseModificar[0] = "Perfil modificado con exito";			
			}	
			return $this->responseModificar;
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
			return $perfiles;
		}
	}
	/*$logica = new LogicaPerfil();
	//$status = $logica->validarModificarPerfil("root",0,0,0);
	$status = $logica->validarRegistrarPerfil("Admin",1,1,1);
	foreach ($status as $key) {
		echo $key;
	}*/
?>