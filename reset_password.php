<?php
require_once "inc/Conexion.php";

$conexion = (new Conexion())->conectar();

$nuevo_password = "admin21";  // ← nueva contraseña
$hash = password_hash($nuevo_password, PASSWORD_BCRYPT);

$stmt = $conexion->prepare("UPDATE usuarios SET password = ? WHERE username = 'admin'");
$stmt->bind_param("s", $hash);

if ($stmt->execute()) {
    echo "Contraseña actualizada correctamente. Nueva contraseña = admin21";
} else {
    echo "Error: " . $stmt->error;
}
