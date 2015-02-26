<?php
	/**
	* 
	*/
	class Validaciones 
	{
		public function esAlfabetico($valor)
		{
			return ctype_alpha($valor);
		}

		public function esNumerico($valor)
		{
			return ctype_digit($valor);
		}

		public function esAlfanumerico($valor)
		{
			return ctype_alnum($valor);
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