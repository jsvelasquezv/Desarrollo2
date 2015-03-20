<?php 
	/**
	* 
	*/
	require_once 'Validaciones.php';
	require_once 'Perfil.php';
	require_once 'Usuario.php';

	class ValidarLogin 
	{
		private $responseLogin;
		private $usuarioModelo;
		private $perfilModelo;

		function __construct()
		{
			$this->usuarioModelo = new Usuario();
			$this->perfilModelo = new Perfil();
		}

		public function validarLogin($nombreUsuario, $password)
		{
			$usuario = $this->usuarioModelo->buscarUsuario($nombreUsuario);
			// /echo "user".$usuario;
			if (empty($usuario)) 
			{
				$this->responseLogin[0] = "El usuario no esta registrado";
			}
			elseif($password != $usuario['password'])
			{
				$this->responseLogin[1] = "Contrasena incorrecta";
			}
			elseif ($usuario['estado']==0) 
			{
				$this->responseLogin[2] = "El usuario se encuentra inactivo, por favor contactese con el 
				administrador";
			}
			elseif (empty($this->responseLogin)) 
			{
				$perfilAsignado = $this->perfilModelo->buscarPerfil($usuario['tipo_perfil']);
				session_start();
				$_SESSION['logueado'] = true;
				$_SESSION['user'] = $usuario['nombre_usuario'];
				$_SESSION['permisoDeVender'] = $perfilAsignado['permiso_vender'];
				$_SESSION['permisoDeGestionarPerfiles'] = $perfilAsignado['permiso_gestionar_perfiles'];
				$_SESSION['permisoDeGestionarUsuarios'] = $perfilAsignado['permiso_gestionar_usuarios'];
			}		
		}

		public function getResponse()
		{
			return $this->responseLogin;
		}
	}
?>