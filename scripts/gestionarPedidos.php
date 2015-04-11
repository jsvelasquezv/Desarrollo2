<?php
require_once '../modelos/Venta.php';

$pedidos = new Venta();
session_start();
#userName del usuario que se encuentra logueado
$userUsuario = $_SESSION['user'];
$_SESSION['pedidosVendedor'] = $pedidos->obtenerPedidosVendedor($userUsuario);
?>