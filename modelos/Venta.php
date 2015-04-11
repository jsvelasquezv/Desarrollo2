<?php
require_once '../libs/rb.php';
require_once 'ConexionBD.php';
Class Venta
{
	/**
	 * [__construct description]
	 */
	function __construct(){}

	/**
	 * [crearFactura description]
	 * @param  [type] $cliente  [description]
	 * @param  [type] $comision [description]
	 * @param  [type] $producto [description]
	 * @param  [type] $cantidad [description]
	 * @param  [type] $precio   [description]
	 * @return [type]           [description]
	 */
	public function crearFactura($cliente, $comision, $producto, $cantidad)
	{
		R::selectDatabase('default');
		$facturaBean = R::dispense('factura');
		$facturaBean->id_cliente = $cliente;
		$facturaBean->id_comision = $comision;
		$idFactura = R::store($facturaBean);

		$detalleBean = R::dispense('detalle');
		$detalleBean->id_producto = $producto;
		$detalleBean->cantidad = $cantidad;
		$detalleBean->id_factura = $idFactura;
		R::store($detalleBean);
        R::close();
	}

	/**
	 * [getFactura description]
	 * @param  [type] $idFactura [description]
	 * @return [type]            [description]
	 */
	public function getFactura($idFactura)
	{
		R::selectDatabase('default');
		$factura = R::findOne('factura', 'id = ?',[$idFactura]);
		R::close();#se cierra el almacén de Beans
		return $factura;
	}


	public function setEstado($idFactura, $estado)
	{
		R::selectDatabase('default');
		$factura = R::load('factura', $idFactura);
		$factura->estado = $estado;
		R::store($factura);
		R::close();
	}


	public function obtenerPedidosVendedor($username)
	{
		R::selectDatabase('default');
		$rows = R::getAll('SELECT d.id_factura, f.fecha, (SELECT u.nombre FROM usuario AS u WHERE u.id=f.id_cliente) AS comprador, 
						p.nombre, p.valor_unitario, d.cantidad, f.estado FROM (detalle AS d JOIN producto AS p ON d.id_producto=p.id) 
						JOIN factura AS f ON d.id_factura=f.id WHERE p.usuario_username = ?', [$username]);
		R::close();
		return $rows;
	}
}
	//$miFactura = new Venta();
	//$miFactura->crearFactura(12, 1, 65, 2);
	//miFactura->setEstado(4, "cancelado");
	//$f = $miFactura->getFactura(4);
	//foreach ($f as $key) {
		//echo $f;
	//}
	//$resultado = $miFactura->obtenerPedidosVendedor("camv");
	//foreach ($resultado as $key) {
	//	echo $key['nombre'];
	//}
?>