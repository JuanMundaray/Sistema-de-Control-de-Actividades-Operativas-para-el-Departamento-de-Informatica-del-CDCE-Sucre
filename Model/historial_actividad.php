<?php
require_once('DataBase.php');
class historial_actividad{

    private $orden='asc';

    public function getHistorial_actividades($pagina,$num_resultados)
    {
        $resultado = false;
        try{
            $punto_inicio=($pagina-1)*$num_resultados;
            $db = DataBase::getInstance();
            $orden=$this->orden;
            $consulta = "SELECT *
            FROM actividades.historial_actividades
            INNER JOIN actividades.tipo_actividad
            ON historial_actividades.id_tipo=tipo_actividad.id_tipo
            ORDER BY id $orden
            LIMIT $num_resultados OFFSET $punto_inicio";
            $resultadoPDO = $db->query($consulta);
            $resultado = $resultadoPDO->fetchAll();
            $resultadoPDO->closeCursor();
        }
        catch(Exception $objeto){
            echo $objeto->getMessage();
            $resultado = false;
        }
        
        return $resultado; 
    }

    public function getNumRegistros($condicion=false,$data_busq=false)
    {
        $resultado = false;
        try{
            $db = DataBase::getInstance();
            if(($condicion)){
                if($condicion=="fecha"){
                    $consulta = "SELECT * FROM actividades.historial_actividades WHERE $condicion='$data_busq'";
                    $resultadoPDO = $db->query($consulta);
                }
                if($condicion!="fecha"){
                    $consulta = "SELECT * FROM actividades.historial_actividades WHERE $condicion ILIKE '$data_busq%' ";
                    $resultadoPDO = $db->query($consulta);
                }
            }
            
            else{
                $consulta = "SELECT * FROM actividades.historial_actividades";
                $resultadoPDO = $db->query($consulta);
            }
            $resultado = $resultadoPDO->rowCount();
            $resultadoPDO->closeCursor();                        
        }
        catch(Exception $objeto){
            echo $objeto->getMessage();
            $resultado = false;
        }
        
        return $resultado; 
    }



    //-------------------------------------------------------------------------------------------//
}