<?php
require_once('DataBase.php');
class historial_usuario{

    private $orden='DESC';

    public function get_Historial_usuario($pagina,$num_resultados)
    {
        $resultado = false;
        try{
            $punto_inicio=($pagina-1)*$num_resultados;
            $db = DataBase::getInstance();
            $orden=$this->orden;
            $consulta = "SELECT *
            FROM actividades.historial_usuario
            LEFT JOIN actividades.departamentos
            ON historial_usuario.id_departamento=departamentos.id_departamento
            ORDER BY id_usuario $orden
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
                    $consulta = "SELECT * FROM actividades.historial_usuario WHERE $condicion='$data_busq'";
                    $resultadoPDO = $db->query($consulta);
                }
                if($condicion!="fecha"){
                    $consulta = "SELECT * FROM actividades.historial_usuario WHERE $condicion ILIKE '$data_busq%' ";
                    $resultadoPDO = $db->query($consulta);
                }
            }
            
            else{
                $consulta = "SELECT * FROM actividades.historial_usuario";
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