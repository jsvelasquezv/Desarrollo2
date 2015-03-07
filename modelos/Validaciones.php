<?php
	/**
	* 
	*/
	class Validaciones 
	{

		private $numbers = array('0','1','2','3','4','5','6','7','8','9');
		private $letters = array(' ','a','b','c','d','e','f','g','h','i','j','k','l','m','n','ñ','o','p','q','r','s','t','u','v','w','x','y','z','á','é','í','ó','ú',
								'A','B','C','D','E','F','G','H','I','J','K','L','M','N','Ñ','O','P','Q','R','S','T','U','V','W','X','Y','Z','Á','É','Í','Ó','Ú',);

		public function esAlfabetico($valor)
		{
			$tam = strlen($valor);
			$salida1 = false;
			$salida2 = false;
			// El primer 'for' recorre todo el 'valor' (letra por letra)
			for ($i=0; $i < $tam; $i++) {
				$salida2 = false;
				// Segundo 'for' que recorre todo el arreglo de letras y verifica
				// si coinciden, en caso de que no, salta fuera de los dos 'for's 
				// y devolverá un falso
				foreach ($this->letters as $key) {
					if(substr($valor,$i,1) == $key){
						$salida2 = true;
						break;
					}
				}
				if(!$salida2)
					break;
		}
		if($salida2)
			$salida1 = true;

		return $salida1;
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