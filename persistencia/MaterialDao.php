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
function obtenerMateriales()
{
    $bd = obtenerConexion();
    $sentencia = $bd->query("SELECT mt.idMaterial, mt.nombre_Material, mt.descripcion, pr.nombreContacto, pr.telefono FROM material AS mt INNER JOIN proveedor AS pr on mt.idProveedor = pr.idProveedor;");
    return $sentencia->fetchAll();
}

function guardarMaterial($nombre, $descripcion, $marca, $nom_prov, $tel_prov, $dir_prov)
{
    $bd = obtenerConexion();
    $sentencia1 = $bd->prepare("INSERT INTO proveedor(marca, nombreContacto, telefono, direccion, activo) VALUES(?, ?, ?, ?, ?)");
    $boolSentencia1 = $sentencia1->execute([$marca, $nom_prov, $tel_prov, $dir_prov, 1]);
    $idProveedor = obtener_ultimo_id();
    $sentencia2 = $bd->prepare("INSERT INTO material(idProveedor, nombre_material, descripcion, activo) VALUES(?, ?, ?, ?)");
    $boolSentencia2 = $sentencia2->execute([$idProveedor, $nombre, $descripcion, 1]);
    return $boolSentencia2 and $boolSentencia1;
}

function obtener_ultimo_id()
{
    $bd = obtenerConexion();
    $sentencia = $bd->query("SELECT MAX(idProveedor) AS id FROM proveedor;");
    $row =  $sentencia->fetch(PDO::FETCH_ASSOC);
    return $row['id'];
}

function actualizarMaterial($nom_prov, $marca, $tel_prov, $dir_prov, $nom_mat, $descripcion, $idMaterial, $idProveedor){
    $bd = obtenerConexion();
    $sentencia1 = $bd->prepare("UPDATE proveedor SET nombreContacto = ?, marca = ?, telefono = ?, direccion = ? WHERE idProveedor = ?");
    $boolSentencia1 = $sentencia1->execute([$nom_prov, $marca, $tel_prov, $dir_prov, $idProveedor]);
    $sentencia2 = $bd->prepare("UPDATE material SET nombre_Material = ?, descripcion = ? WHERE idMaterial = ?");
    $boolSentencia2 = $sentencia2->execute([$nom_mat, $descripcion, $idMaterial]);
    return $boolSentencia2 and $boolSentencia1;
}

function obtenerMaterialPorId($id){
    $bd = obtenerConexion();
    $sentencia = $bd->prepare("SELECT * FROM material as mat INNER JOIN proveedor AS pro on mat.idProveedor = pro.idProveedor WHERE mat.idMaterial = ?");
    $sentencia->execute([$id]);
    return $sentencia->fetchObject();
}
