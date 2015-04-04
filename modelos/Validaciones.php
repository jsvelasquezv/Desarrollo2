<?php
	/**
	* 
	*/
	class Validaciones 
	{

		public function esAlfabetico($parametro)
		{
			return preg_match('/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ ]*$/', $parametro);
		}

		public function esNumerico($parametro)
		{
			return preg_match('/^[0-9]*$/', $parametro);
		}

		public function esAlfanumerico($parametro)
		{
			return preg_match('/^[a-zA-ZáéíóúàèìòùÀÈÌÒÙÁÉÍÓÚñÑüÜ0-9]*$/', $parametro);
		}

		public function validarEmail($parametro)
		{	
			return preg_match('/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4})$/', $parametro);
		}

		public function esUrl($parametro){
			return preg_match('/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \?=.-]*)*\/?$/ ', $parametro);
		}

		public function esEstado($parametro)
		{
			if(strcasecmp($parametro, "En venta") == 0 or strcasecmp($parametro, "Vendido") == 0){
				return true;
			}
			else return false;
		}

		public function esMayor($valor, $tamanoMax)
		{
			if (strlen($valor) > $tamanoMax) {
				return true;
			}
			else
			{
				return false;
			}
		}
		
		public function esMenor($valor, $tamanoMin)
		{
			if (strlen($valor) < $tamanoMin) {
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	$validaciones = new Validaciones();
	// echo $validaciones->esAlfabetico("hola");
	//echo $validaciones->esUrl("wwww.hola.com");
	//home/sebastian/.rvm/gems/ruby-2.2.0/bin:/home/sebastian/.rvm/gems/ruby-2.2.0@global/bin:/home/sebastian/.rvm/rubies/ruby-2.2.0/bin:
?>









