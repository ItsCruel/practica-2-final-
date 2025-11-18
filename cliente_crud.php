<?php
require_once __DIR__ . '/inc/Conexion.php';
$cn = new Conexion();
$conexion = $cn->conectar(); // asumo mysqli

// Mensaje para mostrar en pantalla
$msg = "";

// =========================
//      GUARDAR / EDITAR
// =========================
if (isset($_POST["guardar"])) {
    // tomar valores y sanear mínimamente
    $id = isset($_POST["id"]) && $_POST["id"] !== '' ? intval($_POST["id"]) : null;
    $nombre = $conexion->real_escape_string(trim($_POST["nombre"]));
    $correo = $conexion->real_escape_string(trim($_POST["correo"]));
    $telefono = $conexion->real_escape_string(trim($_POST["telefono"]));

    if ($id === null) {
        // Insertar con prepared statement
        $stmt = $conexion->prepare("INSERT INTO cliente (nombre, correo, telefono) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nombre, $correo, $telefono);
        if ($stmt->execute()) {
            $stmt->close();
            header("Location: cliente_crud.php?msg=guardado");
            exit;
        } else {
            $msg = "Error al insertar: " . $stmt->error;
            $stmt->close();
        }
    } else {
        // Actualizar
        $stmt = $conexion->prepare("UPDATE cliente SET nombre = ?, correo = ?, telefono = ? WHERE id = ?");
        $stmt->bind_param("sssi", $nombre, $correo, $telefono, $id);
        if ($stmt->execute()) {
            $stmt->close();
            header("Location: cliente_crud.php?msg=actualizado");
            exit;
        } else {
            $msg = "Error al actualizar: " . $stmt->error;
            $stmt->close();
        }
    }
}

// =========================
//         ELIMINAR
// =========================
if (isset($_GET["eliminar"])) {
    $id = intval($_GET["eliminar"]);
    $stmt = $conexion->prepare("DELETE FROM cliente WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $stmt->close();
        header("Location: cliente_crud.php?msg=eliminado");
        exit;
    } else {
        $msg = "Error al eliminar: " . $stmt->error;
        $stmt->close();
    }
}

// =========================
//     EDITAR (cargar datos)
// =========================
$editar = null;
if (isset($_GET["editar"])) {
    $id = intval($_GET["editar"]);
    $stmt = $conexion->prepare("SELECT id, nombre, correo, telefono FROM cliente WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $res = $stmt->get_result();
        $editar = $res->fetch_assoc();
    }
    $stmt->close();
}

// mensajes por querystring (después del header redirect)
if (isset($_GET['msg'])) {
    switch ($_GET['msg']) {
        case 'guardado': $msg = "Cliente guardado correctamente."; break;
        case 'actualizado': $msg = "Cliente actualizado correctamente."; break;
        case 'eliminado': $msg = "Cliente eliminado correctamente."; break;
    }
}

// Obtener lista completa
$lista = $conexion->query("SELECT * FROM cliente ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>CRUD Cliente (simple)</title>
<link rel="stylesheet" href="css/style.css">
<style>
/* estilos muy simples para que se vea bien */
body{font-family: Arial, sans-serif; margin:20px;}
table{border-collapse:collapse; width:100%;}
table td, table th{border:1px solid #ddd; padding:8px;}
table th{background:#f2f2f2;}
.form-box{max-width:600px; margin-bottom:20px;}
.msg{padding:10px; margin-bottom:12px; border-radius:4px;}
.msg.success{background:#e8f5e9; color:#256029;}
.msg.error{background:#ffebee; color:#b71c1c;}
</style>
</head>
<body>

<h1>CRUD DE CLIENTES (simple)</h1>

<?php if ($msg): ?>
    <div class="msg <?= (strpos($msg, 'Error') === 0 ? 'error' : 'success') ?>">
        <?= htmlspecialchars($msg) ?>
    </div>
<?php endif; ?>

<div class="form-box">
    <form method="POST" action="cliente_crud.php">
        <input type="hidden" name="id" value="<?= isset($editar['id']) ? intval($editar['id']) : '' ?>">

        <label>Nombre:</label><br>
        <input type="text" name="nombre" required style="width:100%;"
            value="<?= isset($editar['nombre']) ? htmlspecialchars($editar['nombre']) : '' ?>"><br><br>

        <label>Correo:</label><br>
        <input type="email" name="correo" required style="width:100%;"
            value="<?= isset($editar['correo']) ? htmlspecialchars($editar['correo']) : '' ?>"><br><br>

        <label>Teléfono:</label><br>
        <input type="text" name="telefono" style="width:100%;"
            value="<?= isset($editar['telefono']) ? htmlspecialchars($editar['telefono']) : '' ?>"><br><br>

        <button type="submit" name="guardar"><?= isset($editar) ? 'Actualizar' : 'Guardar' ?></button>
        <a href="cliente_crud.php" style="margin-left:10px;">➕ Nuevo</a>
    </form>
</div>

<h2>Lista de clientes</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Teléfono</th>
        <th>Acciones</th>
    </tr>
    <?php if ($lista && $lista->num_rows > 0): ?>
        <?php while ($c = $lista->fetch_assoc()): ?>
            <tr>
                <td><?= intval($c['id']) ?></td>
                <td><?= htmlspecialchars($c['nombre']) ?></td>
                <td><?= htmlspecialchars($c['correo']) ?></td>
                <td><?= htmlspecialchars($c['telefono']) ?></td>
                <td>
                    <a href="cliente_crud.php?editar=<?= intval($c['id']) ?>">Editar</a> |
                    <a href="cliente_crud.php?eliminar=<?= intval($c['id']) ?>"
                       onclick="return confirm('¿Seguro que deseas eliminar este cliente?');">Eliminar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="5">No hay clientes.</td></tr>
    <?php endif; ?>
</table>

</body>
</html>
