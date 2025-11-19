$(document).ready(function () {
    cargarTabla();

    $("#nombre").keyup(function () {
        validarNombre();
    });
});

function guardarProducto() {
    if (!nombreValido) {
        alert("El nombre del producto ya existe o no es válido.");
        return; // no continúa con la petición AJAX
    }

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
            nombreValido = false; // resetear para la próxima validación
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

let nombreValido = false;

function validarNombre() {
    $.ajax({
        url: "ajax_valida_producto.php",
        type: "POST",
        data: { nombre: $("#nombre").val() },
        success: function (resp) {
            if (resp === "existe") {
                $("#mensajeNombre").html("⚠ Ya existe").css("color", "red");
                nombreValido = false;
            } else {
                $("#mensajeNombre").html("✔ Disponible").css("color", "green");
                nombreValido = true;
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
