<?php
    include '../persistencia/pedidoDAO2.php';
    $pedidoDAO = new PedidoDAO();

    $idProducto = $_POST['idProducto'] ?? null;
    $nombre =  $_POST['nombre'] ?? null;
    $direccion =  $_POST['direccion'] ?? null;
    $telefono =  $_POST['telefono'] ?? null;


    try{
        $insertar = $pedidoDAO->registro($idProducto, $nombre, $direccion, $telefono);
        echo $insertar;
        header('location: ../index.php');
    }catch(Exception $exp){
        echo "Nel";
    }
?>