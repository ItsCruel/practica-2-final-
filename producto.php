<?php require_once "inc/Conexion.php"; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Productos AJAX</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="producto.js"></script>
</head>

<body>

<h1>Gestión de Productos (AJAX)</h1>

<div style="width:45%; float:left;">
    <h2>Listado</h2>
    <div id="tablaProductos"></div>
</div>

<div style="width:45%; float:right;">
    <h2>Formulario</h2>

    <form id="formProducto">

        <input type="hidden" id="id" name="id">

        <p>
            <label>Nombre:</label><br>
            <input type="text" id="nombre" name="nombre">
            <span id="mensajeNombre"></span>
        </p>

        <p>
            <label>Descripción:</label><br>
            <textarea id="descripcion" name="descripcion"></textarea>
        </p>

        <p>
            <label>Precio:</label><br>
            <input type="text" id="precio" name="precio">
        </p>

        <p>
            <input type="button" value="Guardar" onclick="guardarProducto();">
            <button type="button" onclick="limpiarFormulario()">Limpiar</button>
        </p>

    </form>

</div>

</body>
</html>
