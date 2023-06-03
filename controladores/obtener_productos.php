<?php
include_once "../persistencia/ProductoDao.php";
$productos = obtenerProductos();
echo json_encode($productos);