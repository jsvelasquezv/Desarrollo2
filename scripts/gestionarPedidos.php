<?php
require_once '../modelos/Venta.php';
require_once '../modelos/Usuario.php';

$pedidos = new Venta();
$usuarioComprador = new Usuario();
session_start();
#userName del usuario que se encuentra logueado
$userUsuario = $_SESSION['user'];

$_SESSION['pedidosVendedor'] = $pedidos->obtenerPedidosVendedor($userUsuario);

$_SESSION['comprasCliente'] = $pedidos->obtenerComprasCliente($userUsuario);

$_SESSION['pendientes'] = $pedidos->getFacturasPendientes("pendiente");

if (isset($_SESSION['exitoComprar'])) {#Si esta seteada la vairable entonces...
	$exitoComprar = $_SESSION['exitoComprar'];
}
if (isset($_SESSION['exitoAprobar'])) {#Si está setada la variable de session entonces...
	$exitoAprobar = $_SESSION['exitoAprobar'];
}
if (isset($_SESSION['exitoCancelar'])) {#Si está setada la variable de session entonces...
	$exitoCancelar = $_SESSION['exitoCancelar'];
}
if (isset($_SESSION['exitoCambiarEstadoPedido'])) {#Si está setada la variable de session entonces...
	$exitoCambiarEstadoPedido = $_SESSION['exitoCambiarEstadoPedido'];
}
?>