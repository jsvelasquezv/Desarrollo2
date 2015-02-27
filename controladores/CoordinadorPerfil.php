<?php
	/**
	* 
	*/
	require '../modelos/LogicaPerfil.php';
	class CoordinadorPerfil 
	{
		private $logicaPerfil; //LogicaPerfil
		public function __construct()
		{
			$logicaPerfil = new LogicaPerfil();
		}
		public function getLogicaPerfil()
		{
			return $this->logicaPerfil;
		}
		public function setLogicaPerfil($logicaPerfil)
		{
			$this->logicaPerfil = $logicaPerfil;
		}
		public function asignarPerfil($usuario, $perfil) //$usuario:UsuarioVO, $perfil:PerfilVO
		{
			#Aca se supone que asigne un perfil a un usuario
		}
		public function modificarPerfil($nombre, $permisoGestionarUsuarios,$permisoVender, $permisoGestionarPerfiles) //$perfil:PerfilVO
		{
			$this->logicaPerfil.validarModificarPerfil($nombre, $permisoGestionarUsuarios, 
												 $permisoVender, $permisoGestionarPerfiles);
		}
		public function buscarPerfil($idPerfil) //$idPerfil:int
		{
			//$this->logicaPerfil.validarConsultarPerfil($idPerfil) 
			// Descomentar la linea de arriba cuando se haga la funcion validarConsultarPerfil en LogicaPerfil
		}
		public function registrarPerfil($nombre, $permisoGestionarUsuarios,$permisoVender, $permisoGestionarPerfiles) // //$perfil:PerfilVO
		{
			//se crea un perfil solo si ya se ha validado los campos correctamente
			$this->logicaPerfil.validarRegistroPerfil($nombre, $permisoGestionarUsuarios, 
												$permisoVender, $permisoGestionarPerfiles);
		}
	}
?>