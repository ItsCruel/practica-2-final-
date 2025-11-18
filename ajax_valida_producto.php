<?php
require_once "inc/Conexion.php";
require_once "Producto.php";

$cn = new Conexion();
$conexion = $cn->conectar();
$producto = new Producto($conexion);

$nombre = $_POST['nombre'];

echo $producto->existsByName($nombre) ? "existe" : "ok";
?>
