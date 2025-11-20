<?php
require_once "Usuario.php";

$usuarioClass = new Usuario();

$accion = isset($_GET['action']) ? $_GET['action'] : 'alta';
$id = isset($_GET['id']) ? intval($_GET['id']) : null;

$usuario = [
    "id"        => "",
    "username"  => "",
    "rol"       => "empleado",
];

// Si es edicion, obtener datos
if ($accion == "modificar" && $id) {
    $usuario = $usuarioClass->obtenerPorId($id);

    if (!$usuario) {
        die("Usuario no encontrado");
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title><?= ($accion == "alta") ? "Agregar Usuario" : "Modificar Usuario"; ?></title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<h1><?= ($accion == "alta") ? "Agregar Usuario" : "Modificar Usuario"; ?></h1>

<form method="post" action="usuarios_crud.php?action=<?= $accion ?>">

    <?php if ($accion == "modificar") { ?>
        <input type="hidden" name="id" value="<?= $usuario['id']; ?>">
    <?php } ?>

    <!-- USERNAME -->
    <label>Usuario (username):</label>
    <input type="text" name="username" required value="<?= htmlspecialchars($usuario['username']); ?>">
    <br><br>

    <!-- ROL -->
    <label>Rol:</label>
    <select name="rol" required>
        <option value="admin"     <?= ($usuario['rol']=="admin") ? "selected" : ""; ?>>Administrador</option>
        <option value="empleado"  <?= ($usuario['rol']=="empleado") ? "selected" : ""; ?>>Empleado</option>
        <option value="cliente"   <?= ($usuario['rol']=="cliente") ? "selected" : ""; ?>>Cliente</option>
    </select>
    <br><br>

    <!-- PASSWORD -->
    <label>Contraseña:</label>
    <input type="password" name="password">

    <?php if ($accion == "modificar") { ?>
        <small>(Déjalo vacío si NO deseas cambiar contraseña)</small>
    <?php } ?>

    <br><br>

    <input type="submit" value="<?= ($accion=="alta") ? "Guardar" : "Actualizar"; ?>">

</form>

<br>
<a href="usuarios_crud.php">⬅ Volver</a>

</body>
</html>
