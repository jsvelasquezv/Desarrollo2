<?php
	/**
	* 
	*/

	require '../libs/rb.php';

	class Usuario 
	{
		
		function __construct()
		{
			
		}

		public function registrarUsuario($documento, $nombre, $apellidos, $email, 
			$nombreUsuario, $password, $tipoPerfil)
		{
			R::setup('mysql:host=localhost;dbname=tienda',
        	'root','holi');
        	$usuario = R::dispense('usuario');
        	$usuario->documento = $documento;
        	$usuario->nombre = $nombre;
        	$usuario->apellidos = $apellidos;
        	$usuario->email = $email;
        	$usuario->nombreUsuario = $nombreUsuario;
        	$usuario->password = $password;
        	$usuario->tipoPerfil = $tipoPerfil;
        	R::store($usuario);
        	R::close();
		}

		public function asignarPerfil($nombrePerfil, $documento)
		{
			R::setup('mysql:host=localhost;dbname=tienda',
        	'root','holi');
        	$perfil = R::findOne('prueba','nombre =?',[$nombrePerfil]);
        	$usuario = R::findOne('usuario','documento =?',[$documento]);
        	$usuario->tipoPerfil = $perfil['id'];
        	R::store($usuario);
        	echo $usuario;
        	R::close();
		}

		public function modificarUsuario($documento, $nombre, $apellidos, $email, 
			$nombreUsuario, $password, $tipoPerfil)
		{
			R::setup('mysql:host=localhost;dbname=tienda',
        	'root','holi');
        	$usuario = R::findOne('usuario', 'documento = ?',[$documento]);
        	$usuario->documento = $documento;
        	$usuario->nombre = $nombre;
        	$usuario->apellidos = $apellidos;
        	$usuario->email = $email;
        	$usuario->nombreUsuario = $nombreUsuario;
        	$usuario->password = $password;
        	$usuario->tipoPerfil = $tipoPerfil;
        	R::store($usuario);
        	R::close();
		}

		public function bucarUsuario($documento)
		{
			R::setup('mysql:host=localhost;dbname=tienda',
        	'root','holi');
			$usuario = R::findOne('usuario', 'documento = ?',[$documento]);
			R::close();
			return $usuario;
		}

		public function darDeBajaUsuario($documento)
		{
			R::setup('mysql:host=localhost;dbname=tienda',
        	'root','holi');
			$usuario = R::findOne('usuario', 'documento = ?',[$documento]);
			$usuario->estado = false;
			R::store($usuario);
			R::close();
		}
	}

	// $user = new Usuario();
	// $user->registrarUsuario(116264525, "Juan", "Velasquez", "Velasquez94@hotmail.com", "juseve","j89s1994","Admin");
	// $user->asignarPerfil("Gasimba",116264525);
?>