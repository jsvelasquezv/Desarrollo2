<?php
require_once '../modelos/Venta.php';

if (isset($_GET['edit'])) {
	$idFactura = $_GET['edit'];
	$factura = new Venta();
	$facturaRegistro = $factura->getFactura($idFactura);
	header('Location: ../vistas/editarPedido.php?id_factura='.$facturaRegistro['id'].'&estado='
		.$facturaRegistro['estado']);
}

if(isset($_POST['guardar']))
{
	$facturita = $_POST['idFactura'];
	$nuevoEstado = $_POST['group1'];
	$actualizaEstado = new CoordinadorVenta();
	$actualizaEstado->cambiarEstado($facturita, $nuevoEstado);
	$actualizaEstado->actualizarCantidad($facturita);
}

if (isset($_GET['down'])) {
	$idfact = $_GET['down'];
	$fact = new CoordinadorVenta();
	$fact->cancelar($idfact);
}

Class CoordinadorVenta
{
	private $ventaModelo;

	/**
	 * [__construct description]
	 */
	function __construct()
	{
		$this->ventaModelo = new Venta();
	}

	/**
	 * [cambiarEstado description]
	 * @param  [type] $id     [description]
	 * @param  [type] $estado [description]
	 * @return [type]         [description]
	 */
	public function cambiarEstado($id, $estado)
	{
		$this->ventaModelo->setEstado($id, $estado);
		header('Location: ../vistas/visualizarPedido.php');
	}

	/**
	 * [actualizarCantidad description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function actualizarCantidad($id)
	{
		$this->ventaModelo->actualizarStock($id);
	}

	/**
	 * [cancelar description]
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function cancelar($id)
	{
		$this->ventaModelo->cancelarCompra($id);
		header('Location: ../vistas/estadoCompras.php');
	}
}

?>