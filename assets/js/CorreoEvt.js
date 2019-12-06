console.log("Correitos");
window.onload = iniciar;

function iniciar() {
  document.getElementById("meet").addEventListener("click", validar, false);
}

function validarNombreEvt() {
  var elemento = document.getElementById("asunto");
  if (elemento.value == "" || !isNaN(elemento.value)) {
    alertico("Y el Asunto?");
    return false;
  }
  return true;
}

function validarMensajeEvt() {
  var elemento = document.getElementById("mensaje");
  if (elemento.value == "" || !isNaN(elemento.value)) {
    alertico("Y el mensaje?");
    return false;
  }
  return true;
}



function validarArchivo() {
  var elemento = document.getElementById("archivo");
  if (elemento.value == "") {
    alertico("Y el archivo?");
    return false;
  }
  return true;
}


function validar(v) {
  if (
    validarNombreEvt() &&
    validarMensajeEvt() &&
    validarArchivo() 
  ) {
    return true;
  } else {
    v.preventDefault();
    return false;
  }
}

function alertico(mensaje) {
  alertify.error(mensaje);
}
