<?php
	/**
	* 
	*/
	require '../modelos/LogicaUsuario.php';
	class CoordinadorUsuario 
	{
		private $logicaUsuario; //LogicaUsuario
		
		public function __construct()
		{
			$logicaUsuario = new LogicaUsuario();
		}
		public function setLogicaUsuario($logicaU) //$logicaU:LogicaUsuario
		{
			$this->$logicaUsuario = $logicaU;
		}
		public function getLogicaUsuario()
		{
			return $this->logicaUsuario;
		}
		public function modificarUsuario($documento, $nombre, $apellidos, $email, 
			$nombreUsuario, $password, $tipoPerfil) //$Usuario:UsuarioVO
		{
			$this->logicaUsuario->validarModificarUsuario($documento, $nombre, $apellidos, $email, 
			$nombreUsuario, $password, $tipoPerfil);
		}
		public function buscarUsuario($idUsuario) //$idUsuario:int
		{
			$this->logicaUsuario->validarConsultaUsuario($idUsuario);
		}
		public function registrarUsuario($documento, $nombre, $apellidos, $email, 
			$nombreUsuario, $password, $tipoPerfil) //$usuario:UsuarioVO
		{
			$this->logicaUsuario->validarRegistroUsuario($documento, $nombre, $apellidos, $email, 
			$nombreUsuario, $password, $tipoPerfil);
		}
		public function dardeBajaUsuario($idUsuario) //$idUsuario:int
		{
			$this->logicaUsuario->validarDardeBajaUsuario($idUsuario);
		}
		public function loguear($nombreUsuario, $password)
		{
			this->logicaUsuario->validarLogin($nombreUsuario, $password);
		}
		//Por qué mierda estos metodos estaban por aca xD
		// public function asignarPerfil($usuario, $perfil) //$usuario:UsuarioVO, $perfil:PerfilVO
		// {
		// 	$usuario->tipoPerfil = $perfil->nombrePerfil;
		// }
		// public function modificarPerfil($perfil) //$perfil:PerfilVO
		// {
			
		// }
		// public function buscarPerfil($nombre) //$nombre:string
		// {
		// 	$perfil = R::find('perfil', )
		// }
		// public function registrarPerfil($perfil) //$perfil:PerfilVO
		// {
		// 	# code...
		// }
	}
?>