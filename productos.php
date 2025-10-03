<?php
include("conexion.php");
$resultado = $conexion->query("SELECT * FROM productos");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Lista de Productos</title>
  <link rel="stylesheet" href="css/style.css">
 <link rel="stylesheet" href="https://raw.githubusercontent.com/ItsCruel/practica-2-final-/main/css/paginas.css" type="text/css">

</head>
<body>
  <h1>Productos</h1>

  <!-- Enlace al CRUD -->
  <p><a href="productos_crud.php">Administrar / CRUD</a></p>

  <?php while($fila = $resultado->fetch_assoc()) { ?>
    <div style="margin-bottom:20px;">
      <h3><?php echo $fila['nombre']; ?></h3>
      <p><?php echo $fila['descripcion']; ?></p>
      <strong>Precio: $<?php echo $fila['precio']; ?></strong>
    </div>
  <?php } ?>
</body>
</html>
