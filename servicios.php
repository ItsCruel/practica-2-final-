<?php
include("conexion.php");
$resultado = $conexion->query("SELECT * FROM servicios");
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Lista de Servicios</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/paginas.css">
</head>
<body>
  <h1>Servicios</h1>
  <?php while($fila = $resultado->fetch_assoc()) { ?>
    <section>
      <h3><?php echo $fila['nombre']; ?></h3>
      <p><?php echo $fila['descripcion']; ?></p>
      <strong>Costo: $<?php echo $fila['costo']; ?></strong>
    </section>
  <?php } ?>
</body>
</html>
