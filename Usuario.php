<?php
require_once __DIR__ . "/inc/Conexion.php";

class Usuario {

    private $conexion;

    public function __construct() {
        $this->conexion = (new Conexion())->conectar();
    }

    // ============================
    // CREATE
    // ============================
    public function crear($username, $password, $rol) {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO usuarios (username, password, rol)
                VALUES (?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("sss", $username, $passwordHash, $rol);

        return $stmt->execute();
    }

    // ============================
    // READ ALL
    // ============================
    public function obtenerTodos() {
        $sql = "SELECT id, username, rol, created_at FROM usuarios";
        $result = $this->conexion->query($sql);

        return $result;
    }

    // ============================
    // READ BY ID
    // ============================
    public function obtenerPorId($id) {
        $sql = "SELECT id, username, rol, created_at FROM usuarios WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // ============================
    // UPDATE
    // ============================
    public function actualizar($id, $username, $rol, $password = null) {

        if (!empty($password)) {
            // actualizar con nueva contraseña
            $passwordHash = password_hash($password, PASSWORD_BCRYPT);
            $sql = "UPDATE usuarios SET username=?, rol=?, password=? WHERE id=?";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("sssi", $username, $rol, $passwordHash, $id);
        } else {
            // actualizar sin contraseña
            $sql = "UPDATE usuarios SET username=?, rol=? WHERE id=?";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param("ssi", $username, $rol, $id);
        }

        return $stmt->execute();
    }

    // ============================
    // DELETE
    // ============================
    public function eliminar($id) {
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>

