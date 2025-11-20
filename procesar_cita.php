<?php
require_once "inc/Conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar a la base
    $cn = new Conexion();
    $conexion = $cn->conectar();

    // Sanear datos minimamente 
    $nombre   = htmlspecialchars(trim($_POST['nombre']));
    $correo   = htmlspecialchars(trim($_POST['correo']));
    $telefono = htmlspecialchars(trim($_POST['telefono']));
    $fecha    = htmlspecialchars(trim($_POST['fecha']));
    $hora     = htmlspecialchars(trim($_POST['hora']));
    $mensaje  = htmlspecialchars(trim($_POST['mensaje']));

    // Preparar y ejecutar INSERT
    $stmt = $conexion->prepare("INSERT INTO cita (nombre, correo, telefono, fecha, hora, mensaje) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $nombre, $correo, $telefono, $fecha, $hora, $mensaje);

    if ($stmt->execute()) {
        // Éxito, mostrar confirmación
        $stmt->close();
    } else {
        die("Error al guardar la cita: " . $stmt->error);
    }

} else {
    // No llego por POST, redirigir
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Cita registrada - Mueblería RobleClaro</title>
  <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
  <h1>Cita registrada</h1>
  <p>Gracias <strong><?= $nombre ?></strong>, hemos recibido tu solicitud de cita.</p>

  <h2>Detalles de la cita:</h2>
  <ul>
    <li><strong>Correo:</strong> <?= $correo ?></li>
    <li><strong>Teléfono:</strong> <?= $telefono ?></li>
    <li><strong>Fecha:</strong> <?= $fecha ?></li>
    <li><strong>Hora:</strong> <?= $hora ?></li>
    <li><strong>Mensaje:</strong> <?= nl2br($mensaje) ?></li>
  </ul>

  <p><a href="index.html">Volver a inicio</a></p>
</body>
</html>
