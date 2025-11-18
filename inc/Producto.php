<?php

class Producto {

    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function getAll() {
        return $this->conexion->query("SELECT * FROM producto ORDER BY id DESC");
    }

    public function getById($id) {
        $stmt = $this->conexion->prepare("SELECT * FROM producto WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function create($nombre, $descripcion, $precio) {
        $stmt = $this->conexion->prepare(
            "INSERT INTO producto (nombre, descripcion, precio) VALUES (?, ?, ?)"
        );
        $stmt->bind_param("ssd", $nombre, $descripcion, $precio);
        return $stmt->execute();
    }

    public function update($id, $nombre, $descripcion, $precio) {
        $stmt = $this->conexion->prepare(
            "UPDATE producto SET nombre = ?, descripcion = ?, precio = ? WHERE id = ?"
        );
        $stmt->bind_param("ssdi", $nombre, $descripcion, $precio, $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->conexion->prepare("DELETE FROM producto WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function existsByName($nombre) {
        $stmt = $this->conexion->prepare("SELECT id FROM producto WHERE nombre = ?");
        $stmt->bind_param("s", $nombre);
        $stmt->execute();
        return $stmt->get_result()->num_rows > 0;
    }
}
?>
