<?php
if (!isset($_GET["id"])) {
    http_response_code(500);
    exit();
}
include_once "../persistencia/MaterialDao.php";
$material = obtenerMaterialPorId($_GET["id"]);
echo json_encode($material);