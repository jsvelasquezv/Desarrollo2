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
			if ((strlen($parametro) <6 ) || (strlen($parametro) > 60)){
				return preg_match('/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4})$/', $parametro);
			}else{
				return 0;
			}
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
?>