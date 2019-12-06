<?php

class User
{
  private $db;
  private $id;
  private $nombre;
  private $apellido;
  private $correo;
  private $contraseÃ±a;
  private $rol;
  private $estado;
  //envio de correos
  private $asunto;
  private $telefono;
  private $mensaje;
  //fin de variables de correo
  public function __construct()
  {
    $this->db = DataBase::conectar();
  }
  //
  function getId()
  {
    return $this->id;
  }

  function setId($id)
  {
    $this->id = $id;
  }
  //
  function getNombre()
  {
    return $this->nombre;
  }

  function setNombre($nombre)
  {
    $this->nombre = $this->db->real_escape_string($nombre);
  }
  //
  function getApellido()
  {
    return $this->apellido;
  }

  function setApellido($apellido)
  {
    $this->apellido = $this->db->real_escape_string($apellido);
  }
  //
  function getCorreo()
  {
    return $this->correo;
  }

  function setCorreo($correo)
  {
    $this->correo = $this->db->real_escape_string($correo);
  }
  //
  function getContraseÃ±a()
  {
    return $this->contraseÃ±a;
  }

  function setContraseÃ±a($contraseÃ±a)
  {
    $this->contraseÃ±a = $this->db->real_escape_string($contraseÃ±a);
  }
  function getRol()
  {
    return $this->rol;
  }
  function setRol($rol)
  {
    $this->rol = $this->db->real_escape_string($rol);
  }
  function getEstado()
  {
    return $this->estado;
  }
  function setEstado($estado)
  {
    $this->estado = $this->db->real_escape_string($estado);
  }
  function getAsunto(){
    return $this->asunto;
  }
  function setAsunto($asunto){
    $this->asunto=$this->db->real_escape_string($asunto);
  }
  function getTelefono(){
    return $this->telefono;
  }
  function setTelefono($telefono){
    $this->telefono= $this->db->real_escape_string($telefono);
  }
  function getMensaje(){
    return $this->mensaje;
  }
  function setMensaje($mensaje){
    $this->mensaje= $this->db->real_escape_string($mensaje);
  }
  public function findAll()
  {
    $sql = "SELECT * FROM usuarios inner join rol on usuarios.rol= rol.idRol";
    $users = $this->db->query($sql);
    return $users;
  }
  public function findUId()
  {
    $sql = "SELECT * FROM usuarios INNER JOIN rol on usuarios.rol= rol.idRol WHERE idUsuario= '{$this->getId()}'";
    $user = $this->db->query($sql);
    return $user->fetch_object();
  }
  public function findId()
  {
    $sql = "SELECT * FROM usuarios INNER JOIN rol ON usuarios.rol = rol.idRol WHERE email='{$this->getCorreo()}'";
    $user = $this->db->query($sql);
    return $user->fetch_object();
  }
  public function masi(){
    $sql= "SELECT email, nombre, apellido FROM usuarios";
    $ma= $this->db->query($sql);
    return $ma->fetch_object();
  }
  public function findIDU()
  {
    $sql = "SELECT * FROM usuarios INNER JOIN rol ON usuarios.rol = rol.idRol WHERE idUsuario='{$this->getId()}'";
    $user = $this->db->query($sql);
    return $user->fetch_object();
  }
  public function save()
  {
    $sql = "INSERT INTO usuarios VALUES(NULL, '{$this->getNombre()}','{$this->getApellido()}','{$this->getCorreo()}', '{$this->getContraseÃ±a()}','{$this->getRol()}','Activo')";
    $saved = $this->db->query($sql);
    return $saved;
  }
  public function update(){
    $sql= "UPDATE usuarios SET nombre='{$this->getNombre()}',apellido= '{$this->getApellido()}',email='{$this->getCorreo()}',rol='{$this->getRol()}' WHERE idUSuario= {$this->getId()} ";
    $update= $this->db->query($sql);
    return $update;
  }
  public function exits()
  {
    $sql = "SELECT * FROM usuarios WHERE nombre='{$this->getNombre()}' OR email ='{$this->getCorreo()}';";
    $r = $this->db->query($sql);
    return $r;
  }
  public function login()
  {
    
    $result = false;
    $id = $this->id;
    $contraseÃ±a = $this->contraseÃ±a;

    // Comprovamos si existe el usuario
    $login = $this->findUserID();

    // Comprobamos si la consulta retorno el usuario
    if ($login && is_object($login)) {
      // Guardamos los datos en un Objeto
      if ($login->estado == 'Activo') {
        if ($contraseÃ±a == $login->PASSWORD) {
          $result = $login;
        }
      } elseif ($login->estado == 'Inactivo') {
        $result = 'Inactivo';
      }
    } else {
      $result = "ErrorDatos";
    }
    return $result;
  }
  public function findRol()
  {
    $sql = "SELECT * FROM rol";
    $rol = $this->db->query($sql);
    return $rol;
  }
  public function findUsers()
  {
    $sql = "CALL findUsuarios()";
    $usuarios = $this->db->query($sql);
    return $usuarios;
  }
  // Consultar Usuario Por ID
  public function findUserID()
  {
    $sql = " SELECT idUsuario, nombre ,apellido, email, PASSWORD, estado, rol, tipoRol from usuarios INNER JOIN rol ON usuarios.rol = rol.idRol WHERE email = '{$this->getCorreo()}'";
    $usuarios = $this->db->query($sql);
    return $usuarios->fetch_object();
  }
  
  public function delete()
  {
  $sql = "DELETE FROM usuarios WHERE idUsuario={$this->getId()}";
  $delete = $this->db->query($sql);
    return $delete;
  }
  // consulta de solo practicantes
  public function getPracticante(){
    $sql= "SELECT * from usuarios INNER join rol on rol.idRol=usuarios.rol where  rol =4";
    $Pra= $this->db->query($sql);
    return $Pra;
  }
  // consulta de solo padrinos
  public function getPadrino(){
    $sql="SELECT * FROM usuarios INNER JOIN rol on rol.idRol= usuarios.rol where rol =2";
    $pad=$this->db->query($sql);
    return $pad;
  }
  public function countUsers(){
    $sql="CALL asitad(@a, @b, @c, @d)";
    $r= $this->db->query($sql);
    $all= [];
    while($fila = mysqli_fetch_assoc($r)){
      array_push($all,$fila);
    }

    $countAdmin = (int)$all[0]['UsersAdmin'];
    $countPadrino = (int)$all[0]['UsersPadrino'];
    $countMedico = (int)$all[0]['UsersMedico'];
    $countPracticante = (int)$all[0]['UsersPracticante'];

    $allUser= $countAdmin+ $countPadrino + $countMedico +$countPracticante;

    $porcentajeAdmin= bcdiv(($countAdmin / $allUser)*100,'1',2);
    $porcentajePadrino= bcdiv(($countPadrino / $allUser)*100,'1',2);
    $porcentajeMedico= bcdiv(($countMedico / $allUser)*100,'1',2);
    $porcentajePracticante= bcdiv(($countPracticante / $allUser)*100,'1',2);

    $arr=[
      [(float) $porcentajeAdmin],
      [(float) $porcentajePadrino],
      [(float) $porcentajeMedico],
      [(float) $porcentajePracticante]
    ];
    return $arr;
  }
}
