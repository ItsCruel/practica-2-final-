<?php
require_once "inc/Conexion.php";
require_once __DIR__ . "/inc/Producto.php";

$cn = new Conexion();
$conexion = $cn->conectar();
$producto = new Producto($conexion);

$lista = $producto->getAll();

echo "<table border='1' cellpadding='8'>
<tr>
<th>ID</th>
<th>Nombre</th>
<th>Descripción</th>
<th>Precio</th>
<th>Acciones</th>
</tr>";

while ($fila = $lista->fetch_assoc()) {
    echo "<tr>
        <td>{$fila['id']}</td>
        <td>{$fila['nombre']}</td>
        <td>{$fila['descripcion']}</td>
        <td>{$fila['precio']}</td>
        <td>
            <button onclick='editarProducto({$fila['id']})'>Editar</button>
            <button onclick='eliminarProducto({$fila['id']})'>Eliminar</button>
        </td>
    </tr>";
}

echo "</table>";
?>
