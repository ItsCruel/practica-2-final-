<?php
require_once "inc/Conexion.php";

$cn = new Conexion();
$conexion = $cn->conectar();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre = $_POST["nombre_contacto"];
    $correo = $_POST["correo_contacto"];
    $asunto = $_POST["asunto"];
    $mensaje = $_POST["mensaje_contacto"];

    $stmt = $conexion->prepare(
        "INSERT INTO contacto (nombre, correo, asunto, mensaje)
        VALUES (?, ?, ?, ?)"
    );

    $stmt->bind_param("ssss", $nombre, $correo, $asunto, $mensaje);

    if ($stmt->execute()) {
        header("Location: dashboard.php?msg=contacto_ok");
        exit;
    } else {
        echo "Error al guardar contacto: " . $stmt->error;
    }

    $stmt->close();
}
?>
