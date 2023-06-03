<?php
include_once "../persistencia/MaterialDao.php";
$materiales = obtenerMateriales();
echo json_encode($materiales);