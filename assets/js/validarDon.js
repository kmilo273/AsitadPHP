console.log("Donacion");
window.onload = iniciar;

function iniciar() {
  document.getElementById("done").addEventListener("click", validar, false);
}

function validarValorDon() {
  var elemento = document.getElementById("valor");
  if (elemento.value <= 0) {
    alertico("Y el valor de la donacion?");
    return false;
  } else {
    if (elemento.value >= 100000000) {
      alertico("No puede ser, como?");
    return false;
    }
  }
  return true;
}

function validarFechaDon() {
  var elemento = document.getElementById("fecha");
  if (elemento.value == "" || !isNaN(elemento.value)) {
    alertico("Y la fecha?");
    return false;
  }
  return true;
}

function validarTipoDon() {
  var elemento = document.getElementById("tipo");
  if (elemento.value == "Elija..." || elemento.value == "Choose...") {
    alertico("Y el Tipo?");
    return false;
  }
  return true;
}

function validarTipoUsu() {
  var elemento = document.getElementById("usuario_idUsuario");
  if (elemento.value == "Elija..." || elemento.value == "Choose...") {
    alertico("Y el usuario?");
    return false;
  }
  return true;
}

function validarTipoAbu() {
  var elemento = document.getElementById("abuelito_idAbuelito");
  if (elemento.value == "Elija..." || elemento.value == "Choose...") {
    alertico("Y el abuelito?");
    return false;
  }
  return true;
}

function validarDescripcionDon() {
  var elemento = document.getElementById("descripcion");
  if (elemento.value == "" || !isNaN(elemento.value)) {
    alertico("Y la descripcion?");
    return false;
  }
  return true;
}

function validar(e) {
  if (
    validarValorDon() &&
    validarFechaDon() &&
    validarTipoDon() &&
    validarTipoUsu() &&
    validarTipoAbu() &&
    validarDescripcionDon() 
  ) {
    return true;
  } else {
    e.preventDefault();
    return false;
  }
}

function alertico(mensaje) {
  alertify.error(mensaje);
}
