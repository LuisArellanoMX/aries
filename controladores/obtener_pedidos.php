<?php
include_once "../persistencia/PedidoDao.php";
$pedidos = obtenerPedidos();
echo json_encode($pedidos);