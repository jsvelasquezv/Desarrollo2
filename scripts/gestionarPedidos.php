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

?>