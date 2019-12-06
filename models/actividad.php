<?php
class Actividad
{
  private $db;
  private $id;
  private $fechaActividad;
  private $nombreActividad;
  private $horaActividad;
  private $abuelito_idAbuelito;
  private $usuario_idUsuario;
  private $tipoActividad;
  private $imagen;

  public function __construct()
  {
    $this->db = DataBase::conectar();
  }
  // GET - SET ID
  public function getId()
  {
    return $this->id;
  }
  public function setId($id)
  {
    $this->id = $id;
  }

  // GET - SET Fecha
  public function getFechaActividad()
  {
    return $this->fechaActividad;
  }
  public function setFechaActividad($fechaActividad)
  {
    $this->fechaActividad = $this->db->real_escape_string($fechaActividad);
  }
  // GET - SET NombreActividad
  public function getNombreActividad()
  {
    return $this->nombreActividad;
  }
  public function setNombreActividad($nombreActividad)
  {
    $this->nombreActividad = $this->db->real_escape_string($nombreActividad);
  }

  // GET - SET horaActividad
  public function getHoraActividad()
  {
    return $this->horaActividad;
  }
  public function setHoraActividad($horaActividad)
  {
    $this->horaActividad = $this->db->real_escape_string($horaActividad);
  }
  // GET - SET abuelito_idAbuelito
  public function getAbuelito_idAbuelito()
  {
    return $this->abuelito_idAbuelito;
  }
  public function setAbuelito_idAbuelito($abuelito_idAbuelito)
  {
    $this->abuelito_idAbuelito = $this->db->real_escape_string($abuelito_idAbuelito);
  }
  // GET - SET usuario_idUsuario
  public function getUsuario_idUsuario()
  {
    return $this->usuario_idUsuario;
  }
  public function setUsuario_idUsuario($usuario_idUsuario)
  {
    $this->usuario_idUsuario = $this->db->real_escape_string($usuario_idUsuario);
  }
  // GET - SET tipoActividad
  public function getTipoActividad()
  {
    return $this->tipoActividad;
  }
  public function setTipoActividad($tipoActividad)
  {
    $this->tipoActividad = $this->db->real_escape_string($tipoActividad);
  }
  public function getImagen()
  {
    return $this->imagen;
  }
  public function setIamgen($imagen)
  {
    $this->imagen = $this->db->real_escape_string($imagen);
  }
  public function findAll()
  {
    $sql = "SELECT * FROM actividad INNER JOIN tipoActividad ON actividad.tipoActividad = tipoactividad.idTipoActividad INNER JOIN abuelito ON actividad.abuelito_idAbuelito = abuelito.idAbuelito INNER JOIN usuarios on actividad.usuario_idUsuario = usuarios.idUsuario";
    $finded = $this->db->query($sql);
    return $finded;
  }

  public function findAllTipoA()
  {
    $sql = "SELECT * FROM tipoActividad";
    $finded = $this->db->query($sql);
    return $finded;
  }
  public function findAllAbuelito()
  {
    $sql = "SELECT * FROM abuelito";
    $finded = $this->db->query($sql);
    return $finded;
  }
  public function findAllUsuario()
  {
    $sql = "SELECT * FROM usuarios";
    $finded = $this->db->query($sql);
    return $finded;
  }
  public function findID()
  {
    $sql = "SELECT * FROM actividad INNER JOIN abuelito on actividad.abuelito_idAbuelito= abuelito.idAbuelito INNER JOIN usuarios on actividad.usuario_idUsuario= usuarios.idUsuario INNER JOIN tipoactividad on actividad.tipoActividad= tipoactividad.idTipoActividad WHERE id={$this->getId()}";
    $finded = $this->db->query($sql);
    return $finded->fetch_object();
  }

  public function save()
  {
    $sql = "INSERT INTO actividad VALUES (NULL, '{$this->getNombreActividad()}','{$this->getHoraActividad()}','{$this->getAbuelito_idAbuelito()}',{$_SESSION['userLog']->idUsuario},'{$this->getTipoActividad()}','{$this->getFechaActividad()}','{$this->getImagen()}')";
    $saved = $this->db->query($sql);
    return $saved;
  }

  public function update()
  {
    $sql = " UPDATE actividad set  nombreActividad='{$this->getNombreActividad()}',horaActividad='{$this->getHoraActividad()}',abuelito_idAbuelito='{$this->getAbuelito_idAbuelito()}',usuario_idUsuario={$_SESSION['userLog']->idUsuario}, tipoActividad='{$this->getTipoActividad()}',fechaActividad='{$this->getFechaActividad()}'";
    if ($this->getImagen() != null) {
      $sql .= ",imagenActividad='{$this->getImagen()}'";
    }
    $sql .= "where id={$this->id};";

    $save = $this->db->query($sql);
    $result = false;
    //var_dump($sql); die();
    if ($save) {
      $result = true;
    }
    return $result;
  }
  public function delete()
  {
    $sql = "DELETE FROM actividad WHERE id={$this->getId()}";
    $deleted = $this->db->query($sql);
    return $deleted;
  }
  public function getOne()
  {
    $sql = "SELECT * FROM actividad where id={$this->getId()}";
    $update = $this->db->query($sql);
    return $update;
  }
  public function countTipo()
  {
    $sql = "CALL tipoActividad(@a, @b, @c, @d)";
    $r = $this->db->query($sql);
    $all = [];
    while ($fila = mysqli_fetch_assoc($r)) {
      array_push($all, $fila);
    }
    $jugar = (int) $all[0]['game'];
    $baile = (int) $all[0]['dance'];
    $manualidades = (int) $all[0]['manualid'];
    $cuento = (int) $all[0]['cuen'];

    $allTi= $jugar + $baile + $manualidades +$cuento;

    $porcentajeJugar= bcdiv(($jugar/$allTi)*100,'1',2);
    $porcentajeBaile= bcdiv(($baile/$allTi)*100,'1',2);
    $porcentajeManualidades= bcdiv(($manualidades/$allTi)*100,'1',2);
    $porcentajeCuento= bcdiv(($cuento/$allTi)*100,'1',2);
    
    $arr=[
      [(float)$porcentajeJugar],
      [(float)$porcentajeBaile],
      [(float)$porcentajeManualidades],
      [(float)$porcentajeCuento]
    ];
    return $arr;
  }
  //consultar con usuarios las acticidades
  public function findUsariosActividad()
  {
    $sql = "SELECT * FROM actividad INNER JOIN tipoActividad ON actividad.tipoActividad = tipoactividad.idTipoActividad INNER JOIN abuelito ON actividad.abuelito_idAbuelito = abuelito.idAbuelito INNER JOIN usuarios on actividad.usuario_idUsuario = usuarios.idUsuario WHERE idUsuario";
    $finded = $this->db->query($sql);
    return $finded->fetch_object();
  }
  
}
