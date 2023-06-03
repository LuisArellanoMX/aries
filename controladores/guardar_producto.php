<?php
$cargaUtil = json_decode(file_get_contents("php://input"));
// Si no hay datos, salir inmediatamente indicando un error 500
if (!$cargaUtil) {
    // https://parzibyte.me/blog/2021/01/17/php-enviar-codigo-error-500/
    http_response_code(500);
    exit;
}

// Extraer valores
$nombre = $cargaUtil->nombre;
$precio = $cargaUtil->precio;
$descripcion = $cargaUtil->descripcion;
$foto = $cargaUtil->foto;
$tamanioFotoProd = $cargaUtil->tamanioFotoProd;
$extensionFotProd = $cargaUtil->extensionFotProd;
$nombreFotoProd = $cargaUtil->nombreFotoProd;
$material = $cargaUtil->idMat;

include_once "../persistencia/ProductoDao.php";
$respuesta = guardarProducto($nombre, $precio, $descripcion, $foto, $material, $tamanioFotoProd, $extensionFotProd, $nombreFotoProd);
// Devolver al cliente la respuesta de la función
echo json_encode($respuesta);