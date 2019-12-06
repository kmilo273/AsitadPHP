<?php
require_once 'models/user.php';

class UserController
{
  public function gestion()
  {
    $u = new User();
    $use = $u->findAll();
    $u2 = new User();
    $rol = $u2->findRol();
    if (isset($_GET['id'])) {
      $id = $_GET['id'];
      if ($id == '') {
        header('Location:' . baseUrl . 'error/index');
      }
      $u3 = new User();
      $u3->setId($id);
      $r = $u3->findId();
    }
    require_once 'views/usuario/crud.php';
  }
  public function index()
  {
    require_once 'views/index.php';
  }

  public function login()
  {
    require_once 'views/login.php';
  }

  public function pass()
  {
    require_once 'views/usuario/pass.php';
  }

  public function RPass()
  {
    if (isset($_POST) && !empty($_POST['correo'])) {
      $u = new User();
      $correo = $_POST['correo'];
      $u->setCorreo($correo);
      $data = $u->findId();
      if ($data && is_object($data)) {
        require_once 'lib/email/contra.php';
      } else {
        header('Location: ' . baseUrl . 'user/pass');
      }
    } else {
      $_SESSION['recuperar'] = 'Vacios';
      header('Location: ' . baseUrl . 'user/pass');
    }
  }
  public function visitasPro()
  {
    if (isset($_POST) && !empty($_POST['correo'] && $_POST['asunto'])) {
      $u = new User();
      $correo = $_POST['correo'];
      $asunto = $_POST['asunto'];
      $u->setAsunto($asunto);
      $u->setCorreo($correo);
      $data = $u->findId();
      if ($data && is_object($data)) {
        require_once 'lib/email/visi.php';
      } else {
        $_SESSION['noDa'] =
          header('Location:' . baseUrl . 'user/visit');
      }
    } else {
      $_SESSION['recuperar'] = 'Vacios';
      header('Location:' . baseUrl . 'user/visit');
    }
  }
  public function contacteno()
  {
    if (isset($_POST) && !empty($_POST['nombre'] && $_POST['correo'] && $_POST['telefono'] && $_POST['asunto'])) {
      $u = new User();
      $nombre = $_POST['nombre'];
      $correo = $_POST['correo'];
      $telefono = $_POST['telefono'];
      $asunto = $_POST['asunto'];
      $u->setNombre($nombre);
      $u->setCorreo($correo);
      $u->setTelefono($telefono);
      $u->setAsunto($asunto);
      require_once 'lib/email/contac.php';
    }
  }
  public function visit()
  {
    require_once 'views/visitas/envio.php';
  }

  public static function getAll()
  {
    $u = new User();
    $result = $u->findAll();
    return $result;
  }
  //consulta de practicantes
  public static function getPRact()
  {
    $u = new User();
    $resul = $u->getPracticante();
    return $resul;
  }
  //consulta de padrinos
  public static function getPadri()
  {
    $u = new User();
    $result = $u->getPadrino();
    return $result;
  }

  public function logear()
  {

    if (isset($_POST) && $_POST['correo'] && $_POST['contraseÃ±a']) {
      $correo = $_POST['correo'];
      $contraseÃ±a = $_POST['contraseÃ±a'];
      $u = new User();
      $u->setCorreo($correo);
      $userFind = $u->findId();
      if ($userFind) {
        if ($userFind->PASSWORD == $contraseÃ±a) {
          $_SESSION['userLog'] = $userFind;
          header('Location: ' . baseUrl . 'user/index');
        } else {
          $_SESSION['login'] = 'ContraPaila';
          header('Location: ' . baseUrl);
        }
      } else {
        $_SESSION['login'] = 'NoExiste';
        header('Location: ' . baseUrl);
      }
    } else {
      $_SESSION['login'] = 'vacios';
      header('Location: ' . baseUrl);
    }
  }
  public function lagout()
  {
    if (isset($_POST) && !empty($_POST['correo']) && !empty($_POST['contraseÃ±a'])) {
      $core = $_POST['correo'];
      $contraseÃ±a = $_POST['contraseÃ±a'];

      $usu = new User();
      $usu->setCorreo($core);
      $usu->setContraseÃ±a($contraseÃ±a);

      $identity = $usu->login();

      if ($identity == 'ErrorDatos') {
        $_SESSION['login'] = 'ErrorDatos';
        header('Location: ' . baseUrl);
      } elseif ($identity == 'Inactivo') {
        $_SESSION['login'] = 'Inactivo';
        header('Location: ' . baseUrl);
      } elseif ($identity && is_object($identity)) {
        $_SESSION['identity'] = $identity;
        header('Location: ' . baseUrl . 'user/index');
      } else {
        $_SESSION['login'] = 'ErrorPass';
        header('Location: ' . baseUrl);
      }
    } else {
      $_SESSION['login'] = 'Vacios';
      header('Location: ' . baseUrl);
    }
  }
  public function registrar()
  {
    // var_dump($_POST); die ();
    if (isset($_POST) && $_POST['nombre']  && $_POST['apellido'] && $_POST['correo'] && $_POST['contrasena'] && $_POST['rol']) {
      // Guardar los datos en variables
      $nombre = $_POST['nombre'];
      $apellido = $_POST['apellido'];
      $correo = $_POST['correo'];
      $contrasena = $_POST['contrasena'];
      $rol = $_POST['rol'];

      // Instanciar un Objecto User
      $u = new User();
      // Guardar los datos en el Objeto User
      $u->setNombre($nombre);
      $u->setApellido($apellido);
      $u->setCorreo($correo);
      $u->setContraseÃ±a($contrasena);
      $u->setRol($rol);
      // Ejecutar el metodo para registrar
      $r = $u->save();
      if ($r) {
        $_SESSION['registrado'] = true;
        header('Location: ' . baseUrl . 'user/gestion');
      }
    } else {
      echo 'no';
    }
  }

  public function logout()
  {
    if (isset($_SESSION['userLog'])) {
      $_SESSION['userLog'] = null;
      unset($_SESSION['userLog']);
    }
    header('Location: ' . baseUrl);
  }
  public function reLogear()
  {
    require_once 'views/lagout.php';
  }
  public function volverInicio()
  {
    require_once 'views/login.php';
  }
  public function eliminar()
  {

    if (isset($_GET['id']) && !$_GET['id'] == '') {
      $id = $_GET['id'];
      $u = new User();
      $u->setId($id);
      $r = $u->delete();
      if ($r) {
        $_SESSION['eliminado'] = true;
        header('Location: ' . baseUrl . 'user/gestion');
      } else {
        header('Location: ' . baseUrl . 'user/gestion');
      }
    }
  }
  public function corre()
  {

    if (isset($_POST) && !empty($_POST['id'])) {
      $e = new User();
      $dataU = $e->findId();
      if ($dataU && is_object($dataU)) {
        require_once 'lib/email/contra.php';
      } else {
        $_SESSION['correo'] = 'ErrorDatos';
        header('Location:' . baseUrl . 'evento/correos');
      }
    } else {
      $_SESSION['correos'] = 'Vacios';
      header('Location:' . baseUrl . 'evento/correos');
    }
  }
  // PDF USUARIOS
  public function pdf()
  {
    $u = new User();
    $dataUsers = $u->findUsers();
    $u2 = new User();
    $porcent = $u2->countUsers();
    require_once 'lib/pdf/usuarios/pdfUsuarios.php';
  }
  // INGLES
  public function lang()
  {
    if (isset($_GET['l']) && $_GET['l'] != '') {
      $l = $_GET['l'];
      if ($l == 'en') {
        $_SESSION['l'] = $l;
      } elseif ($l == 'es') {
        $_SESSION['l'] = langDefault;
      }
      header('Location: ' . baseUrl . 'user/index');
    } else {
      header('Location: ' . baseUrl . 'error/index');
    }
  }
  // Certificado
  public function cert()
  {
    require_once 'views/usuario/certificado.php';
  }

  public function certPDF()
  {
    if ($_POST['user'] == 'Elija...') {
      header('Location: ' . baseUrl . 'user/cert');
    } else {
      $u = new User();
      $u->setId($_POST['user']);
      $dataUser = $u->findUId();
      require_once 'lib/pdf/usuarios/certificado.php';
    }
  }
  public function actualizar()
  {
    if (isset($_POST) && $_POST['nombre'] && $_POST['apellido'] && $_POST['correo'] && $_POST['rol']) {
      $id = $_GET['id'];
      $nombre = $_POST['nombre'];
      $apellido = $_POST['apellido'];
      $correo = $_POST['correo'];
      $rol = $_POST['rol'];

      $u = new User();

      $u->setId($id);
      $u->setNombre($nombre);
      $u->setApellido($apellido);
      $u->setCorreo($correo);
      $u->setRol($rol);

      $r = $u->update();
      if ($r) {
        $_SESSION['actualizado'] = true;
        header('Location: ' . baseUrl . 'user/gestion');
      }
    } else {
      header('Location: ' . baseUrl . 'user/gestion');
    }
  }
}
