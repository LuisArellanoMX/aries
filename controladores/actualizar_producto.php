<?php
$cargaUtil = json_decode(file_get_contents("php://input"));
// Si no hay datos, salir inmediatamente indicando un error 500
if (!$cargaUtil) {
    http_response_code(500);
    exit;
}
// Extraer valores
$id = $cargaUtil->id;
$nombre = $cargaUtil->nombre;
$precio = $cargaUtil->precio;
$descripcion = $cargaUtil->descripcion;
$foto = $cargaUtil->foto;
$tamanioFotoProd = $cargaUtil->tamanioFotoProd;
$extensionFotProd = $cargaUtil->extensionFotProd;
$nombreFotoProd = $cargaUtil->nombreFotoProd;
$material = $cargaUtil->idMat;

include_once "../persistencia/ProductoDao.php";
$respuesta = actualizarProducto($nombre, $precio, $descripcion, $id, $foto, $tamanioFotoProd, $extensionFotProd, $nombreFotoProd, $material);
// Devolver al cliente la respuesta de la función
echo json_encode($respuesta);