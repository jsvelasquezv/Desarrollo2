<?php
	/**
	* 
	*/
	class PerfilVO 
	{
		private $nombre; //string
		private $permisos; //array
		private $id; //int
		
		public function __construct()
		{
			# code...
		}

		public function getNombre()
		{
			return $this->nombre;
		}

		public function getPermisos()
		{
			return $this->permisos;
		}

		public function getId()
		{
			return $this->id;
		}

		public function setNombre($nombre) //$nombre:string
		{
			$this->nombre = $nombre;
		}

		public function setPermisos($permisos) //$permisos:array
		{
			$this->permisos = $permisos;
		}

		public function setId($id) //$id:int
		{
			$this->id = $id;
		}


	}
?>