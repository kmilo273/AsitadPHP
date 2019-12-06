<?php

class Examenes
{
  private $db;
  private $id;
  private $fecha;
  private $nombreExamen;
  private $descricionExamen;
  private $documento;
 
  public function __construct()
  {
    $this->db = DataBase::conectar();
  }

  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = $id;
  }

  public function getFecha()
  {
    return $this->fecha;
  }

  public function setFecha($fecha)
  {
    $this->fecha = $fecha;
  }
  public function getNombre(){
    return $this->nombreExamen;
  }
  public function setNombre($nombreExamen){
    $this->nombreExamen= $nombreExamen;
  }
  public function getDescripcion(){
    return $this->descricionExamen;
  }
  public function setDescripcion($descricionExamen){
    $this->descricionExamen= $descricionExamen;
  }
  public function getDocumento(){
    return $this->documento;
  }
  public function setDocumento($documento){
    $this->documento= $documento;
  }

  public function findAll()
  {
    $sql = "SELECT * FROM examenesmedicos ";
    $finded = $this->db->query($sql);
    return $finded;
  }

  public function findID()
  {
    $sql = "SELECT * FROM examenesmedicos  WHERE idExamenesMedicos={$this->getId()}";
    $finded = $this->db->query($sql);
    return $finded->fetch_object();
    // El fetch_object() es para pasar los datos a un Objeto 'SOLO SE USA CUANDO ES UN REGISTRO'
  }

  public function save()
  {
    $sql = "INSERT INTO examenesmedicos VALUES (NULL, '{$this->getFecha()}', '{$this->getNombre()}', '{$this->getDescripcion()}' , '{$this->getDocumento()}')";
    $saved = $this->db->query($sql);
    return $saved;
  }

  public function update()
  {
    $sql = "UPDATE examenesmedicos SET fechaExamenesMedicos='{$this->getFecha()}',nombreExamenesMedico='{$this->getNombre()}',descripcionExamenMedico='{$this->getDescripcion()}'";
    if($this->getDocumento() != null){
      $sql .= ",documentos='{$this->getDocumento()}'";
    }
    $sql.= "WHERE idExamenesMedicos={$this->id};";
    $update = $this->db->query($sql);
    $result= false;
    if($update){
      $result = true;
    }
    return $result;
  }

  public function delete()
  {
    $sql = "DELETE FROM examenesmedicos WHERE idExamenesMedicos={$this->getId()}";
    $deleted = $this->db->query($sql);
    return $deleted;
  }
}

