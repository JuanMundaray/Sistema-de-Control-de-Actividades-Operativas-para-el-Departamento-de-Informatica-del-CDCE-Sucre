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

            $consulta = "SELECT * FROM actividades.tipo_actividad WHERE nombre_tipo='$nombre_tipo'";
            $PDO = $db->query($consulta);
            $NumTipoActividades = $PDO->rowCount();

            if($NumTipoActividades==0){
                $consulta = "INSERT INTO actividades.tipo_actividad(nombre_tipo) VALUES (:nombre_tipo)";
                $resultadoPDO = $db->prepare($consulta);
                $resultadoPDO->execute(array(":nombre_tipo"=>$nombre_tipo));
                $resultado = $resultadoPDO->rowCount();
                $resultadoPDO->closeCursor();    
            }        
            else{
                echo "ERR_DUPLICADO";
            }
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
            $orden=$this->orden;
            $nombre_tipo=$this->nombre_tipo;
            $id_tipo=$this->id_tipo;
            $db = DataBase::getInstance();

            $consulta = "SELECT * FROM actividades.tipo_actividad WHERE 1=1";

            if(!empty($nombre_tipo)){
                $consulta .=" AND nombre_tipo ILIKE '$nombre_tipo%'";
            }

            if(!empty($id_tipo)){
                $consulta .=" AND id_tipo=$id_tipo";
            }

            if($pagina==true){

                $punto_inicio=($pagina-1)*$num_resultados;

                $consulta.=" ORDER BY id_tipo $orden LIMIT $num_resultados OFFSET $punto_inicio";
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

    public function contarNumRegistros(){
        $resultado = false;
        try{
            $nombre_tipo = $this->nombre_tipo;
            $id_tipo = $this->id_tipo;
            $db = DataBase::getInstance();

            $consulta = "SELECT * FROM 
            actividades.tipo_actividad WHERE 1=1";

            if(!empty($nombre_tipo)){
                $consulta .=" AND nombre_tipo ILIKE '$nombre_tipo%'";
            }
            if(!empty($id_tipo)){
                $consulta .=" AND id_tipo=$id_tipo";
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
    
    public function setNombreTipo($nombre_tipo)
    {
        $this->nombre_tipo = trim($nombre_tipo);
    }

    public function setIDTipo($id_tipo)
    {
        $this->id_tipo = trim($id_tipo);
    }
    
    public function getNombreTipo()
    {
        return $this->nombre_tipo;
    }

    public function getIDTipo()
    {
        return $this->id_tipo;
    }



    //-------------------------------------------------------------------------------------------//
}