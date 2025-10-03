<?php
include("conexion.php");
$resultado = $conexion->query("SELECT * FROM producto");
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Lista de Productos</title>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://itscruel.github.io/practica-2-final-/css/paginas.css" type="text/css">

</head>
<body>
<div class="producto-section">
  <h1>Productos</h1>
  <p><a href="producto_crud.php">Administrar / CRUD</a></p>
  <?php while($fila = $resultado->fetch_assoc()) { ?>
    <div style="margin-bottom:20px;">
      <h3><?php echo $fila['nombre']; ?></h3>
      <p><?php echo $fila['descripcion']; ?></p>
      <strong>Precio: $<?php echo $fila['precio']; ?></strong>
    </div>
  <?php } ?>
</div>
</body>
</html>
