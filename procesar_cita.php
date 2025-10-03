<?php
// Validar que el formulario se haya enviado por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizar los datos (evita inyección de código)
    $nombre   = htmlspecialchars($_POST['nombre']);
    $correo   = htmlspecialchars($_POST['correo']);
    $telefono = htmlspecialchars($_POST['telefono']);
    $fecha    = htmlspecialchars($_POST['fecha']);
    $hora     = htmlspecialchars($_POST['hora']);
    $mensaje  = htmlspecialchars($_POST['mensaje']);
} else {
    // Si alguien entra directo al archivo sin usar el formulario
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
  <p>Gracias <strong><?php echo $nombre; ?></strong>, hemos recibido tu solicitud de cita.</p>

  <h2>Detalles de la cita:</h2>
  <ul>
    <li><strong>Correo:</strong> <?php echo $correo; ?></li>
    <li><strong>Teléfono:</strong> <?php echo $telefono; ?></li>
    <li><strong>Fecha:</strong> <?php echo $fecha; ?></li>
    <li><strong>Hora:</strong> <?php echo $hora; ?></li>
    <li><strong>Mensaje:</strong> <?php echo nl2br($mensaje); ?></li>
  </ul>

  <p><a href="index.html">Volver a inicio</a></p>
</body>
</html>
