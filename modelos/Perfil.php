<?php
	/**
	* 
	*/
	require_once '../libs/rb.php';
	require_once '../modelos/ConexionBD.php';

	class Perfil
	{
		
		public function __construct()
		{
			
		}

		public function registrarPerfil($nombre, $permisoGestionarUsuarios, 
			$permisoVender, $permisoGestionarPerfiles)
		{
			R::selectDatabase('default');
			$perfil = R::dispense( 'perfil' );
			$perfil->nombre = $nombre;
			$perfil->permisoGestionarUsuarios = $permisoGestionarUsuarios;
			$perfil->permisoVender = $permisoVender;
			$perfil->permisoGestionarPerfiles = $permisoGestionarPerfiles;
			R::store($perfil);
			// echo $perfil->nombre;
			// echo $perfil->permisoGestionarUsuarios;
			// echo $perfil->permisoVender;
			// echo $perfil->permisoGestionarPerfiles;
			R::close();
		}

		public function buscarPerfil($parametro)
		{
			R::selectDatabase('default');
        	if (ctype_digit($parametro))
        	{
        		$perfil = R::findOne('perfil', 'id = ?',[$parametro]);
      			R::close();
				return $perfil;
        	}
        	else
        	{
				$perfil = R::findOne('perfil', 'nombre = ?',[$parametro]);
				R::close();
				return $perfil;
        	}
		}

		public function modificarPerfil($nombre, $nuevoNombre, $permisoGestionarUsuarios, 
			$permisoVender, $permisoGestionarPerfiles)
		{
			R::selectDatabase('default');
        	$perfil = R::findOne('perfil', 'nombre = ?',[$nombre]);
        	$perfil->nombre = $nuevoNombre;
       		$perfil->permisoGestionarUsuarios = $permisoGestionarUsuarios;
			$perfil->permisoVender = $permisoVender;
			$perfil->permisoGestionarPerfiles = $permisoGestionarPerfiles;
       		R::store($perfil);
        	R::close();
		}

		public function getPerfiles()
		{
			R::selectDatabase('default');
            $perfiles = R::findAll('perfil');
        	//$perfil = R::findOne('perfil', 'nombre = ?',[$nombre]);
        	// var_dump($perfil);
        	R::close();
        	return $perfiles;
		}
	}
	// $perfil = new Perfil();
	// $perfiles = $perfil->getPerfiles();
	// foreach ($perfiles as $key) {
	// 	echo $key['id'];
	// 	echo $key['nombre'];
	// }
	/*$perfil = new Perfil();
	$perfil->modificarPerfil('Admin','Root',1,1,1);*/

	/*$perfil = new Perfil();
	// $perfilVO->modificarPerfil("Admin", "AllPermisos", 0, 0, 0);
	// $perfil2 = new Perfil();
	$perfils  =$perfil->buscarPerfil(1);
	echo $perfils['nombre'];
	// $perfil2->buscarPerfil('Admin');
	$a  = $perfil->registrarPerfil('Default', 0, 1 ,0);
	echo $a;*/
?>