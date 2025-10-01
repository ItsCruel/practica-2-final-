<?php
$servidor = "localhost";
$usuario = "root"; 
$password = "";   
$base_datos = "muebleria";

// Crear la conexion
$conexion = new mysqli($servidor, $usuario, $password, $base_datos);

// Verificar conexion
if ($conexion->connect_error) {
    die("Error en la conexión: " . $conexion->connect_error);
}
?>
