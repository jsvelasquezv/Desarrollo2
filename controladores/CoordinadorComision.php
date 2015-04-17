<?php
require_once '../modelos/ValidarComision.php';

if (isset($_POST['guardar'])) {
	$nuevaComision = $_POST['porcentaje'];		
	$CoordinadorComision = new CoordinadorComision();
	$CoordinadorComision->coordinadorComision($nuevaComision);
}

Class CoordinadorComision
{
	private $validaComision;

	/**
	 * [__construct description]
	 */
	function __construct()
	{
		$this->validaComision = new ValidarComision();
	}

	/**
	 * [coordinadorComision description]
	 * @param  [type] $comision [description]
	 * @return [type]           [description]
	 */
	public function coordinadorComision($comision)
	{
		$this->validaComision->validaComision($comision);
		$errorComision = $this->validaComision->getResponseComision();
		if (!empty($errorComision)) {
			session_start();
			$_SESSION['errorComision'] = $errorComision;		
			header('Location: ../vistas/comision.php');		
		}
		else{
			session_start();
			$_SESSION['exitoComision'] = "Edicion exitosa";
			unset($_SESSION['errorComision']);
			header('Location: ../vistas/comision.php');
		}
	}
}
?>