<?php
require_once('DataBase.php');
class peticion{
    private $id_peticion;
    private $nombre_usuario;
    private $nombre_peticion;
    private $departamento_peticion;
    private $detalles_peticion;
    private $fecha_peticion;
    private $db;
    private $orden='desc';
    
    public function __construct()
    {
        $this->setFecha_peticion(date("Y-m-d"));
    }

    
    public function guardar()
    {
        $resultado = false;
        try{
            $nombre_usuario = $this->nombre_usuario;
            $nombre_peticion = $this->nombre_peticion;
            $departamento_peticion = $this->departamento_peticion;
            $detalles_peticion = $this->detalles_peticion;
            $fecha_peticion = $this->fecha_peticion;
            $db = DataBase::getInstance();
            $consulta = "INSERT INTO actividades.peticiones(
            nombre_usuario,nombre_peticion,
            departamento_peticion,detalles_peticion,
            fecha_peticion)
              VALUES (
            :nombre_usuario,:nombre_peticion,
            :departamento_peticion,:detalles_peticion,
            :fecha_peticion)";
            $resultadoPDO = $db->prepare($consulta);
            $resultadoPDO->execute(array(":nombre_usuario"=>$nombre_usuario,":nombre_peticion"=>$nombre_peticion,
            ":departamento_peticion"=>$departamento_peticion, ":detalles_peticion"=>$detalles_peticion,
            ":fecha_peticion"=>$fecha_peticion));
            $resultado = $resultadoPDO->rowCount();
            $resultadoPDO->closeCursor();            
        }
        catch(Exception $objeto){
            $resultado = false;
            echo $objeto->getLine();
            echo $objeto->getMessage();
        }

        return $resultado; 
    }
    
    
    public function setNombre_usuario($nombre_usuario)
    {
        $this->nombre_usuario = trim($nombre_usuario);
    }
    public function setNombre_peticion($nombre_peticion)
    {
        $this->nombre_peticion = trim($nombre_peticion);
    }
    public function setDepartamento_peticion($departamento_peticion)
    {
        $this->departamento_peticion = trim($departamento_peticion);
    }
    public function setDetalles_peticion($detalles_peticion)
    {
        $this->detalles_peticion = trim($detalles_peticion);
    }
    public function setFecha_peticion($fecha_peticion)
    {
        $this->fecha_peticion = trim($fecha_peticion);
    }

    //-------------------------------------------------------------------------------------------//
}