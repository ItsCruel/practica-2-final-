<?php
require_once "inc/Login.php";

$login = new Login();
$login->protegerPagina(); // protege el acceso
// Para mostrar nombre y rol en sesión
$usuarioNombre = $_SESSION['usuario'] ?? 'Invitado';
$usuarioRol = $_SESSION['rol'] ?? '';

?>
<!DOCTYPE HTML>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - Mueblería RobleClaro</title>

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://itscruel.github.io/practica-2-final-/css/paginas.css">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

  <!-- Header -->
  <div id="header">
    <h1>Panel de Administración</h1>
    <p>Bienvenido, <?= $_SESSION['usuario'] ?></p>
    <a href="logout.php">Cerrar sesión</a>
  </div>

  
 <!-- MENÚ PRINCIPAL -->
<div id="nav">
    <b>Gestión:</b>
    <a href="cliente.php">Clientes</a>
    <a href="producto.php">Productos</a>
    <a href="servicio.php">Servicios</a>
    <?php if ($usuarioRol === 'admin'): ?>
        <a href="usuarios_crud.php">Usuarios</a>
    <?php endif; ?>

    <br><br>

    <b>Registros:</b>
    <a href="#cita">Registrar cita</a>
    <a href="#cliente">Registrar cliente</a>
    <a href="#pedido">Registrar pedido</a>
    <a href="#contacto">Contacto interno</a>

    <br><br>

    <b>Consultas:</b>
    <a href="ver_citas.php">Ver Citas</a>
    <a href="ver_pedidos.php">Ver Pedidos</a>
    <a href="ver_contactos.php">Ver Contactos Internos</a>
</div>


<!-- FORMULARIO CITA -->
<div id="cita" class="form-container">
  <h2>Registrar una cita</h2>
  <form action="procesar_cita.php" method="post" onsubmit="return validarFormulario()">
    <label for="nombre_cita">Nombre completo:</label>
    <input type="text" id="nombre_cita" name="nombre">
    <div class="error-msg"></div>

    <label for="correo_cita">Correo:</label>
    <input type="text" id="correo_cita" name="correo">
    <div class="error-msg"></div>

    <label for="telefono_cita">Teléfono (10 dígitos):</label>
    <input type="text" id="telefono_cita" name="telefono" maxlength="10">
    <div class="error-msg"></div>

    <label for="fecha">Fecha (dd/mm/aaaa):</label>
    <input type="text" id="fecha" name="fecha">
    <div class="error-msg"></div>

    <label for="hora">Hora (hh:mm):</label>
    <input type="text" id="hora" name="hora">
    <div class="error-msg"></div>

    <label for="mensaje">Mensaje:</label>
    <textarea id="mensaje" name="mensaje"></textarea>

    <input type="submit" value="Enviar cita">
  </form>
</div>

<!-- FORMULARIO CLIENTE -->
<div id="cliente" class="form-container">
  <h2>Registro de Cliente</h2>
  <form action="cliente_crud.php" method="post" onsubmit="return validarCliente()">
    <label for="nombre_cliente">Nombre:</label>
    <input type="text" id="nombre_cliente" name="nombre" required>
    <div class="error-msg"></div>

    <label for="correo_cliente">Correo:</label>
    <input type="email" id="correo_cliente" name="correo" required>
    <div class="error-msg"></div>

    <label for="telefono_cliente">Teléfono:</label>
    <input type="text" id="telefono_cliente" name="telefono" maxlength="10">
    <div class="error-msg"></div>

    <input type="submit" name="guardar" value="Registrar cliente">
  </form>
</div>




  <!-- PEDIDO -->
  <div id="pedido" class="form-container">
    <h2>Realizar Pedido</h2>
    <form action="procesar_pedido.php" method="post" onsubmit="return validarPedido()">

      <label for="producto">Producto:</label>
      <input type="text" id="producto" name="producto">
      <div class="error-msg"></div>

      <label for="cantidad">Cantidad:</label>
      <input type="text" id="cantidad" name="cantidad">
      <div class="error-msg"></div>

      <label for="fecha_entrega">Fecha entrega:</label>
      <input type="text" id="fecha_entrega" name="fecha_entrega">
      <div class="error-msg"></div>

      <label for="comentarios">Comentarios:</label>
      <textarea id="comentarios" name="comentarios"></textarea>

      <input type="submit" value="Enviar pedido">
    </form>
  </div>

  <!-- CONTACTO -->
  <div id="contacto" class="form-container">
    <h2>Contacto Interno</h2>
    <form action="procesar_contacto.php" method="post" onsubmit="return validarContacto()">

      <label for="nombre_contacto">Nombre:</label>
      <input type="text" id="nombre_contacto" name="nombre_contacto">
      <div class="error-msg"></div>

      <label for="correo_contacto">Correo:</label>
      <input type="text" id="correo_contacto" name="correo_contacto">
      <div class="error-msg"></div>

      <label for="asunto">Asunto:</label>
      <input type="text" id="asunto" name="asunto">
      <div class="error-msg"></div>

      <label for="mensaje_contacto">Mensaje:</label>
      <textarea id="mensaje_contacto" name="mensaje_contacto"></textarea>
      <div class="error-msg"></div>

      <input type="submit" value="Enviar mensaje">
    </form>
  </div>

  <!-- VALIDACIONES (copiadas del index original) -->
  <script src="validaciones.js"></script>

</body>
</html>
