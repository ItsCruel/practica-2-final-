<?php
require_once __DIR__ . '/inc/Conexion.php';
$cn = new Conexion();
$conexion = $cn->conectar();

$resultado = $conexion->query("SELECT * FROM contacto ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Listado de Contactos Internos</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1>Listado de Contactos Internos</h1>
<table border="1" cellpadding="8" cellspacing="0">
  <tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Correo</th>
    <th>Asunto</th>
    <th>Mensaje</th>
  </tr>
  <?php while ($fila = $resultado->fetch_assoc()) { ?>
  <tr>
    <td><?= $fila['id'] ?></td>
    <td><?= htmlspecialchars($fila['nombre']) ?></td>
    <td><?= htmlspecialchars($fila['correo']) ?></td>
    <td><?= htmlspecialchars($fila['asunto']) ?></td>
    <td><?= nl2br(htmlspecialchars($fila['mensaje'])) ?></td>
  </tr>
  <?php } ?>
</table>

<p><a href="dashboard.php">Volver al panel</a></p>

</body>
</html>
