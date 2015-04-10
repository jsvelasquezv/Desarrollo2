<?php
require_once '../libs/rb.php';
require_once 'ConexionBD.php';
Class Venta
{
	function __construct(){}

	public function crearFactura($cliente, $comision)
	{
		R::selectDatabase('default');
		$facturaBean = R::dispense('factura');
		$facturaBean->id_cliente = $cliente;
		$facturaBean->id_comision = $comision;
		R::store($facturaBean);
        R::close();
	}
}
	//$miFactura = new Venta();
	//$miFactura->crearFactura(12, 1);
?>