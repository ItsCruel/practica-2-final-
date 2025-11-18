<?php
require_once "inc/Conexion.php";

$cn = new Conexion();
$conexion = $cn->conectar();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $producto = $_POST["producto"];
    $cantidad = intval($_POST["cantidad"]);
    $fecha_entrega = $_POST["fecha_entrega"];
    $comentarios = $_POST["comentarios"];

    $stmt = $conexion->prepare(
        "INSERT INTO pedido (producto, cantidad, fecha_entrega, comentarios)
        VALUES (?, ?, ?, ?)"
    );

    $stmt->bind_param("siss", $producto, $cantidad, $fecha_entrega, $comentarios);

    if ($stmt->execute()) {
        header("Location: dashboard.php?msg=pedido_ok");
        exit;
    } else {
        echo "Error al guardar pedido: " . $stmt->error;
    }

    $stmt->close();
}
?>
