<?php
require_once('DataBase.php');
class tipo_actividad{
    private $id_tipo;
    private $nombre_tipo;
    private $codigo_tipo;
    private $orden='asc';
    
    public function __construct(){}

    public function crear()
    {
        $resultado = false;
        try{
            $codigo_tipo = $this->codigo_tipo;
            $nombre_tipo = $this->nombre_tipo;
            $db = DataBase::getInstance();
            $consulta = "INSERT INTO actividades.tipo_actividad(codigo_tipo,nombre_tipo) VALUES (:codigo,:nombre)";
            $resultadoPDO = $db->prepare($consulta);
            $resultadoPDO->execute(array(":codigo"=>$codigo_tipo,":nombre"=>$nombre_tipo));
            $resultado = $resultadoPDO->rowCount();
            $resultadoPDO->closeCursor();            
        }
        catch(Exception $objeto){
            $resultado = false;
            echo $objeto->getMessage();
        }
        return $resultado; 
    }

    public function obtener()
    {
        $resultado = false;
        try{
            $orden=$this->orden;
            $db = DataBase::getInstance();         
            $consulta = "Select * from actividades.tipo_actividad order by id_tipo $orden";
            $resultadoPDO = $db->query($consulta);
            $resultado = $resultadoPDO->fetchAll();
            $resultadoPDO->closeCursor();                        
        }
        catch(Exception $objeto){
            
            $resultado = false;
        }
        
        return $resultado; 
    }

    public function buscar()
    {
        $resultado = false;
        try{
            $nombre_tipo=$this->nombre_tipo;
            $codigo_tipo=$this->codigo_tipo;
            $db = DataBase::getInstance();            
            $consulta = "SELECT * FROM actividades.tipo_actividad WHERE nombre_tipo LIKE '%$nombre_tipo%'";
            $resultadoPDO = $db->query($consulta);
            $resultado = $resultadoPDO->fetchAll();
            $resultadoPDO->closeCursor();                        
        }
        catch(Exception $objeto){
            $resultado = false;
            echo $objeto->getMessage();
        }
        
        return $resultado; 
    }
    
    
    public function setCodigo_tipo($codigo_tipo)
    {
        $this->codigo_tipo = trim($codigo_tipo);
    }
    public function setNombre_tipo($nombre_tipo)
    {
        $this->nombre_tipo = trim($nombre_tipo);
    }

    public function setID($id)
    {
        $this->id_tipo = trim($id);
    }



    //-------------------------------------------------------------------------------------------//
}