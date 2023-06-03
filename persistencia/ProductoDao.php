<?php

require_once('../services/FTPService.php');

function obtenerVariableDelEntorno($key)
{
    if (defined("_ENV_CACHE")) {
        $vars = _ENV_CACHE;
    } else {
        $file = "../env.php";
        if (!file_exists($file)) {
            throw new Exception("El archivo de las variables de entorno ($file) no existe. Favor de crearlo");
        }
        $vars = parse_ini_file($file);
        define("_ENV_CACHE", $vars);
    }
    if (isset($vars[$key])) {
        return $vars[$key];
    } else {
        throw new Exception("La clave especificada (" . $key . ") no existe en el archivo de las variables de entorno");
    }
}
function obtenerConexion()
{
    $password = obtenerVariableDelEntorno("MYSQL_PASSWORD");
    $user = obtenerVariableDelEntorno("MYSQL_USER");
    $dbName = obtenerVariableDelEntorno("MYSQL_DATABASE_NAME");
    $database = new PDO('mysql:host=localhost;dbname=' . $dbName, $user, $password);
    $database->query("set names utf8;");
    $database->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    return $database;
}

//------------------------------------------------------------------------------------------------------------
// Funciones Producto
function actualizarProducto($nombre, $precio, $descripcion, $id, $foto, $tamanioFotoProd, $extensionFotProd, $nombreFotoProd, $material)
{
    $bd = obtenerConexion();
    $serviceFTP = new FTPService();
    $ruta = '1/img/productos';
    $urlArch = $ruta . '/' . $nombreFotoProd . $extensionFotProd;
    $serviceFTP -> subirArchivo($foto, ($nombreFotoProd . $extensionFotProd), $ruta);
    $sentencia = $bd->prepare("UPDATE producto SET nombre_producto = ?, precio = ?, descripcion = ?, foto = ?, tamanio_foto=?, ext_foto=?, nombre_foto=?, idMaterial = ? WHERE idProducto = ?");
    return $sentencia->execute([$nombre, $precio, $descripcion, $urlArch, $tamanioFotoProd, $extensionFotProd, $nombreFotoProd, $material, $id]);
}

function obtenerProductoPorId($id)
{
    $bd = obtenerConexion();
    $sentencia = $bd->prepare("SELECT pr.idMaterial, pr.idProducto, pr.nombre_producto, pr.descripcion, pr.precio, pr.foto, mt.nombre_Material FROM producto AS pr INNER JOIN material AS mt ON pr.idMaterial = mt.idMaterial WHERE idProducto = ?");
    $sentencia->execute([$id]);
    return $sentencia->fetchObject();
}

function obtenerProductos()
{
    $bd = obtenerConexion();
    $sentencia = $bd->query("SELECT idProducto, nombre_producto, descripcion, precio, foto FROM producto");
    return $sentencia->fetchAll();
}

function eliminarProducto($id)
{
    $bd = obtenerConexion();
    $sentencia = $bd->prepare("DELETE FROM producto WHERE idProducto = ?");
    return $sentencia->execute([$id]);
}

function guardarProducto($nombre, $precio, $descripcion, $foto, $material, $tamanioFotoProd, $extensionFotProd, $nombreFotoProd){
    $bd = obtenerConexion();
    $serviceFTP = new FTPService();
    $ruta = '1/img/productos';
    $urlArch = $ruta . '/' . $nombreFotoProd . $extensionFotProd;

    $serviceFTP -> subirArchivo($foto, ($nombreFotoProd . $extensionFotProd), $ruta);

    $sentencia = $bd->prepare("INSERT INTO producto(idMaterial, nombre_producto, descripcion, foto, nombre_foto, tamanio_foto, ext_foto, precio, activo) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
    return $sentencia->execute([$material, $nombre, $descripcion, $urlArch, $nombreFotoProd, $tamanioFotoProd, $extensionFotProd, $precio, 1]);
}