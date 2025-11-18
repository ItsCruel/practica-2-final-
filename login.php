<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);


require_once __DIR__ . "/inc/Conexion.php";
require_once __DIR__ . "/inc/Login.php";

$login = new Login();
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($login->iniciarSesion($username, $password)) {
        header("Location: dashboard.php");
        exit;
    } else {
        $mensaje = "Usuario o contraseña incorrectos";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
</head>
<body>
    <h2>Login</h2>

    <form method="POST">
        Usuario:
        <input type="text" name="username" required><br><br>

        Contraseña:
        <input type="password" name="password" required><br><br>

        <button type="submit">Entrar</button>
    </form>

    <p style="color:red;"><?= $mensaje ?></p>
</body>
</html>
