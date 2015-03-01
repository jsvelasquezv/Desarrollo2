<?php
	/**
	* 
	*/
	require_once '../modelos/LogicaUsuario.php';
	require_once '../modelos/LogicaPerfil.php';

	if(isset($_POST["ingresar"])){	
		$username = $_POST["username"]; 
		$contrasena = $_POST["password"];
		$coordinador = new CoordinadorUsuario();
		$coordinador->loguear($username, $contrasena);
	}elseif (isset($_POST["recuperar"])) {
		
		header('Location: ../index.php');
	}

	class CoordinadorUsuario 
	{
		private $logicaUsuario; //LogicaUsuario
		private $logicaPerfil;
		
		public function __construct()
		{
			$this->logicaUsuario = new LogicaUsuario();
			$this->logicaPerfil = new LogicaPerfil();
		}

		public function loguear($nombreUsuario, $password)
		{
			$this->logicaUsuario->validarLogin($nombreUsuario,$password);		
		}
		
		public function modificarUsuario($documento, $nombre, $apellidos, $email, 
			$nombreUsuario, $password, $tipoPerfil)
		{
			$this->logicaUsuario->validarModificarUsuario($documento, $nombre, $apellidos, $email, 
			$nombreUsuario, $password, $tipoPerfil);
		}
		public function buscarUsuario($documento)
		{
			$this->logicaUsuario->validarConsultaUsuario($documento);
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