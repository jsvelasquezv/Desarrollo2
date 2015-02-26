<?php
	/**
	* 
	*/
	require '../libs/rb.php';
	
	class Perfil
	{
		
		public function __construct()
		{
			
		}

		public function registrarPerfil($nombre, $permisoGestionarUsuarios, 
			$permisoVender, $permisoGestionarPerfiles)
		{
			R::setup('mysql:host=localhost;dbname=tienda',
        	'root','holi');
			$perfil = R::dispense( 'perfil' );
			$perfil->nombre = $nombre;
			$perfil->permisoGestionarUsuarios = $permisoGestionarUsuarios;
			$perfil->permisoVender = $permisoVender;
			$perfil->permisoGestionarPerfiles = $permisoGestionarPerfiles;
			$hola = R::store($perfil);
			echo $hola;
			R::close();
		}

		public function buscarPerfil($nombre)
		{
			R::setup('mysql:host=localhost;dbname=tienda',
        	'root','holi');
			$perfil = R::findOne('perfil', 'nombre = ?',[$nombre]);
			echo $perfil;
			R::close();
		}

		public function modificarPerfil($nombre, $permisoGestionarUsuarios, 
			$permisoVender, $permisoGestionarPerfiles)
		{
			R::setup('mysql:host=localhost;dbname=tienda',
        	'root','holi');
        	$perfil = R::findOne('perfil', 'nombre = ?',[$nombre]);
       		$perfil->permisoGestionarUsuarios = $permisoGestionarUsuarios;
			$perfil->permisoVender = $permisoVender;
			$perfil->permisoGestionarPerfiles = $permisoGestionarPerfiles;
       		R::store($perfil);
       		$perfil = R::findOne('perfil', 'nombre = ?',[$nombre]);
       		echo $perfil;
        	R::close();
		}

	}

	// $perfil = new Perfil();
	// $perfilVO->modificarPerfil("Admin", "AllPermisos", 0, 0, 0);
	// $perfil->buscarPerfil("Krusty");
	//$perfilVO->registrarPerfil(1000,'Krusty','AllPermisos', 0, 1 ,0);
?>