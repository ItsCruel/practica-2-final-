<?php
require_once __DIR__ . '/inc/Conexion.php';
$cn = new Conexion();
$conexion = $cn->conectar();

$resultado = $conexion->query("SELECT * FROM pedido ORDER BY fecha_entrega DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Listado de Pedidos</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1>Listado de Pedidos</h1>
<table border="1" cellpadding="8" cellspacing="0">
  <tr>
    <th>ID</th>
    <th>Producto</th>
    <th>Cantidad</th>
    <th>Fecha Entrega</th>
    <th>Comentarios</th>
  </tr>
  <?php while ($fila = $resultado->fetch_assoc()) { ?>
  <tr>
    <td><?= $fila['id'] ?></td>
    <td><?= htmlspecialchars($fila['producto']) ?></td>
    <td><?= htmlspecialchars($fila['cantidad']) ?></td>
    <td><?= htmlspecialchars($fila['fecha_entrega']) ?></td>
    <td><?= nl2br(htmlspecialchars($fila['comentarios'])) ?></td>
  </tr>
  <?php } ?>
</table>

<p><a href="dashboard.php">Volver al panel</a></p>

</body>
</html>
