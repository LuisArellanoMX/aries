<?php
if (!isset($_GET["id"])) {
    http_response_code(500);
    exit();
}
include_once "../persistencia/PedidoDao.php";
$pedido = obtenerPedidoPorId($_GET["id"]);
echo json_encode($pedido);