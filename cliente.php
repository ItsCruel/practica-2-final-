<?php
include("conexion.php");
$resultado = $conexion->query("SELECT * FROM clientes");
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Lista de Clientes</title>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/paginas.css">
</head>
<body>
<div class="cliente-section">
  <h1>Clientes</h1>
  <p><a href="cliente_crud.php">Administrar / CRUD</a></p>
  <table class="tabla" border="1" cellpadding="10">
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
</div>
</body>
</html>

