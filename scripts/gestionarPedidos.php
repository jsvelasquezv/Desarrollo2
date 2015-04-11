<?php
require_once '../modelos/Venta.php';

$pedidos = new Venta();
session_start();
#userName del usuario que se encuentra logueado
$userUsuario = $_SESSION['user'];
$_SESSION['pedidosVendedor'] = $pedidos->obtenerPedidosVendedor($userUsuario);

$_SESSION['comprasCliente'] = $pedidos->obtenerComprasCliente($userUsuario);

$_SESSION['aprobadas'] = $pedidos->getFacturasAprobadas("aprobado");
//foreach ($_SESSION['aprobadas'] as $key) {
//	echo $key['id'];
//	echo $key['fecha'];
//	echo $key['cliente'];
//	echo $key['comision'];
//	echo $key['estado'];
//}
?>