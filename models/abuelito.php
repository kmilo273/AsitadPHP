<?php
class Abuelito
{
    private $db;
    private $id;
    private $nombre;
    private $apellido;
    private $fechaNacimiento;
    private $estado;
    private $estadoSalud;
    private $necesidades;
    private $examenesMedicos;
    private $imagen;

    public function  __construct()
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
    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function getApellido()
    {
        return $this->apellido;
    }
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }
    public function getEstado()
    {
        return $this->estado;
    }
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }
    public function getNecesidades()
    {
        return $this->necesidades;
    }
    public function setNecesidades($necesidades)
    {
        $this->necesidades = $necesidades;
    }
    public function getExamenesMedico()
    {
        return $this->examenesMedicos;
    }
    public function setExamenesMedico($examenesMedicos)
    {
        $this->examenesMedicos = $examenesMedicos;
    }
    public function getEstadoSalud()
    {
        return $this->estadoSalud;
    }
    public function setEstadoSalud($estadoSalud)
    {
        $this->estadoSalud = $estadoSalud;
    }
    public function getImagen (){
        return $this->imagen;
    }
    public function setImagen($imagen){
        $this->imagen=$imagen;
    }
    public function findAll()
    {
        $sql = "SELECT *, abuelito.estado as estadoAB FROM abuelito INNER JOIN examenesmedicos on examenesmedicos.idExamenesMedicos= abuelito.examenMedico";
        $abu = $this->db->query($sql);
        return $abu;
    }
    public function findAllExamenes()
    {
        $sql = "SELECT * FROM examenesmedicos";
        $exa = $this->db->query($sql);
        return $exa;
    }
    public function getRamdom($limit){
       $abue= $this->db->query("SELECT * FROM abuelito ORDER BY RAND() LIMIT $limit");
       return $abue;
    }
    public function findID()
    {
        $sql = "SELECT *,abuelito.estado as estadoAB FROM abuelito INNER join examenesmedicos on abuelito.examenMedico= examenesmedicos.idExamenesMedicos WHERE idAbuelito={$this->getId()}";
        $finded = $this->db->query($sql);
        return $finded->fetch_object();
    }
    public function save()
    {
        $sql = "INSERT INTO abuelito values (null,'{$this->getNombre()}','{$this->getApellido()}','{$this->getFechaNacimiento()}', 'Activo','{$this->getNecesidades()}','{$this->getExamenesMedico()}','{$this->getEstadoSalud()}','{$this->getImagen()}');";

        $saved = $this->db->query($sql);
        return $saved;
    }
    public function update()
    {
        $sql= "UPDATE abuelito set nombreAbuelito='{$this->getNombre()}', apellido='{$this->getApellido()}',fechaNacimiento='{$this->getFechaNacimiento()}',necesidades='{$this->getNecesidades()}',examenMedico='{$this->getExamenesMedico()}',estadoSalud='{$this->getEstadoSalud()}'";
        if($this->getImagen()!= null){
            $sql.=",imagen='{$this->getImagen()}'";
        }
        $sql.="WHERE idAbuelito='{$this->id}';";
        $save=$this->db->query($sql);
        $result=false;
        if($save){
            $result=true;
        }
        return $result;
    }
    public function delete()
    {
        $sql = "UPDATE abuelito SET estado='{$this->getEstado()}' WHERE idAbuelito= {$this->id}";
        $delete = $this->db->query($sql);
        $resul = false;
        if ($delete) {
            $resul = true;
        }
        return $resul;
    }
    public function activos()
    {
        $sql = "CALL abuelitoActivos(@a,@b)";
        $r = $this->db->query($sql);
        return $r;
    }
    public function getOne()
    {
        $sql = "SELECT * FROM abuelito WHERE idAbuelito= {$this->getId()}";
        $r = $this->db->query($sql);
        return $r->fetch_object();
    }
}
