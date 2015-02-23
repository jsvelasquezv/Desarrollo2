<?php
	/**
	* 
	*/
	class UsuarioVO 
	{
		private $nombre;  //string
		private $apellido; //string
		private $username; //string
		private $password; //string
		private $correo; //string
		private $documento; //int
		private $tipoPerfil; //string
		private $estado; //boolean

		public function __construct()
		{
			# code...
		}

		public function getNombre()
		{
			return $this->nombre;
		}

		public function getApellido()
		{
			return $this->apellido;
		}

		public function getUsername()
		{
			return $this->username;
		}

		public function getPassword()
		{
			return $this->password;
		}

		public function getCorreo()
		{
			return $this->correo;
		}

		public function getDocumento()
		{
			return $this->documento;
		}

		public function getTipoPerfil()
		{
			return $this->tipoPerfil;
		}

		public function getEstado()
		{
			return $this->estado;
		}


		public function setNombre($nombre) //$nombre:string
		{
			$this->nombre = $nombre;
		}

		public function setApellido($apellido) //$apellido:string
		{
			$this->apellido = $apellido;
		}

		public function setUserName($username) //$username:string
		{
			$this->username = $username;
		}

		public function setPassword($password) //$password:string
		{
			$this->password = $password;
		}

		public function setCorreo($correo) //$correo:string
		{
			$this->correo = $correo;
		}

		public function setDocumento($documento) //$documento:int
		{
			$this->documento = $documento;
		}

		public function setTipoPerfil($tipoPerfil) //$tipoPerfil:string
		{
			$this->tipoPerfil = $tipoPerfil;
		}

		public function setEstado($estado) //$estado:boolean
		{
			$this->estado = $estado;
		}

	}
?>