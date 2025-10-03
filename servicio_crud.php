<?php
include("conexion.php");

$accion = isset($_GET['action']) ? $_GET['action'] : 'listar';

if ($accion == "alta" && $_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $costo = $_POST['costo'];
    $sql = "INSERT INTO servicios (nombre, descripcion, costo) VALUES ('$nombre','$descripcion','$costo')";
    $conexion->query($sql);
    header("Location: servicios_crud.php");
    exit();
}

if ($accion == "modificar" && $_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $costo = $_POST['costo'];
    $sql = "UPDATE servicios SET nombre='$nombre', descripcion='$descripcion', costo='$costo' WHERE id=$id";
    $conexion->query($sql);
    header("Location: servicios_crud.php");
    exit();
}

if ($accion == "eliminar") {
    $id = $_GET['id'];
    $sql = "DELETE FROM servicios WHERE id=$id";
    $conexion->query($sql);
    header("Location: servicios_crud.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Servicios ABCM</title>
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/formularios.css">
</head>
<body>
<h1>Gestión de Servicios</h1>

<?php if($accion=='listar'){ ?>
<a href="servicios_crud.php?action=alta">➕ Agregar Servicio</a>
<table border="1" cellpadding="10">
<tr><th>ID</th><th>Nombre</th><th>Descripción</th><th>Costo</th><th>Acciones</th></tr>
<?php
$res = $conexion->query("SELECT * FROM servicios");
while($fila = $res->fetch_assoc()){
    echo "<tr>
    <td>{$fila['id']}</td>
    <td>{$fila['nombre']}</td>
    <td>{$fila['descripcion']}</td>
    <td>{$fila['costo']}</td>
    <td>
    <a href='servicios_crud.php?action=modificar&id={$fila['id']}'>✏️ Modificar</a> |
    <a href='servicios_crud.php?action=eliminar&id={$fila['id']}' onclick='return confirm(\"¿Eliminar?\")'>🗑️ Eliminar</a>
    </td>
    </tr>";
}
?>
</table>
<?php } elseif($accion=='alta'){ ?>
<h2>Agregar Servicio</h2>
<form method="post" action="servicios_crud.php?action=alta">
<label>Nombre:</label><input type="text" name="nombre" required><br>
<label>Descripción:</label><textarea name="descripcion" required></textarea><br>
<label>Costo:</label><input type="number" step="0.01" name="costo" required><br>
<input type="submit" value="Guardar">
</form>
<p><a href="servicios_crud.php">⬅ Volver</a></p>
<?php } elseif($accion=='modificar'){
$id=$_GET['id'];
$res=$conexion->query("SELECT * FROM servicios WHERE id=$id");
$serv=$res->fetch_assoc();
?>
<h2>Modificar Servicio</h2>
<form method="post" action="servicios_crud.php?action=modificar">
<input type="hidden" name="id" value="<?php echo $serv['id']; ?>">
<label>Nombre:</label><input type="text" name="nombre" value="<?php echo $serv['nombre']; ?>" required><br>
<label>Descripción:</label><textarea name="descripcion" required><?php echo $serv['descripcion']; ?></textarea><br>
<label>Costo:</label><input type="number" step="0.01" name="costo" value="<?php echo $serv['costo']; ?>" required><br>
<input type="submit" value="Actualizar">
</form>
<p><a href="servicios_crud.php">⬅ Volver</a></p>
<?php } ?>
</body>
</html>