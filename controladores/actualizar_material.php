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
$descripcion = $cargaUtil->descripcion;
$marca = $cargaUtil->marca;
$nom_prov = $cargaUtil->nom_prov;
$tel_prov = $cargaUtil->tel_prov;
$dir_prov = $cargaUtil->dir_prov;
$id_prov = $cargaUtil->id_prov;

include_once "../persistencia/MaterialDao.php";
$respuesta = actualizarMaterial($nom_prov, $marca, $tel_prov, $dir_prov, $nombre, $descripcion, $id, $id_prov);
// Devolver al cliente la respuesta de la función
echo json_encode($respuesta);