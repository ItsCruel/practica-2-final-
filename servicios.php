<?php
include("conexion.php");

$resultado = $conexion->query("SELECT * FROM servicios");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Lista de Servicios</title>
</head>
<body>
  <h1>Servicios</h1>
  <?php while($fila = $resultado->fetch_assoc()) { ?>
    <div style="margin-bottom:20px;">
      <h3><?php echo $fila['nombre']; ?></h3>
      <p><?php echo $fila['descripcion']; ?></p>
      <strong>Costo: $<?php echo $fila['costo']; ?></strong>
    </div>
  <?php } ?>
</body>
</html>
