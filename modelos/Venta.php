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
	public function crearFactura($cliente, $comision, $total)
	{
		R::selectDatabase('default');
		$facturaBean = R::dispense('factura');
		$facturaBean->id_cliente = $cliente;
		$facturaBean->id_comision = $comision;
		$facturaBean->total = $total;
		R::store($facturaBean);
        R::close();
	}


	public function guardarDetalleFactura($producto, $cantidad, $idFactura)
	{
		R::selectDatabase('default');
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


	public function getUltimaFactura()
	{
		R::selectDatabase('default');
		$facturaActual = R::getCell( 'SELECT id FROM factura ORDER BY id DESC LIMIT 1' );
		R::close();
        return $facturaActual;	
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
		$producto = R::getAll('SELECT id_producto, cantidad FROM detalle WHERE id_factura = ?', [$idFactura]);
		foreach ($producto as $productoDetalle) {
			$cantidadPedida = $productoDetalle['cantidad'];
			$id = $productoDetalle['id_producto'];
			$cantidadProducto = R::getCell('SELECT cantidad FROM producto WHERE id = ?', [$id]);

			$actualizacion = R::load('producto', $id);
			$actualizacion->cantidad = $cantidadProducto-$cantidadPedida;
			R::store($actualizacion);			
		}
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
	public function cancelarCompra($idFactura, $idProducto)
	{
		R::selectDatabase('default');
		$detalles = R::findAll('detalle', 'id_factura = ?', [$idFactura]);// se obtienen cuantos detalles estan relacionados con la factura
		if (count($detalles) == 1) {
			$factura = R::findOne('factura', 'id = ?',[$idFactura]);// Se elimina una factura en la que se tiene un producto
			R::trash($factura);
		}
		else{
			$elDetalle = R::findOne('detalle', 'id_producto = ? AND id_factura = ?', [$idProducto, $idFactura]);// Se elimina un producto de una factura
			$elProducto = R::findOne('producto', 'id = ?', [$idProducto]);
			$cantidad = $elDetalle['cantidad']; //cantidad comprada del producto que se desea cancelar
			$valor = $elProducto['valor_unitario']; //valor del producto a eliminar

			$actualizarTotalFactura = R::load('factura', $idFactura); //se actualiza el total al eliminar un producto presente en ella
			$totalFactura = $actualizarTotalFactura['total'];
			$actualizarTotalFactura->total = $totalFactura - ($valor*$cantidad);
			R::store($actualizarTotalFactura);
			R::trash($elDetalle);
		}		
		R::close();
	}

	/**
	 * [getFacturasAprobados description]
	 * @return [type] [description]
	 */
	public function getFacturasPendientes($estado)//Retorna las faturas que deben ser aprobadas por el admin
	{
		R::selectDatabase('default');
		$query = R::getAll('SELECT f.id, f.fecha, (SELECT u.nombre_usuario FROM usuario AS u WHERE u.id=f.id_cliente) 
						   AS cliente, (SELECT c.porcentaje FROM comision AS c WHERE c.id=f.id_comision) AS comision, 
						   f.total FROM factura AS f WHERE estado = ?', [$estado]);
		R::close();
		return $query;
	}	
}
	//$miFactura = new Venta();
	//$id = $miFactura->getUltimaFactura();
	//echo $id;
	//$resul = $miFactura->getFacturasAprobadas("aprobado");
	//foreach ($resul as $key ) {
	//	echo $key['id'];
	//}
	//$miFactura->cancelarCompra(10);
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