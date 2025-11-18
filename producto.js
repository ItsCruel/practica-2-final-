$(document).ready(function () {
    cargarTabla();

    $("#nombre").keyup(function () {
        validarNombre();
    });
});

function guardarProducto() {

    $.ajax({
        url: "producto_crud.php",
        type: "POST",
        data: {
            action: "guardar",
            id: $("#id").val(),
            nombre: $("#nombre").val(),
            descripcion: $("#descripcion").val(),
            precio: $("#precio").val()
        },
        success: function (resp) {
            alert(resp);
            cargarTabla();
            limpiarFormulario();
        }
    });
}

function eliminarProducto(id) {
    if (!confirm("¿Eliminar producto?")) return;

    $.ajax({
        url: "producto_crud.php",
        type: "POST",
        data: { action: "eliminar", id: id },
        success: function (resp) {
            alert(resp);
            cargarTabla();
        }
    });
}

function cargarTabla() {
    $("#tablaProductos").load("producto_tabla.php");
}

function editarProducto(id) {
    $.ajax({
        url: "producto_crud.php",
        type: "GET",
        data: { action: "obtener", id: id },
        dataType: "json",
        success: function (p) {
            $("#id").val(p.id);
            $("#nombre").val(p.nombre);
            $("#descripcion").val(p.descripcion);
            $("#precio").val(p.precio);
        }
    });
}

function validarNombre() {
    $.ajax({
        url: "ajax_valida_producto.php",
        type: "POST",
        data: { nombre: $("#nombre").val() },
        success: function (resp) {
            if (resp === "existe") {
                $("#mensajeNombre").html("⚠ Ya existe").css("color", "red");
            } else {
                $("#mensajeNombre").html("✔ Disponible").css("color", "green");
            }
        }
    });
}

function limpiarFormulario() {
    $("#id").val("");
    $("#nombre").val("");
    $("#descripcion").val("");
    $("#precio").val("");
    $("#mensajeNombre").html("");
}
