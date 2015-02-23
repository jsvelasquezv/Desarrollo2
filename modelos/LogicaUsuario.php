<?php
	/**
	* 
	*/
	class LogicaUsuario
	{
		private $coordinadorU; #coordinadorU:CoordinadorUsuario

		public function __construct()
		{
			# code...
		}

		public function setCoordinador($coordinador) //coordinador:CoordinadorUsuario
		{
			$this->coordinadorU = $coordinador;
		}

		public function validarRegistroUsuario($usuario) //usuario:usuarioVO
		{
			
		}

		public function validarConsultaUsuario($documento) //documento:int
		{
			# code...
		}

		public function validarModificarUsuario($usuario) //usuario:usuarioVO
		{
			# code...
		}

		public function validarDardeBajaUsuario($documento) //documento:int
		{
			# code...
		}



	}
?>