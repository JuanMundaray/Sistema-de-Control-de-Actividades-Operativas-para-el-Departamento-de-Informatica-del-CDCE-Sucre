<?php
require_once('DataBase.php');
class tipo_actividad{
    private $id_tipo;
    private $nombre_tipo;
    private $orden='ASC';
    
    public function __construct(){}

    public function crear()
    {
        $resultado = false;
        try{
            $nombre_tipo = $this->nombre_tipo;
            $db = DataBase::getInstance();
            $consulta = "INSERT INTO actividades.tipo_actividad(nombre_tipo) VALUES (:nombre_tipo)";
            $resultadoPDO = $db->prepare($consulta);
            $resultadoPDO->execute(array(":nombre_tipo"=>$nombre_tipo));
            $resultado = $resultadoPDO->rowCount();
            $resultadoPDO->closeCursor();            
        }
        catch(Exception $objeto){
            $resultado = false;
            echo $objeto->getMessage();
        }
        return $resultado; 
    }

    public function obtener($pagina=false,$num_resultados=false)
    {
        $resultado = false;
        try{
            $db = DataBase::getInstance();  
            if($pagina){
                $punto_inicio=($pagina-1)*$num_resultados;
                $orden=$this->orden;       
                $consulta = "SELECT * FROM actividades.tipo_actividad ORDER BY id_tipo $orden
                LIMIT $num_resultados OFFSET $punto_inicio";

                $resultadoPDO = $db->query($consulta);
            }
            
            else{
                $consulta = "SELECT * FROM actividades.tipo_actividad ORDER BY id_tipo";
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

    public function buscar($columna,$data_busq,$useLIKE=true,$pagina=false,$num_resultados=false)
    {
        $resultado = false;
        try{
            $orden=$this->orden;
            $data_busq=$data_busq;
            $columna=$columna;


            $db = DataBase::getInstance();
            if($pagina==true){
                $punto_inicio=($pagina-1)*$num_resultados;   

                if($useLIKE==false){    
                    
                    $consulta = "SELECT * FROM actividades.tipo_actividad WHERE $columna=$data_busq 
                    ORDER BY id_tipo $orden LIMIT $num_resultados OFFSET $punto_inicio";
                }
                
                if($useLIKE==true){
                    $consulta = "SELECT * FROM actividades.tipo_actividad WHERE $columna ILIKE '$data_busq%' 
                    ORDER BY id_tipo $orden LIMIT $num_resultados OFFSET $punto_inicio";
                }
            }

            if($pagina==false){
                if($useLIKE==true){
                    $consulta = "SELECT * FROM actividades.tipo_actividad WHERE $columna ILIKE '$data_busq%'";
                }
                if($useLIKE==false){
                    $consulta = "SELECT * FROM actividades.tipo_actividad WHERE $columna='$data_busq'";
                }
            }

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

    public function getNumRegistros($columna=false,$data_busq=false,$useLIKE=true)
    {
        $resultado = false;
        try{
            $db = DataBase::getInstance();
            if($columna){
                if($useLIKE==true){
                    $consulta = "SELECT * FROM actividades.tipo_actividad WHERE $columna ILIKE'$data_busq%'";
                }else{
                    $consulta = "SELECT * FROM actividades.tipo_actividad WHERE $columna='$data_busq'";
                }
            }
            else{
                $consulta = "SELECT * FROM actividades.tipo_actividad";
            }
            $resultadoPDO = $db->query($consulta);
            $resultado = $resultadoPDO->rowCount();
            $resultadoPDO->closeCursor();                        
        }
        catch(Exception $objeto){
            echo $objeto->getMessage();
            $resultado = false;
        }
        return $resultado; 
    }
    
    public function setNombre_tipo($nombre_tipo)
    {
        $this->nombre_tipo = trim($nombre_tipo);
    }

    public function setID($id_tipo)
    {
        $this->id_tipo = trim($id_tipo);
    }



    //-------------------------------------------------------------------------------------------//
}