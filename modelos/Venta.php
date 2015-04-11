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

	/**
	 * [setEstado description]
	 * @param [type] $idFactura [description]
	 * @param [type] $estado    [description]
	 */
	public function setEstado($idFactura, $estado)
	{
		R::selectDatabase('default');
		$factura = R::load('factura', $idFactura);
		$factura->estado = $estado;
		R::store($factura);
		R::close();
	}

	/**
	 * [obtenerPedidosVendedor description]
	 * @param  [type] $username [description]
	 * @return [type]           [description]
	 */
	public function obtenerPedidosVendedor($username)
	{
		R::selectDatabase('default');
		$rows = R::getAll('SELECT d.id_factura, f.fecha, (SELECT u.nombre FROM usuario AS u WHERE u.id=f.id_cliente) AS comprador, 
						p.nombre, p.valor_unitario, d.cantidad, f.estado FROM (detalle AS d JOIN producto AS p ON d.id_producto=p.id) 
						JOIN factura AS f ON d.id_factura=f.id WHERE p.usuario_username = ? and f.estado ="aprobado"', [$username]);
		R::close();
		return $rows;
	}

	/**
	 * [actualizarStock description]
	 * @param  [type] $idFactura [description]
	 * @return [type]            [description]
	 */
	public function actualizarStock($idFactura)
	{
		R::selectDatabase('default');
		$producto = R::getCell('SELECT id_producto FROM detalle WHERE id_factura = ?', [$idFactura]);
		$cantidadPedida = R::getCell('SELECT cantidad FROM detalle WHERE id_factura = ?', [$idFactura]);
		$cantidadProducto = R::getCell('SELECT cantidad FROM producto WHERE id = ?', [$producto]);

		$actualizacion = R::load('producto', $producto);
		$actualizacion->cantidad = $cantidadProducto-$cantidadPedida;
		R::store($actualizacion);
		R::close();
	}


	/**
	 * [obtenerComprasCliente description]
	 * @param  [type] $username [description]
	 * @return [type]           [description]
	 */
	public function obtenerComprasCliente($username)
	{
		R::selectDatabase('default');
		$consulta = R::getAll('SELECT d.id_factura, f.fecha, p.usuario_username AS vendedor, p.nombre, p.valor_unitario, 
						     d.cantidad, f.estado FROM (detalle AS d JOIN producto AS p ON d.id_producto=p.id) 
						     JOIN factura AS f ON d.id_factura=f.id WHERE 
						     (select u.nombre_usuario from usuario as u where u.id=f.id_cliente) = ?', [$username]);
		R::close();
		return $consulta;
	}

	/**
	 * [cancelarCompra description]
	 * @param  [type] $idFactura [description]
	 * @return [type]            [description]
	 */
	public function cancelarCompra($idFactura)
	{
		R::selectDatabase('default');
		$factura = R::findOne('factura', 'id = ?',[$idFactura]);
		R::trash($factura);
		R::close();
	}

	/**
	 * [getFacturasAprobados description]
	 * @return [type] [description]
	 */
	public function getFacturasAprobadas($estado)
	{
		R::selectDatabase('default');
		$query = R::getAll('SELECT f.id, f.fecha, (SELECT u.nombre_usuario FROM usuario AS u WHERE u.id=f.id_cliente) 
						   AS cliente, (SELECT c.porcentaje FROM comision AS c WHERE c.id=f.id_comision) AS comision, 
						   f.estado FROM factura AS f WHERE estado = ?', [$estado]);
		R::close();
		return $query;
	}	
}
	//$miFactura = new Venta();
	//$resul = $miFactura->getFacturasAprobadas("aprobado");
	//foreach ($resul as $key ) {
	//	echo $key['id'];
	//}
	//$miFactura->cancelarCompra(9);
	//$f = $miFactura->actualizarStock(5);
	//echo $f;
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