<?php
	/**
	* 
	*/
	class CoordinadorUsuario 
	{

		private $logicaUsuario; //LogicaUsuario
		
		public function __construct()
		{
			# code...
		}

		public function setLogicaUsuario($logicaU) //$logicaU:LogicaUsuario
		{
			# code...
		}

		public function getLogicaUsuario()
		{
			return $this->logicaUsuario;
		}

		public function modificarUsuario($usuario) //$Usuario:UsuarioVO
		{
			# code...
		}

		public function buscarUsuario($idUsuario) //$idUsuario:int
		{
			# code...
		}

		public function registrarUsuario($usuario) //$usuario:UsuarioVO
		{
			# code...
		}

		public function dardeBajaUsuario($idUsuario) //$idUsuario:int
		{
			# code...
		}

		public function asignarPerfil($usuario, $perfil) //$usuario:UsuarioVO, $perfil:PerfilVO
		{
			$usuario->tipoPerfil = $perfil->nombrePerfil;
		}

		public function modificarPerfil($perfil) //$perfil:PerfilVO
		{
			
		}

		public function buscarPerfil($nombre) //$nombre:string
		{
			$perfil = R::find('perfil', )
		}

		public function registrarPerfil($perfil) //$perfil:PerfilVO
		{
			# code...
		}

	}
?>