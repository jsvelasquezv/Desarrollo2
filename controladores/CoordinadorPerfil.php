<?php
	/**
	* 
	*/
	//require_once '../modelos/LogicaPerfil.php';
	require_once '../modelos/ValidarConsultarPerfil.php';
	require_once '../modelos/ValidarRegistrarPerfil.php';
	require_once '../modelos/ValidarModificarPerfil.php';

	if (isset($_GET['edit'])) {
		$edit = $_GET['edit'];
		$coordinador = new CoordinadorPerfil();
		$editable = $coordinador->buscarPerfil($edit);
		header('Location: ../vistas/editarPerfil.php?nombre='.$editable['nombre'].'&permiso1='
		.$editable['permisoGestionarUsuarios'].'&permiso2='.$editable['permisoVender']
		.'&permiso3='.$editable['permisoGestionarPerfiles']);
	}
	if (isset($_POST['buscarP'])) {
		$nombre = $_POST['nombreP'];
		$coordinador = new CoordinadorPerfil();
		$editable = $coordinador->buscarPerfil($nombre); 
		if (empty($editable)) {
			session_start();
			$_SESSION['eBuscarP'] = 1;
			header('Location: ../vistas/gestionarPerfiles.php');
		}else{			
		header('Location: ../vistas/editarPerfil.php?nombre='.$editable['nombre'].'&permiso1='
		.$editable['permisoGestionarUsuarios'].'&permiso2='.$editable['permisoVender']
		.'&permiso3='.$editable['permisoGestionarPerfiles']);
		}
	}
	if (isset($_POST['crear'])) {
		$nombre = $_POST['nombre'];
		$permiso1;
		$permiso2;
		$permiso3;
		if (!isset($_POST['permiso1'])) {
			$permiso1 = 0;
			// echo $permiso1;
		}elseif ($_POST['permiso1']==true) {
			$permiso1 = 1;
			//echo $permiso1;
		}

		if (!isset($_POST['permiso2'])) {
			$permiso2 = 0;
			echo $permiso2;
		}elseif ($_POST['permiso2']==true) {
			$permiso2 = 1;
			// echo $permiso2;
		}

		if (!isset($_POST['permiso3'])) {
			$permiso3 = 0;
			//echo $permiso3;
		}elseif ($_POST['permiso3']==true) {
			$permiso3 = 1;
			// echo $permiso3;
		}		
		$coordinador = new CoordinadorPerfil();
		$coordinador->registrarPerfil($nombre,$permiso1,$permiso2,$permiso3);
	}

	if (isset($_POST['editar'])) {
		$nombre = $_POST['antiguo'];
		$nuevoNombre = $_POST['nuevoNombre'];
		$permiso1;
		$permiso2;
		$permiso3;
		if (!isset($_POST['permiso1'])) {
			$permiso1 = 0;
			// echo $permiso1;
		}elseif ($_POST['permiso1']==true) {
			$permiso1 = 1;
			// echo $permiso1;
		}

		if (!isset($_POST['permiso2'])) {
			$permiso2 = 0;
			// echo $permiso2;
		}elseif ($_POST['permiso2']==true) {
			$permiso2 = 1;
			// echo $permiso2;
		}

		if (!isset($_POST['permiso3'])) {
			$permiso3 = 0;
			// echo $permiso3;
		}elseif ($_POST['permiso3']==true) {
			$permiso3 = 1;
			// echo $permiso3;
		}		
		$coordinador = new CoordinadorPerfil();
		$coordinador->modificarPerfil($nombre, $nuevoNombre, $permiso1,$permiso2,$permiso3);		
	}

	class CoordinadorPerfil 
	{
		//private $logicaPerfil; //LogicaPerfil
		private $validarConsultarPerfil;
		private $validarModificarPerfil;
		private $validarRegistrarPerfil;

		public function __construct()
		{
			//$this->logicaPerfil = new LogicaPerfil();
			$this->validarConsultarPerfil = new ValidarConsultarPerfil();
			$this->validarRegistrarPerfil = new ValidarRegistrarPerfil();
			$this->validarModificarPerfil = new ValidarModificarPerfil();
		}
		
		public function modificarPerfil($nombre, $nuevoNombre, $permisoGestionarUsuarios,$permisoVender, $permisoGestionarPerfiles) //$perfil:PerfilVO
		{
			//$editable = $this->logicaPerfil->validarConsultarPerfil();
			$this->validarModificarPerfil->validarModificar($nombre, $nuevoNombre, $permisoGestionarUsuarios, 
												 $permisoVender, $permisoGestionarPerfiles);

			$errores = $this->validarModificarPerfil->getResponse();
			if (!empty($errores)) {
				session_start();
				$_SESSION['eUpdatePerfil'] = $errores;
				#Aca es donde me redeirgi si hay un error al editar un perfil
				header('Location: ../vistas/editarPerfil.php?nombre='.$nombre.'&permiso1='.$permisoGestionarUsuarios
					.'&permiso2='.$permisoVender.'&permiso3='.$permisoGestionarPerfiles);
			}
			else
			{	
				session_start();
				$_SESSION['exitoModificar'] = 1;
				header('Location: ../vistas/gestionarPerfiles.php');
			}
			// echo $nombre;
			// echo $nuevoNombre;
			// echo $permisoGestionarUsuarios;
			// echo $permisoVender;
			// echo $permisoGestionarPerfiles;
			
		}

		public function buscarPerfil($idPerfil) //$idPerfil:int
		{
			$perfil = $this->validarConsultarPerfil->validarConsultar($idPerfil);
			return $perfil;
		}

		public function registrarPerfil($nombre, $permisoGestionarUsuarios, $permisoVender, $permisoGestionarPerfiles) // //$perfil:PerfilVO
		{
			$this->validarRegistrarPerfil->validarRegistrar($nombre, $permisoGestionarUsuarios, 
												$permisoVender, $permisoGestionarPerfiles);

			$errores = $this->validarRegistrarPerfil->getResponse();
			if (!empty($errores)) {
				session_start();
				$_SESSION['eRegistroPerfil'] = $errores;		
				header('Location: ../vistas/registrarPerfil.php');		
			}
			else
			{
				$_SESSION['exitoRegistrar'] = 1;
				unset($_SESSION['eRegistroPerfil']);
				header('Location: ../vistas/gestionarPerfiles.php');
			}
			
			foreach ($_SESSION['eRegistroPerfil'] as $key ) {
				# code...
			echo $key;
			}
			echo $nombre;
			echo $permisoGestionarUsuarios;
			echo $permisoVender;
			echo $permisoGestionarPerfiles;
		}
	}
	$registrar = new CoordinadorPerfil();
	$error = $registrar->registrarPerfil("Super Admin",1,1,1);
?>