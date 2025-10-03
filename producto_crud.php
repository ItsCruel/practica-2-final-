<?php
include("conexion.php");

$accion = isset($_GET['action']) ? $_GET['action'] : 'listar';

// Alta de producto
if ($accion == "alta" && $_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $sql = "INSERT INTO productos (nombre, descripcion, precio) VALUES ('$nombre','$descripcion','$precio')";
    $conexion->query($sql);
    header("Location: productos_crud.php");
    exit();
}

// Modificar producto
if ($accion == "modificar" && $_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $sql = "UPDATE productos SET nombre='$nombre', descripcion='$descripcion', precio='$precio' WHERE id=$id";
    $conexion->query($sql);
    header("Location: productos_crud.php");
    exit();
}

// Eliminar producto
if ($accion == "eliminar") {
    $id = $_GET['id'];
    $sql = "DELETE FROM productos WHERE id=$id";
    $conexion->query($sql);
    header("Location: productos_crud.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Productos ABCM</title>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/formularios.css">
</head>
<body>
<h1>Gestión de Productos</h1>

<?php if($accion=='listar'){ ?>
<a href="productos_crud.php?action=alta">➕ Agregar Producto</a>
<table border="1" cellpadding="10">
<tr><th>ID</th><th>Nombre</th><th>Descripción</th><th>Precio</th><th>Acciones</th></tr>
<?php
$res = $conexion->query("SELECT * FROM productos");
while($fila = $res->fetch_assoc()){
    echo "<tr>
    <td>{$fila['id']}</td>
    <td>{$fila['nombre']}</td>
    <td>{$fila['descripcion']}</td>
    <td>{$fila['precio']}</td>
    <td>
    <a href='productos_crud.php?action=modificar&id={$fila['id']}'>✏️ Modificar</a> |
    <a href='productos_crud.php?action=eliminar&id={$fila['id']}' onclick='return confirm(\"¿Eliminar?\")'>🗑️ Eliminar</a>
    </td>
    </tr>";
}
?>
</table>
<?php } elseif($accion=='alta'){ ?>
<h2>Agregar Producto</h2>
<form method="post" action="productos_crud.php?action=alta">
<label>Nombre:</label><input type="text" name="nombre" required><br>
<label>Descripción:</label><textarea name="descripcion" required></textarea><br>
<label>Precio:</label><input type="number" step="0.01" name="precio" required><br>
<input type="submit" value="Guardar">
</form>
<p><a href="productos_crud.php">⬅ Volver</a></p>
<?php } elseif($accion=='modificar'){
$id=$_GET['id'];
$res=$conexion->query("SELECT * FROM productos WHERE id=$id");
$prod=$res->fetch_assoc();
?>
<h2>Modificar Producto</h2>
<form method="post" action="productos_crud.php?action=modificar">
<input type="hidden" name="id" value="<?php echo $prod['id']; ?>">
<label>Nombre:</label><input type="text" name="nombre" value="<?php echo $prod['nombre']; ?>" required><br>
<label>Descripción:</label><textarea name="descripcion" required><?php echo $prod['descripcion']; ?></textarea><br>
<label>Precio:</label><input type="number" step="0.01" name="precio" value="<?php echo $prod['precio']; ?>" required><br>
<input type="submit" value="Actualizar">
</form>
<p><a href="productos_crud.php">⬅ Volver</a></p>
<?php } ?>
</body>
</html>