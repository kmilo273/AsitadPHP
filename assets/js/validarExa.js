console.log("Tome awa");
window.onload = iniciar;

function iniciar() {
  document.getElementById("Exacto").addEventListener("click", validar, false);
}

function validarFechaExa() {
  var elemento = document.getElementById("fecha");
  if (elemento.value == "" || !isNaN(elemento.value)) {
    alertico("Y la fecha?");
    return false;
  }
  return true;
}

function validarNombreExa() {
  var elemento = document.getElementById("nombre");
  if (elemento.value == "" || !isNaN(elemento.value)) {
    alertico("Y el nombre?");
    return false;
  }
  return true;
}

function validarDescripcionExa() {
  var elemento = document.getElementById("descripcion");
  if (elemento.value == "" || !isNaN(elemento.value)) {
    alertico("Y la descripcion?");
    return false;
  }
  return true;
}

function validarArchivoExa() {
  var elemento = document.getElementById("archivo");
  if (elemento.value == "") {
    alertico("Y el archivo?");
    return false;
  }
  return true;
}

function validar(x) {
  if (validarFechaExa() && 
      validarNombreExa() && 
      validarDescripcionExa()&&
      validarArchivoExa()) {
    return true;
  } else {
    x.preventDefault();
    return false;
  }
}

function alertico(mensaje) {
  alertify.error(mensaje);
}
