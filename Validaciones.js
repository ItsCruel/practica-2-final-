// ===============================
// VALIDACIÓN PARA FORMULARIO DE CITA
// ===============================
function validarFormulario() {
    let valido = true;

    const nombre = document.getElementById("nombre");
    const correo = document.getElementById("correo");
    const telefono = document.getElementById("telefono");
    const fecha = document.getElementById("fecha");
    const hora = document.getElementById("hora");

    limpiarErrores(nombre, correo, telefono, fecha, hora);

    if (nombre.value.trim() === "") {
        mostrarError(nombre, "El nombre es obligatorio.");
        valido = false;
    }

    if (!validarCorreo(correo.value)) {
        mostrarError(correo, "Correo no válido.");
        valido = false;
    }

    if (!/^\d{10}$/.test(telefono.value)) {
        mostrarError(telefono, "El teléfono debe tener 10 números.");
        valido = false;
    }

    if (!/^\d{2}\/\d{2}\/\d{4}$/.test(fecha.value)) {
        mostrarError(fecha, "Formato de fecha inválido (dd/mm/aaaa).");
        valido = false;
    }

    if (!/^\d{2}:\d{2}$/.test(hora.value)) {
        mostrarError(hora, "Formato de hora inválido (hh:mm).");
        valido = false;
    }

    return valido;
}


// ===============================
// VALIDACIÓN CLIENTES
// ===============================
function validarCliente() {
    let valido = true;

    const nombre = document.getElementById("nombre_cliente");
    const direccion = document.getElementById("direccion");
    const correo = document.getElementById("correo_cliente");
    const telefono = document.getElementById("telefono_cliente");
    const tipo = document.getElementById("tipo");

    limpiarErrores(nombre, direccion, correo, telefono, tipo);

    if (nombre.value.trim() === "") {
        mostrarError(nombre, "El nombre es obligatorio.");
        valido = false;
    }

    if (direccion.value.trim() === "") {
        mostrarError(direccion, "La dirección es obligatoria.");
        valido = false;
    }

    if (!validarCorreo(correo.value)) {
        mostrarError(correo, "Correo no válido.");
        valido = false;
    }

    if (!/^\d{10}$/.test(telefono.value)) {
        mostrarError(telefono, "Teléfono inválido (10 dígitos).");
        valido = false;
    }

    if (tipo.value === "") {
        mostrarError(tipo, "Seleccione un tipo de cliente.");
        valido = false;
    }

    return valido;
}


// ===============================
// VALIDACIÓN PEDIDO
// ===============================
function validarPedido() {
    let valido = true;

    const producto = document.getElementById("producto");
    const cantidad = document.getElementById("cantidad");
    const fecha = document.getElementById("fecha_entrega");

    limpiarErrores(producto, cantidad, fecha);

    if (producto.value.trim() === "") {
        mostrarError(producto, "Debe ingresar un producto.");
        valido = false;
    }

    if (!/^\d+$/.test(cantidad.value) || cantidad.value <= 0) {
        mostrarError(cantidad, "Cantidad inválida (solo números y mayor a 0).");
        valido = false;
    }

    if (!/^\d{2}\/\d{2}\/\d{4}$/.test(fecha.value)) {
        mostrarError(fecha, "Formato de fecha inválido (dd/mm/aaaa).");
        valido = false;
    }

    return valido;
}


// ===============================
// VALIDACIÓN CONTACTO INTERNO
// ===============================
function validarContacto() {
    let valido = true;

    const nombre = document.getElementById("nombre_contacto");
    const correo = document.getElementById("correo_contacto");
    const asunto = document.getElementById("asunto");
    const mensaje = document.getElementById("mensaje_contacto");

    limpiarErrores(nombre, correo, asunto, mensaje);

    if (nombre.value.trim() === "") {
        mostrarError(nombre, "El nombre es obligatorio.");
        valido = false;
    }

    if (!validarCorreo(correo.value)) {
        mostrarError(correo, "Correo no válido.");
        valido = false;
    }

    if (asunto.value.trim() === "") {
        mostrarError(asunto, "Debe ingresar un asunto.");
        valido = false;
    }

    if (mensaje.value.trim() === "") {
        mostrarError(mensaje, "Debe ingresar un mensaje.");
        valido = false;
    }

    return valido;
}



// ======================================
// FUNCIONES GENERALES
// ======================================

// limpia los mensajes de error previos
function limpiarErrores(...campos) {
    campos.forEach(campo => {
        const divError = campo.nextElementSibling;
        if (divError && divError.classList.contains("error-msg")) {
            divError.textContent = "";
        }
    });
}

// muestra un error debajo del campo
function mostrarError(campo, mensaje) {
    const divError = campo.nextElementSibling;
    if (divError && divError.classList.contains("error-msg")) {
        divError.textContent = mensaje;
        divError.style.color = "red";
    }
}

// validar email con regex
function validarCorreo(correo) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(correo);
}
