<?php
require_once 'models/actividad.php';

class ActividadController
{
  public function gestion()
  {
    // Instanciar un Objeto Actividad
    $ac = new Actividad();
    // Ejecutar el Metodo findAll
    $actividad = $ac->findAll();
    // Instanciar un Objeto Actividad para pedir los Tipos
    $ac2 = new Actividad();
    // Ejecutar el Metodo findAllTiposA
    $tipos = $ac2->findAllTipoA();
    // instancia objeto actividad abuelo
    $ac3 = new Actividad();
    //ejecutar medoto findallAbuelo
    $abuelo = $ac3->findAllAbuelito();
    //instancia obejto actividad usuarios
    $ac4 = new Actividad();
    //ejecutar metodo findAllUsuario
    $users = $ac4->findAllUsuario();
    $activi2 = new Actividad();
    $porcentaje = $activi2->countTipo();
    $activi3 = new Actividad();
    $usuariosActividad = $activi3->findUsariosActividad();
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      if ($id == '') {
        header('Location: ' . baseUrl . 'error/index');
      }
      $ac5 = new Actividad();
      $ac5->setId($id);
      $r = $ac5->findID();
    }
    require_once 'views/actividad/crud.php';
  }

  public function fromPrac()
  {
    // Instanciar un Objeto Actividad
    $ac = new Actividad();
    // Ejecutar el Metodo findAll
    $actividad = $ac->findAll();
    // Instanciar un Objeto Actividad para pedir los Tipos
    $ac2 = new Actividad();
    // Ejecutar el Metodo findAllTiposA
    $tipos = $ac2->findAllTipoA();
    // instancia objeto actividad abuelo
    $ac3 = new Actividad();
    //ejecutar medoto findallAbuelo
    $abuelo = $ac3->findAllAbuelito();
    //instancia obejto actividad usuarios
    $ac4 = new Actividad();
    //ejecutar metodo findAllUsuario
    $users = $ac4->findAllUsuario();
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      if ($id == '') {
        header('Location: ' . baseUrl . 'error/index');
      }
      $ac5 = new Actividad();
      $ac5->setId($id);
      $r = $ac5->findID();
    }
    require_once 'views/actividad/from.php';
  }
  public function pdf()
  {
    $a = new Actividad();
    $dataA = $a->findAll();
    require_once 'lib/pdf/actividad/pdf.php';
  }

  public function registrar()
  {

    if (isset($_POST)) {
      $nombreActividad = isset($_POST['nombreActividad']) ? $_POST['nombreActividad'] : false;
      $horaActividad = isset($_POST['horaActividad']) ? $_POST['horaActividad'] : false;
      $abuelito_idAbuelito = isset($_POST['abuelito_idAbuelito']) ? $_POST['abuelito_idAbuelito'] : false;
      $tipoActividad = isset($_POST['tipoActividad']) ? $_POST['tipoActividad'] : false;
      $fechaActividad = isset($_POST['fechaActividad']) ? $_POST['fechaActividad'] : false;
      if ($nombreActividad && $horaActividad && $abuelito_idAbuelito && $tipoActividad && $fechaActividad) {
        $acti = new Actividad();
        $acti->setNombreActividad($nombreActividad);
        $acti->setHoraActividad($horaActividad);
        $acti->setAbuelito_idAbuelito($abuelito_idAbuelito);
        $acti->setTipoActividad($tipoActividad);
        $acti->setFechaActividad($fechaActividad);

        if (isset($_FILES['imagen'])) {
          $file = $_FILES['imagen'];
          $filename = $file['name'];
          $mimetype = $file['type'];

          if ($mimetype == "image/jpg" || $mimetype == 'image/jpeg' || $mimetype == 'image/png') {

            if (!is_dir('uploads/img')) {
              mkdir('uploads/img', 0777, true);
            }

            $acti->setIamgen($filename);
            move_uploaded_file($file['tmp_name'], 'uploads/img/' . $filename);
          }
        }
        if (isset($_GET['id'])) {
          $id = $_GET['id'];
          $acti->setId($id);

          $save = $acti->update();
        } else {
          $save = $acti->save();
        }
        if ($save) {
          $_SESSION['registrado'] = true;
          header('Location: ' . baseUrl . 'actividad/gestion');
        }
      } else {
        header('Location: ' . baseUrl . 'actividad/gestion');
      }
    }
  }
  public function registrarPracti()
  {

    if (isset($_POST)) {
      $nombreActividad = isset($_POST['nombreActividad']) ? $_POST['nombreActividad'] : false;
      $horaActividad = isset($_POST['horaActividad']) ? $_POST['horaActividad'] : false;
      $abuelito_idAbuelito = isset($_POST['abuelito_idAbuelito']) ? $_POST['abuelito_idAbuelito'] : false;
      $tipoActividad = isset($_POST['tipoActividad']) ? $_POST['tipoActividad'] : false;
      $fechaActividad = isset($_POST['fechaActividad']) ? $_POST['fechaActividad'] : false;
      if ($nombreActividad && $horaActividad && $abuelito_idAbuelito && $tipoActividad && $fechaActividad) {
        $acti = new Actividad();
        $acti->setNombreActividad($nombreActividad);
        $acti->setHoraActividad($horaActividad);
        $acti->setAbuelito_idAbuelito($abuelito_idAbuelito);
        $acti->setTipoActividad($tipoActividad);
        $acti->setFechaActividad($fechaActividad);

        if (isset($_FILES['imagen'])) {
          $file = $_FILES['imagen'];
          $filename = $file['name'];
          $mimetype = $file['type'];

          if ($mimetype == "image/jpg" || $mimetype == 'image/jpeg' || $mimetype == 'image/png') {

            if (!is_dir('uploads/img')) {
              mkdir('uploads/img', 0777, true);
            }

            $acti->setIamgen($filename);
            move_uploaded_file($file['tmp_name'], 'uploads/img/' . $filename);
          }
        }
        if (isset($_GET['id'])) {
          $id = $_GET['id'];
          $acti->setId($id);

          $save = $acti->update();
        } else {
          $save = $acti->save();
        }
        if ($save) {
          $_SESSION['registrado'] = true;
          header('Location: ' . baseUrl . 'actividad/fromPra');
        }
      } else {
        header('Location: ' . baseUrl . 'actividad/fromPra');
      }
    }
  }

  public function actualizar()
  {
    //var_dump($_POST);die();
    if (isset($_POST) && $_POST['fecha'] && $_POST['nombre'] && $_POST['horaActividad'] && $_POST['abuelito_idAbuelito'] && $_POST['tipo']) {
      // Guardar los datos en variables
      $id = $_GET['id'];
      $fechaActividad = $_POST['fecha'];
      $nombreActividad = $_POST['nombre'];
      $horaActividad = $_POST['horaActividad'];
      $abuelito_idAbuelito = $_POST['abuelito_idAbuelito'];
      $tipo = $_POST['tipo'];

      $ac = new Actividad();
      $ac->setId($id);
      $ac->setNombreActividad($nombreActividad);
      $ac->setHoraActividad($horaActividad);
      $ac->setAbuelito_idAbuelito($abuelito_idAbuelito);
      $ac->setTipoActividad($tipo);
      $ac->setFechaActividad($fechaActividad);
      if (isset($_FILES['imagen'])) {
        $file = $_FILES['imagen'];
        $filename = $file['name'];
        $mimetype = $file['type'];

        if ($mimetype == "image/jpg" || $mimetype == 'image/jpeg' || $mimetype == 'image/png') {

          if (!is_dir('uploads/img')) {
            mkdir('uploads/img', 0777, true);
          }

          $ac->setIamgen($filename);
          move_uploaded_file($file['tmp_name'], 'uploads/img/' . $filename);
        }
      }
      if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $ac->setId($id);

        $save = $ac->update();
      }
      // Instanciar un Objecto Actividad

      if ($save) {
        $_SESSION['actualizado'] = true;
        header('Location: ' . baseUrl . 'actividad/gestion');
      }
    } else {
      header('Location: ' . baseUrl . 'actividad/gestion');
    }
  }
  public function eliminar()
  {
    if (isset($_GET['id']) && !$_GET['id'] == '') {
      $idActividad = $_GET['id'];
      $m = new Actividad();
      $m->setId($idActividad);
      $r = $m->delete();
      if ($r) {
        $_SESSION['eliminado'] = true;
        header('Location: ' . baseUrl . 'actividad/gestion');
      }
    } else {
      header('Location: ' . baseUrl . 'actividad/gestion');
    }
  }
  public static function GETALL()
  { {
      // Instanciar un Objeto Medicamento
      $a = new Actividad();
      // Ejecutar el Metodo findAll
      $actividad = $a->findAll();
      return $actividad;
    }
  }
  public function consultarTipo()
  {
    $activi = new Actividad();
    $ac = $activi->findAll();
    $activi2 = new Actividad();
    $porcentaje = $activi2->countTipo();
    require_once 'views/actividad/crud.php';
  }
}
