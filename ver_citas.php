<?php
require_once __DIR__ . '/inc/Conexion.php';
$cn = new Conexion();
$conexion = $cn->conectar();

$resultado = $conexion->query("SELECT * FROM cita ORDER BY fecha DESC, hora DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Listado de Citas</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1>Listado de Citas</h1>
<table border="1" cellpadding="8" cellspacing="0">
  <tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Correo</th>
    <th>Teléfono</th>
    <th>Fecha</th>
    <th>Hora</th>
    <th>Mensaje</th>
  </tr>
  <?php while ($fila = $resultado->fetch_assoc()) { ?>
  <tr>
    <td><?= $fila['id'] ?></td>
    <td><?= htmlspecialchars($fila['nombre']) ?></td>
    <td><?= htmlspecialchars($fila['correo']) ?></td>
    <td><?= htmlspecialchars($fila['telefono']) ?></td>
    <td><?= htmlspecialchars($fila['fecha']) ?></td>
    <td><?= htmlspecialchars($fila['hora']) ?></td>
    <td><?= nl2br(htmlspecialchars($fila['mensaje'])) ?></td>
  </tr>
  <?php } ?>
</table>

<p><a href="dashboard.php">Volver al panel</a></p>

</body>
</html>
