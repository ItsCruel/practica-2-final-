<?php
require_once __DIR__ . '/inc/Conexion.php';

// Crear instancia de la clase
$cn = new Conexion();

// Obtener conexión mysqli
$conexion = $cn->conectar();



$resultado = $conexion->query("SELECT * FROM cliente");
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Lista de Clientes</title>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="https://itscruel.github.io/practica-2-final-/css/paginas.css" type="text/css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
<div id="header">
  <h1>Muebleria RobleClaro</h1>
  <p>Listado de clientes registrados</p>
</div>

<div id="nav">
  <a href="index.html">Inicio</a> |
  <a href="cliente.php">Clientes</a> |
  <a href="producto.php">Productos</a> |
  <a href="servicio.php">Servicios</a>
</div>

<div class="cliente-section">
  <h1>Clientes</h1>
  <p><a href="cliente_crud.php">Administrar / CRUD</a></p>

  <table class="tabla" border="1" cellpadding="10">
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Correo</th>
      <th>Telefono</th>
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

<!-- Script con efectos dinamicos -->
<script type="text/javascript">
  document.getElementById('year').innerHTML = new Date().getFullYear();

  $(document).ready(function() {
    // Animacion al cargar
    $(".cliente-section").hide().fadeIn(800);

    // Efecto hover en las filas de la tabla
    $(".tabla tr").hover(
      function() { $(this).css("background-color", "#e8f5e9"); },
      function() { $(this).css("background-color", ""); }
    );

    // Cambiar color del titulo al pasar el mouse
    $("h1").hover(
      function() { $(this).css("color", "#ff9800"); },
      function() { $(this).css("color", "#4CAF50"); }
    );
  });
</script>

</body>
</html>