<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once __DIR__ . "/inc/Conexion.php";
require_once __DIR__ . "/inc/Producto.php";


$cn = new Conexion();
$conexion = $cn->conectar();
$producto = new Producto($conexion);

$action = $_REQUEST["action"] ?? "";

switch ($action) {

    // ========================================================
    // GUARDAR (Insertar o Modificar)
    // ========================================================
    case "guardar":

        $id = intval($_POST["id"]);
        $nombre = $_POST["nombre"];
        $descripcion = $_POST["descripcion"];
        $precio = floatval($_POST["precio"]);

        if ($id == 0) {
            $producto->create($nombre, $descripcion, $precio);
            echo "Producto agregado correctamente.";
        } else {
            $producto->update($id, $nombre, $descripcion, $precio);
            echo "Producto actualizado correctamente.";
        }
        break;


    // ========================================================
    // ELIMINAR
    // ========================================================
    case "eliminar":
        $id = intval($_POST["id"]);
        $producto->delete($id);
        echo "Producto eliminado.";
        break;


    // ========================================================
    // OBTENER (para EDITAR)
    // ========================================================
    case "obtener":
        $id = intval($_GET["id"]);
        echo json_encode($producto->getById($id));
        break;

    default:
        echo "Acción no válida.";
}
