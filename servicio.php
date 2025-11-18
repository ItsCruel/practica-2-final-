<?php
require_once __DIR__ . "/inc/Conexion.php";

$cn = new Conexion();
$conexion = $cn->conectar();

$resultado = $conexion->query("SELECT * FROM servicio");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Lista de Servicios</title>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://itscruel.github.io/practica-2-final-/css/paginas.css" type="text/css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
<div id="header">
  <h1>Muebleria RobleClaro</h1>
  <p>Listado de servicios disponibles</p>
</div>

<div id="nav">
  <a href="index.html">Inicio</a> |
  <a href="cliente.php">Clientes</a> |
  <a href="producto.php">Productos</a> |
  <a href="servicio.php">Servicios</a>
</div>

<div class="servicio-section">
  <h1>Servicios</h1>
  <p><a href="servicio_crud.php">Administrar / CRUD</a></p>

  <?php if($resultado && $resultado->num_rows > 0) { ?>
    <?php while($fila = $resultado->fetch_assoc()) { ?>
      <section class="servicio-item">
        <h3><?php echo $fila['nombre']; ?></h3>
        <p><?php echo $fila['descripcion']; ?></p>
        <strong>Costo: $<?php echo number_format($fila['costo'], 2); ?></strong>
      </section>
    <?php } ?>
  <?php } else { ?>
    <p>No hay servicios disponibles.</p>
  <?php } ?>
</div>

<div id="footer">
  &copy; <span id="year"></span> Muebleria RobleClaro
  <br><br>
  <a href="https://validator.w3.org/check?uri=referer" target="_blank">
    <img src="https://www.w3.org/Icons/valid-html401" alt="Valid HTML" height="31" width="88">
  </a>
  <a href="https://jigsaw.w3.org/css-validator/check/referer" target="_blank">
    <img src="https://jigsaw.w3.org/css-validator/images/vcss" alt="Valid CSS" height="31" width="88">
  </a>
</div>

<script type="text/javascript">
  document.getElementById('year').innerHTML = new Date().getFullYear();

  $(document).ready(function() {
    $(".servicio-section").hide().fadeIn(800);

    $(".servicio-item").hover(
      function() { $(this).css("background-color", "#e8f5e9"); },
      function() { $(this).css("background-color", ""); }
    );

    $("h1").hover(
      function() { $(this).css("color", "#ff9800"); },
      function() { $(this).css("color", "#4CAF50"); }
    );
  });
</script>

</body>
</html>

