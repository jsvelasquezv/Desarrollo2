<?php
	/**
	* 
	*/

	require_once '../libs/rb.php';
	require_once '../modelos/ConexionBD.php';

	class Usuario 
	{
		
		function __construct()
		{
			
		}

		public function registrarUsuario($documento, $nombre, $apellidos, $email, 
			$nombreUsuario, $password, $ID)
		{
			R::selectDatabase('default');
        	$usuario = R::dispense('usuario');
        	$usuario->documento = $documento;
        	$usuario->nombre = $nombre;
        	$usuario->apellidos = $apellidos;
        	$usuario->email = $email;
        	$usuario->nombreUsuario = $nombreUsuario;
        	$usuario->password = $password;
        	$usuario->tipo_perfil = $ID;
        	R::store($usuario);
        	R::close();
		}

		public function asignarPerfil($nombrePerfil, $documento)
		{
			R::selectDatabase('default');
        	$perfil = R::findOne('perfil','nombre =?',[$nombrePerfil]);
        	$usuario = R::findOne('usuario','documento =?',[$documento]);
        	$usuario->tipoPerfil = $perfil['id'];
        	R::store($usuario);
        	R::close();
		}

		public function modificarUsuario($documento,$documentoN, $nombre, $apellidos, $email, 
			$nombreUsuario, $perfil)
		{
			R::selectDatabase('default');
        	$usuario = R::findOne('usuario', 'documento = ?',[$documento]);
        	$usuario->documento = $documentoN;
        	$usuario->nombre = $nombre;
        	$usuario->apellidos = $apellidos;
        	$usuario->email = $email;
        	$usuario->nombreUsuario = $nombreUsuario;
        	$usuario->tipoPerfil = $perfil;
        	R::store($usuario);
        	R::close();
		}

		public function buscarUsuario($parametro)
		{
			R::selectDatabase('default');

        	if (ctype_alpha($parametro)) 
        	{
        		$usuario = R::findOne('usuario', 'nombre_usuario = ?',[$parametro]);
        		R::close();
				return $usuario;
        	}
        	else
        	{
				$usuario = R::findOne('usuario', 'documento = ?',[$parametro]);
				R::close();
				return $usuario;
        	}
		}

		public function buscarUsuarioE($email)
		{
			R::selectDatabase('default');
			$usuario = R::findOne('usuario', 'email = ?',[$email]);
        	R::close();
			return $usuario;
		}

		public function darDeBajaUsuario($documento)
		{
			R::selectDatabase('default');
			$usuario = R::findOne('usuario', 'documento = ?',[$documento]);
			$usuario->estado = false;
			R::store($usuario);
			R::close();
		}

		public function getUsuarios()
		{
			R::selectDatabase('default');
        	$usuarios = R::findAll('usuario');
        	R::close();
        	return $usuarios;
		}
	}

	 // $user = new Usuario();
	// $user->registrarUsuario(116264525, "Juan", "Velasquez", "Velasquez94@hotmail.com", "juseve","j89s1994","Admin");
	// $user->asignarPerfil("Gasimba",116264525);
	 // $a = $user->buscarUsuarioN("juseve");
	 // echo $a['password'];
?>