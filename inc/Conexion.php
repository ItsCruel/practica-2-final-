<?php
class Conexion {

    private $servidor = "localhost";
    private $usuario  = "root";
    private $password = "";
    private $base_datos = "muebleria";

    public function conectar() {
        $conexion = new mysqli(
            $this->servidor,
            $this->usuario,
            $this->password,
            $this->base_datos
        );

        if ($conexion->connect_error) {
            die("Error en la conexión: " . $conexion->connect_error);
        }

        return $conexion;
    }
}
?>

