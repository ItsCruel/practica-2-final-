<?php

require_once __DIR__ . "/Conexion.php";

class Login {

    private $conexion;

    public function __construct() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $this->conexion = (new Conexion())->conectar();
}


 public function iniciarSesion($username, $password) {

    $stmt = $this->conexion->prepare("SELECT id, username, password, rol FROM usuarios WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        if (password_verify($password, $usuario['password'])) {

            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario'] = $usuario['username'];
            $_SESSION['rol'] = $usuario['rol'];  // ← AQUÍ EL ROL

            return true;
        }
    }
    return false;
}


    public function protegerPagina() {
        if (!isset($_SESSION['usuario_id'])) {
            header("Location: login.php");
            exit;
        }
    }

    public function cerrarSesion() {
        session_destroy();
        header("Location: login.php");
        exit;
    }
}
