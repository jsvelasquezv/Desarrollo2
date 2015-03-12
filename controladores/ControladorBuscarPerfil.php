<?php 
	/**
	* 
	*/
	require_once '../modelos/Perfil.php';
	require_once '../modelos/Validaciones.php';

	class ClassName ControladorBuscarPerfil
	{
		private $perfil;
		private $Validaciones;
		private $responseBuscar;
		
		function __construct()
		{
			$this->perfil = new Perfil();
			$this->validaciones = new Validaciones();
		}

		public function buscarPerfil($parametro)
		{
			$perfilBuscado = $this->perfil->buscarPerfil($parametro);
			if(empty($perfilBuscado)){
				$this->responseBuscar[0] = "No exite el perfil ";
			}else{
				return $perfilBuscado;
			}
		}

		public function getPerfiles()
		{
			$perfiles = $this->perfil->getPerfiles();
			// echo $perfiles;
			return $perfiles;
		}		
	}
?>