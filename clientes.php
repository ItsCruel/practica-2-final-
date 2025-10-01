<?php
include("conexion.php");

$resultado = $conexion->query("SELECT * FROM clientes");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Lista de Clientes</title>
</head>
<body>
  <h1>Clientes</h1>
  <table border="1" cellpadding="10">
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Correo</th>
      <th>Teléfono</th>
    </tr>
    <?php while($fila = $resultado->fetch_assoc()) { ?>
    <tr>
      <td><?php echo $fila['id']; ?></td>
      <td><?php echo $fila['nombre']; ?></td>
      <td><?php echo $fila['correo']; ?></td>
      <td><?php echo $fila['telefono']; ?></td>
    </tr>
    <?php } ?>
  </table>
</body>
</html>
