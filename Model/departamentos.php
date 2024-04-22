<?php
require_once('DataBase.php');
class departamento{
    private $id_departamento;
    private $nombre_departamento;
    private $orden='ASC';
    
    public function __construct(){}

    public function crear()
    {
        $resultado = false;
        try{
            $nombre_departamento = $this->nombre_departamento;
            $db = DataBase::getInstance();
            $consulta = "INSERT INTO actividades.departamentos(nombre_departamento) VALUES (:nombre_departamento)";
            $resultadoPDO = $db->prepare($consulta);
            $resultadoPDO->execute(array(":nombre_departamento"=>$nombre_departamento));
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
            $nombre_departamento = $this->nombre_departamento;
            $id_departamento = $this->id_departamento;
            $orden=$this->orden; 
            $db = DataBase::getInstance();

            $consulta = "SELECT * FROM actividades.departamentos WHERE 1=1";
            

            if(!empty($nombre_departamento)){
                $consulta .=" AND nombre_departamento ILIKE '%$nombre_departamento%'";
            }

            if(!empty($id_departamento)){
                $consulta .=" AND id_departamento=$id_departamento";
            }

            $consulta.=" ORDER BY id_departamento $orden";
            if($pagina){
                $punto_inicio=($pagina-1)*$num_resultados;
                $consulta.=" LIMIT $num_resultados OFFSET $punto_inicio";
            }
            $resultadoPDO = $db->query($consulta);
            $resultado = $resultadoPDO->fetchAll();
            $resultadoPDO->closeCursor();                        
        }
        catch(Exception $objeto){
            
            $resultado = false;
        }
        
        return $resultado; 
    }
    
    public function setNombreDepartamento($nombre_departamento)
    {
        $this->nombre_departamento = trim($nombre_departamento);
    }

    public function setIdDepartamento($id_departamento)
    {
        $this->id_departamento = trim($id_departamento);
    }
    
    public function getNombreDepartamento()
    {
        return $this->nombre_departamento;
    }

    public function getIdDepartamento()
    {
        return $this->id_departamento;
    }



    //-------------------------------------------------------------------------------------------//
}