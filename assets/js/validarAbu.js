console.log("dX");
window.onload = iniciar;

function iniciar() {
  document.getElementById("send3").addEventListener("click", validar, false);
}

function validarNombreAbu() {
  var elemento = document.getElementById("nombre");
  if (elemento.value == "" || !isNaN(elemento.value)) {
    alertico("Y el Nombre?");
    return false;
  }
  return true;
}

function validarApellidoAbu() {
  var elemento = document.getElementById("apellido");
  if (elemento.value == "" || !isNaN(elemento.value)) {
    alertico("Y el Apellido?");
    return false;
  }
  return true;
}

function validarFechaAbu() {
    var elemento = document.getElementById("fechaNacimiento");
    if (elemento.value == "" || !isNaN(elemento.value)) {
      alertico("Y la fecha de Nacimiento?");
      return false;
    }
    return true;
  }


function validarNecesidadAbu() {
  var elemento = document.getElementById("necesidades");
  if (elemento.value == "Elija..." || elemento.value == "Choose...") {
    alertico("Y la necesidad?");
    return false;
  }
  return true;
}

function validarExamenesAbu() {
  var elemento = document.getElementById("examenesMedicos");
  if (elemento.value == "Elija..." || elemento.value == "Choose...") {
    alertico("Y los examenes?");
    return false;
  }
  return true;
}

function validarEstadoAbu() {
  var elemento = document.getElementById("estadoSalud");
  if (elemento.value == "Elija..." || elemento.value == "Choose...") {
    alertico("Y el estado de Salud?");
    return false;
  }
  return true;
}




function validar(a) {
  if (
    validarNombreAbu() &&
    validarApellidoAbu() &&
    validarFechaAbu() &&
    validarNecesidadAbu()&&
    validarExamenesAbu() &&
    validarEstadoAbu()
  ) {
    return true;
  } else {
    a.preventDefault();
    return false;
  }
}

function alertico(mensaje) {
  alertify.error(mensaje);
}
