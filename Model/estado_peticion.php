<?php
require_once('DataBase.php');
class estado_peticion{
    private $id_estado_peticion;
    private $nombre_estado_peticion;
    private $orden='ASC';
    
    public function __construct(){}

    public function obtener()
    {
        $resultado = false;
        try{
            $nombre_estado_peticion = $this->nombre_estado_peticion;
            $id_estado_peticion = $this->id_estado_peticion;
            $orden=$this->orden; 
            $db = DataBase::getInstance();

            $consulta = "SELECT * FROM actividades.estado_peticion WHERE 1=1";

            $resultadoPDO = $db->query($consulta);
            $resultado = $resultadoPDO->fetchAll();
            $resultadoPDO->closeCursor();                        
        }
        catch(Exception $objeto){
            
            $resultado = false;
        }
        
        return $resultado; 
    }
    
    public function setNombreEstadoActividad($nombre_estado_peticion)
    {
        $this->nombre_estado_peticion = trim($nombre_estado_peticion);
    }

    public function setIdEstadoActividad($id_estado_peticion)
    {
        $this->id_estado_peticion = trim($id_estado_peticion);
    }
    //-------------------------------------------------------------------------------------------// 
    public function getNombreEstadoActividad()
    {
        return $this->nombre_estado_peticion;
    }

    public function getIdEstadoActividad()
    {
        return $this->id_estado_peticion;
    }
}