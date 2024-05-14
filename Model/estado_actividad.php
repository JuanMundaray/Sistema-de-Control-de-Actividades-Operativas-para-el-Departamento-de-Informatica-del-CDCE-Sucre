<?php
require_once('DataBase.php');
class estado_actividad{
    private $id_estado_actividad;
    private $nombre_estado_actividad;
    private $orden='ASC';
    
    public function __construct(){}

    public function obtener()
    {
        $resultado = false;
        try{
            $nombre_estado_actividad = $this->nombre_estado_actividad;
            $id_estado_actividad = $this->id_estado_actividad;
            $orden=$this->orden; 
            $db = DataBase::getInstance();

            $consulta = "SELECT * FROM actividades.estado_actividad WHERE 1=1 
            AND nombre_estado_actividad<>'ELIMINADA'";

            $resultadoPDO = $db->query($consulta);
            $resultado = $resultadoPDO->fetchAll();
            $resultadoPDO->closeCursor();                        
        }
        catch(Exception $objeto){
            
            $resultado = false;
        }
        
        return $resultado; 
    }
    
    public function setNombreEstadoActividad($nombre_estado_actividad)
    {
        $this->nombre_estado_actividad = trim($nombre_estado_actividad);
    }

    public function setIdEstadoActividad($id_estado_actividad)
    {
        $this->id_estado_actividad = trim($id_estado_actividad);
    }
    //-------------------------------------------------------------------------------------------// 
    public function getNombreEstadoActividad()
    {
        return $this->nombre_estado_actividad;
    }

    public function getIdEstadoActividad()
    {
        return $this->id_estado_actividad;
    }
}