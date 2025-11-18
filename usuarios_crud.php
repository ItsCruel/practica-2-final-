<?php
session_start();
require_once "inc/Login.php";
require_once "Usuario.php";

$login = new Login();
$login->protegerPagina();

// Solo admin puede acceder
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    http_response_code(403);
    echo "Acceso denegado. Solo administradores.";
    exit;
}

$usuarioClass = new Usuario();

$action = $_GET['action'] ?? null;

// ====================
// ALTA
// ====================
if ($action === 'alta' && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $rol      = trim($_POST['rol'] ?? 'empleado');

    if ($username === '' || $password === '') {
        $_SESSION['msg'] = "Faltan datos obligatorios (username y contraseña).";
        header("Location: usuarios_crud.php");
        exit;
    }

    $ok = $usuarioClass->crear($username, $password, $rol);
    $_SESSION['msg'] = $ok ? "Usuario creado correctamente." : "Error al crear usuario.";
    header("Location: usuarios_crud.php");
    exit;
}

// ====================
// MODIFICAR
// ====================
if ($action === 'modificar' && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $id       = intval($_POST['id'] ?? 0);
    $username = trim($_POST['username'] ?? '');
    $rol      = trim($_POST['rol'] ?? 'empleado');
    $password = trim($_POST['password'] ?? '');

    if ($id <= 0 || $username === '') {
        $_SESSION['msg'] = "Faltan datos para modificar usuario.";
        header("Location: usuarios_crud.php");
        exit;
    }

    $passwordToUse = $password !== '' ? $password : null;

    $ok = $usuarioClass->actualizar($id, $username, $rol, $passwordToUse);
    $_SESSION['msg'] = $ok ? "Usuario actualizado correctamente." : "Error al actualizar usuario.";
    header("Location: usuarios_crud.php");
    exit;
}

// ====================
// ELIMINAR
// ====================
if ($action === 'eliminar' && isset($_GET['id'])) {

    $id = intval($_GET['id']);

    if ($id === intval($_SESSION['usuario_id'])) {
        $_SESSION['msg'] = "No puedes eliminar tu propia cuenta.";
        header("Location: usuarios_crud.php");
        exit;
    }

    $ok = $usuarioClass->eliminar($id);
    $_SESSION['msg'] = $ok ? "Usuario eliminado." : "Error al eliminar usuario.";
    header("Location: usuarios_crud.php");
    exit;
}

// ====================
// LISTAR
// ====================
$usuarios = $usuarioClass->obtenerTodos();
$msg = $_SESSION['msg'] ?? '';
unset($_SESSION['msg']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Administrar Usuarios</title>
<link rel="stylesheet" href="css/style.css">
<script>
function confirmarEliminar(id, username) {
    if (confirm('¿Eliminar al usuario "' + username + '"?')) {
        location.href = 'usuarios_crud.php?action=eliminar&id=' + id;
    }
}
</script>
</head>
<body>

<div class="form-container">
  <h1>Administrar Usuarios</h1>

  <?php if ($msg) echo "<p style='color:green;'>$msg</p>"; ?>

  <p>
    <a href="usuario_form.php?action=alta">➕ Agregar Usuario</a> |
    <a href="dashboard.php">⬅ Volver al Panel</a>
  </p>

  <?php if ($usuarios && $usuarios->num_rows > 0): ?>
  <table class="tabla" border="1" cellpadding="8" style="width:90%; margin:auto;">
    <thead>
      <tr>
        <th>ID</th>
        <th>Usuario</th>
        <th>Rol</th>
        <th>Fecha Registro</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($u = $usuarios->fetch_assoc()): ?>
      <tr>
        <td><?= $u['id'] ?></td>
        <td><?= htmlspecialchars($u['username']) ?></td>
        <td><?= htmlspecialchars($u['rol']) ?></td>
        <td><?= htmlspecialchars($u['created_at']) ?></td>
        <td>
          <a href="usuario_form.php?action=modificar&id=<?= $u['id'] ?>">✏️ Editar</a>
          |
          <a href="#" onclick="confirmarEliminar(<?= $u['id'] ?>, '<?= addslashes($u['username']) ?>')">🗑️ Eliminar</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
  <?php else: ?>
    <p>No hay usuarios registrados.</p>
  <?php endif; ?>

</div>
</body>
</html>
