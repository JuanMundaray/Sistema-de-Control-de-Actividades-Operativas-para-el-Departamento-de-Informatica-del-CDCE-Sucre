<?php
require_once('DataBase.php');
class departamento{
    private $id_departamento;
    private $nombre_departamento;
    private $orden='DESC';
    
    public function __construct(){}

    public function obtener($pagina=false,$num_resultados=false)
    {
        $resultado = false;
        try{
            $db = DataBase::getInstance();
            if($pagina){
                $punto_inicio=($pagina-1)*$num_resultados;
                $orden=$this->orden;       
                $consulta = "SELECT * FROM actividades.departamentos ORDER BY id_departamento $orden
                LIMIT $num_resultados OFFSET $punto_inicio";

                $resultadoPDO = $db->query($consulta);
            }
            
            else{
                $consulta = "SELECT * FROM actividades.departamentos ORDER BY id_departamento";
                $resultadoPDO = $db->query($consulta);
            }
            
            $resultado = $resultadoPDO->fetchAll();
            $resultadoPDO->closeCursor();                        
        }
        catch(Exception $objeto){
            
            $resultado = false;
        }
        
        return $resultado; 
    }
    
    public function setNombre_departamento($nombre_departamento)
    {
        $this->nombre_departamento = trim($nombre_departamento);
    }

    public function setId_departamento($id_departamento)
    {
        $this->id_departamento = trim($id_departamento);
    }



    //-------------------------------------------------------------------------------------------//
}