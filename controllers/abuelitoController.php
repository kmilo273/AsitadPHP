<?php
require_once 'models/abuelito.php';

class AbuelitoController
{
  public static function getAll()
  {
    $a = new Abuelito();
    $result = $a->findAll();
    return $result;
  }

  public function gestion()
  {
    // Instanciar un Objeto Abuelito
    $a = new Abuelito();
    // Ejecutar el Metodo findAll
    $abuelito = $a->findAll();
    $a2= new Abuelito();
    $examenes = $a2->findAllExamenes();

    if (isset($_GET['idAbuelito'])) {
      $id = $_GET['idAbuelito'];
      if ($id == '') {
        header('Location: ' . baseUrl . 'error/index');
      }
      $a3 = new Abuelito();
      $a3->setId($id);
      $r = $a3->findID();
    }
    require_once 'views/abuelito/crud.php';
  }
  //solo tabla de abuelitos
  public function abuelitoTable(){
     // Instanciar un Objeto Abuelito
     $a = new Abuelito();
     // Ejecutar el Metodo findAll
     $abuelito = $a->findAll();
     $a2= new Abuelito();
     $examenes = $a2->findAllExamenes();
   
     if (isset($_GET['idAbuelito'])) {
       $id = $_GET['idAbuelito'];
       if ($id == '') {
         header('Location: ' . baseUrl . 'error/index');
       }
       $a3 = new Abuelito();
       $a3->setId($id);
       $r = $a3->findID();
     }
    
    require_once 'views/abuelito/table.php';
  }
  public function registrar()
  {
    if (isset($_POST)) {
      $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
      $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : false;
      $fechaNacimiento = isset($_POST['fechaNacimiento']) ? $_POST['fechaNacimiento'] : false;
      $necesidades = isset($_POST['necesidades']) ? $_POST['necesidades'] : false;
      $examen = isset($_POST['examenesMedicos']) ? $_POST['examenesMedicos'] : false;
      $salud = isset($_POST['estadoSalud']) ? $_POST['estadoSalud'] : false;
      if ($nombre && $apellido && $fechaNacimiento && $necesidades && $examen && $salud) {
        $abu = new abuelito();
        $abu->setNombre($nombre);
        $abu->setApellido($apellido);
        $abu->setFechaNacimiento($fechaNacimiento);
        $abu->setNecesidades($necesidades);
        $abu->setExamenesMedico($examen);
        $abu->setEstadoSalud($salud);

        if(isset($_FILES['imagen'])){
					$file = $_FILES['imagen'];
					$filename = $file['name'];
					$mimetype = $file['type'];

					if($mimetype == "image/jpg" || $mimetype == 'image/jpeg' || $mimetype == 'image/png' ){

            if (!is_dir('uploads/img')) {
              mkdir('uploads/img', 0777, true);
            }

            $abu->setImagen($filename);
            move_uploaded_file($file['tmp_name'], 'uploads/img/' . $filename);
          }
        }
        if (isset($_GET['idAbuelito'])) {
          $id = $_GET['idAbuelito'];
          $abu->setId($id);

          $save = $abu->update();
        } else {
          $save = $abu->save();
        }
        if ($save) {
          $_SESSION['registrado'] = true;
          header('Location: ' . baseUrl . 'abuelito/gestion');
        }
      } else {
        header('Location: ' . baseUrl . 'abuelito/gestion');
      }
      
    }
  }


  public function editar()
  {
   // var_dump($_POST); die();
    if(isset($_POST) && $_POST['nombre'] &&$_POST['apellido']&& $_POST['fechaNacimiento'] && $_POST['necesidades'] && $_POST['examenesMedicos'] && $_POST['estadoSalud']){
      $id=$_GET['idAbuelito'];
      $nombre= $_POST['nombre'];
      $apellido= $_POST['apellido'];
      $fecha= $_POST['fechaNacimiento'];
      $necesidades= $_POST['necesidades'];
      $exame= $_POST['examenesMedicos'];
      $salud= $_POST['estadoSalud'];

      $ab= new Abuelito();
      $ab->setId($id);
      $ab->setNombre($nombre);
      $ab->setApellido($apellido);
      $ab->setFechaNacimiento($fecha);
      $ab->setNecesidades($necesidades);
      $ab->setExamenesMedico($exame);
      $ab->setEstadoSalud($salud);
      if (isset($_FILES['imagen'])) {
        $file = $_FILES['imagen'];
        $filename = $file['name'];
        $mimetype = $file['type'];

        if ($mimetype == "image/jpg" || $mimetype == 'image/jpeg' || $mimetype == 'image/png') {

          if (!is_dir('uploads/img')) {
            mkdir('uploads/img', 0777, true);
          }

          $ab->setIamgen($filename);
          move_uploaded_file($file['tmp_name'], 'uploads/img/' . $filename);
        }
      }
      if (isset($_GET['idAbuelito'])) {
        $id = $_GET['idAbuelito'];
        $ab->setId($id);

        $up = $ab->update();
      }
      // Instanciar un Objecto Actividad

      if ($up) {
        $_SESSION['actualizado'] = true;
        header('Location: ' . baseUrl . 'abuelito/gestion');
      }
    } else {
      header('Location: ' . baseUrl . 'abuelito/gestion');
    }
  }

  public function actualizar()
  {
    if(isset($_GET['idAbuelito']) && !$_GET['idAbuelito']== ''){
      $id= $_GET['idAbuelito'];
      $ab= new Abuelito();
      $ab->setId($id);
      $es = $ab->findID();
      $status= $es->estadoAB;
      if($status=='Activo'){
        $ab->setEstado('Inactivo');
      }else{
        $ab->setEstado('Activo');
      }
      $r= $ab->delete();
      if($r){
        $_SESSION['estado'] = 'Cambiado';
        header('Location: ' . baseUrl . 'abuelito/gestion');
      }else{
        $_SESSION['estado'] = 'Error';
        header('Location: ' . baseUrl . 'abuelito/gestion');
      }
    }
  }
}
