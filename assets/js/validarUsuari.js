console.log("Usuarios");
window.onload = iniciar;

function iniciar() {
    document.getElementById("user").addEventListener("click", validar, false);
}
function validarNombre() {
    var elemento = document.getElementById("nombre");
    if (elemento.value == "" || !isNaN(elemento.value)) {
        alertico("Y el Nombre?");
        return false;
    }
    return true;
}
function validarApellido() {
    var elemento = document.getElementById("apellido");
    if (elemento.value == "" || !isNaN(elemento.value)) {
        alertico("Y el Apellido?");
        return false;
    }
    return true;
}
function validarCorreo() {
    var elemento = document.getElementById("correo");
    if (elemento.value == "" || !isNaN(elemento.value)) {
        alertico("Y el Correo?");
        return false;
    }
    return true;
}
function validarContrasena() {
    var elemento = document.getElementById("contrasena");
    if (elemento.value == "" || !isNaN(elemento.value)) {
        alertico("Y el Contraseña?");
        return false;
    }
    return true;
}
function validarRol() {
    var elemento = document.getElementById("rol");
    if (elemento.value == "Elija..." || elemento.value == "Choose...") {
        alertico("Y el Rol?");
        return false;
    }
    return true;
}
function validar(u) {
    if (
        validarNombre() &&
        validarApellido() &&
        validarCorreo() &&
        validarContrasena()
    ) {
        return true;
    } else {
        u.preventDefault();
        return false;
    }
}

function alertico(mensaje) {
    alertify.error(mensaje);
}
