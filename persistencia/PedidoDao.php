<?php
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
function obtenerPedidos()
{
    $bd = obtenerConexion();
    $sentencia = $bd->query("SELECT pd.idPedido, pr.nombre_producto, pd.nombre as cliente, pd.direccion FROM pedido AS pd INNER JOIN producto AS pr on pr.idProducto = pd.idProducto;");
    return $sentencia->fetchAll();
}

function obtenerPedidoPorId($id){
    $bd = obtenerConexion();
    $sentencia = $bd->prepare("SELECT ped.nombre, ped.direccion, ped.telefono, prod.nombre_producto, prod.descripcion, prod.precio, prod.foto FROM pedido AS ped INNER JOIN producto AS prod ON ped.idProducto = prod.idProducto WHERE idPedido = ?");
    $sentencia->execute([$id]);
    return $sentencia->fetchObject();
}