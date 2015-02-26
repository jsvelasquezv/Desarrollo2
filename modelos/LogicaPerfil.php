<?php
	/**
	* 
	*/

	require 'Perfil.php';

	class LogicaPerfil
	{
		
		private $coordinadorP; //CoordinadorPerfil
		private $errores;
		private $perfil;

		public function __construct()
		{
			# code...
		}

		public function setCoordinadorP($coordinador) //coordinador:CoordinadorPerfil
		{
			$this->coordinadorP = $coordinador;
		}

		public function validarRegistoPerfil($perfil) //perfil:PerfilVO
		{
		
		}

		public function validarConsultaPerfil($nombrePerfil) //perfil:string
		{
			# code...
		}

		public function validarModificarPerfil($perfil) //perfil:PerfilVO
		{
			# code...
		}

		public function validarDarDeBajaPerfil($nombrePerfil) //nombrePerfil:string
		{
			# code...
		}

	}
?>