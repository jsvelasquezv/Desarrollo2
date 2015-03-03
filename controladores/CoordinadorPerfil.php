<?php
	/**
	* 
	*/
	require_once '../modelos/LogicaPerfil.php';

	if (isset($_GET['edit'])) {
		$edit = $_GET['edit'];
		$coordinador = new CoordinadorPerfil();
		$editable = $coordinador->buscarPerfil($edit);
		header('Location: ../vistas/editarPerfil.php?nombre='.$editable['nombre'].'&permiso1='
		.$editable['permisoGestionarUsuarios'].'&permiso2='.$editable['permisoVender']
		.'&permiso3='.$editable['permisoGestionarPerfiles']);

	}
	if (isset($_POST['crear'])) {
		$nombre = $_POST['nombre'];
		$permiso1;
		$permiso2;
		$permiso3;
		if (!isset($_POST['permiso1'])) {
			$permiso1 = 0;
			echo $permiso1;
		}elseif ($_POST['permiso1']==true) {
			$permiso1 = 1;
			echo $permiso1;
		}

		if (!isset($_POST['permiso2'])) {
			$permiso2 = 0;
			echo $permiso2;
		}elseif ($_POST['permiso2']==true) {
			$permiso2 = 1;
			echo $permiso2;
		}

		if (!isset($_POST['permiso3'])) {
			$permiso3 = 0;
			echo $permiso3;
		}elseif ($_POST['permiso3']==true) {
			$permiso3 = 1;
			echo $permiso3;
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
			echo $permiso1;
		}elseif ($_POST['permiso1']==true) {
			$permiso1 = 1;
			echo $permiso1;
		}

		if (!isset($_POST['permiso2'])) {
			$permiso2 = 0;
			echo $permiso2;
		}elseif ($_POST['permiso2']==true) {
			$permiso2 = 1;
			echo $permiso2;
		}

		if (!isset($_POST['permiso3'])) {
			$permiso3 = 0;
			echo $permiso3;
		}elseif ($_POST['permiso3']==true) {
			$permiso3 = 1;
			echo $permiso3;
		}		
		$coordinador = new CoordinadorPerfil();
		$coordinador->modificarPerfil($nombre, $nuevoNombre, $permiso1,$permiso2,$permiso3);		
	}

	class CoordinadorPerfil 
	{
		private $logicaPerfil; //LogicaPerfil

		public function __construct()
		{
			$this->logicaPerfil = new LogicaPerfil();
		}
		
		public function modificarPerfil($nombre, $nuevoNombre, $permisoGestionarUsuarios,$permisoVender, $permisoGestionarPerfiles) //$perfil:PerfilVO
		{
			//$editable = $this->logicaPerfil->validarConsultarPerfil();
			$this->logicaPerfil->validarModificarPerfil($nombre, $nuevoNombre, $permisoGestionarUsuarios, 
												 $permisoVender, $permisoGestionarPerfiles);
			header('Location: ../vistas/gestionarPerfiles.php');
		}
		public function buscarPerfil($idPerfil) //$idPerfil:int
		{
			$perfil = $this->logicaPerfil->validarConsultarPerfil($idPerfil);
			return $perfil;
			// Descomentar la linea de arriba cuando se haga la funcion validarConsultarPerfil en LogicaPerfil
		}
		public function registrarPerfil($nombre, $permisoGestionarUsuarios, $permisoVender, $permisoGestionarPerfiles) // //$perfil:PerfilVO
		{
			$this->logicaPerfil->validarRegistrarPerfil($nombre, $permisoGestionarUsuarios, 
												$permisoVender, $permisoGestionarPerfiles);
			header('Location: ../vistas/gestionarPerfiles.php');
		}
	}
?>