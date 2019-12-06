console.log("xd");
window.onload= iniciar;

function iniciar(){
    document.getElementById("send2").addEventListener("click", validar, false);
}
function validarFechaAct() {
    var elemento = document.getElementById("fechaActividad");
    if (elemento.value == "" || !isNaN(elemento.value)) {
      alertico("Y la fecha?");
      return false;
    }
    return true;
  }
  
  function validarNombreAct() {
    var elemento = document.getElementById("nombreActividad");
    if (elemento.value == "" || !isNaN(elemento.value)) {
      alertico("Y el nombre de la actividad?");
      return false;
    }
    return true;
  }
  function validarHora() {
    var elemento = document.getElementById("horaActividad");
    if (elemento.value <= 0 || (elemento.value)>= 8) {
      alertico("y la hora?");
      return false;
    }
    return true;
  }

  function validarTipoAct() {
    var elemento = document.getElementById("tipoActividad");
    if (elemento.value == "Elija..." || elemento.value == "Choose...") {
      alertico("Y el tipo de la Actividad?");
      return false;
    }
    return true;
  }
  function validarImagen() {
    var elemento = document.getElementById("imagen");
    if (elemento.value == "" || !isNaN(elemento.value)) {
      alertico("Y la imagen de la actividad?");
      return false;
    }
    return true;
  }
  function validarAbuelito() {
    var elemento = document.getElementById("abuelito_idAbuelito");
    if (elemento.value == "Elija..." || elemento.value == "Choose...") {
      alertico("Y el abuelito?");
      return false;
    }
    return true;
  }

  function validar(p) {
    if (
      validarFechaAct() &&
      validarNombreAct() &&
      validarHora() &&
      validarTipoAct() &&
      validarImagen() &&
      validarAbuelito()
    ) {
      return true;
    } else {
      p.preventDefault();
      return false;
    }
  }
  
  function alertico(mensaje) {
    alertify.error(mensaje);
  }
