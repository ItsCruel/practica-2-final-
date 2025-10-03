<?php
include("conexion.php");

$resultado = $conexion->query("SELECT * FROM productos");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Lista de Productos</title>
    <!-- CSS global para menú, header y footer -->
  <link rel="stylesheet" href="css/style.css">
  <!-- CSS específico para tablas, formularios y contenido -->
  <link rel="stylesheet" href="css/paginas.css">
</head>
<body>
  <h1>Productos</h1>
  <?php while($fila = $resultado->fetch_assoc()) { ?>
    <div style="margin-bottom:20px;">
      <h3><?php echo $fila['nombre']; ?></h3>
      <p><?php echo $fila['descripcion']; ?></p>
      <strong>Precio: $<?php echo $fila['precio']; ?></strong>
    </div>
  <?php } ?>
</body>
</html>
