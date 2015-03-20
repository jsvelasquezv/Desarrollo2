<?php 
	/**
	* 
	*/
	require_once 'Perfil.php';
	require_once 'Validaciones.php';

	class ValidarConsultarPerfil
	{
		private $perfilModelo;
		private $validaciones;
		private $responseConsultar;
		
		function __construct()
		{
			$this->perfilModelo = new Perfil();
			$this->validaciones = new Validaciones();
		}

		public function validarConsultar($nombre)
		{
			$perfil = $this->perfilModelo->buscarPerfil($nombre);
			if(empty($perfil))
			{
				$this->responseConsultar[0] = "No exite el perfil ";
			}
			else
			{
				return $perfil;
			}
		}

		public function consultarTodos()
		{
			$perfiles = $this->perfilModelo->getPerfiles();
			return $perfiles;
		}

		public function getResponse()
		{
			return $this->responseConsultar;
		}
	}
	// $validar = new ValidarConsultarPerfil();
	// echo $validar->consultarPerfil("hola mundo"); 
?>