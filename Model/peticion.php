<?php
require_once('DataBase.php');
class peticion{
    private $id_peticion;
    private $usuario;
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
            $usuario = $this->usuario;
            $nombre_peticion = $this->nombre_peticion;
            $departamento_peticion = $this->departamento_peticion;
            $detalles_peticion = $this->detalles_peticion;
            $fecha_peticion = $this->fecha_peticion;
            $db = DataBase::getInstance();
            $consulta = "INSERT INTO actividades.peticiones(
            usuario,nombre_peticion,
            departamento_peticion,detalles_peticion,
            fecha_peticion)
              VALUES (
            :usuario,:nombre_peticion,
            :departamento_peticion,:detalles_peticion,
            :fecha_peticion)";
            $resultadoPDO = $db->prepare($consulta);
            $resultadoPDO->execute(array(":usuario"=>$usuario,":nombre_peticion"=>$nombre_peticion,
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

    public function obtener()
    {
        $resultado = false;
        try{
            $orden=$this->orden;
            $db = DataBase::getInstance();            
            $consulta = "SELECT * FROM actividades.peticiones ORDER BY id_peticion $orden";
            $resultadoPDO = $db->query($consulta);
            $resultado = $resultadoPDO->fetchAll();
            $resultadoPDO->closeCursor();                        
        }
        catch(Exception $objeto){
            $resultado = $objeto->getMessage();
        }
        
        return $resultado; 
    }

    public function eliminar()
    {
        $resultado = false;
        try{
            $id_peticion=$this->id_peticion;
            $db=DataBase::getInstance();
            $consulta="DELETE from actividades.peticiones where id_peticion=:id_peticion";
            $resultadoPDO = $db->prepare($consulta);
            $resultadoPDO->execute(array(':id_peticion'=>$id_peticion));
            $resultado=$resultadoPDO->rowCount();
            $resultadoPDO->closeCursor();

        }catch(Exception $e){
            $resultado=false;
            echo $e->getMessage();
        }
    }
    
    public function setId_peticion($id_peticion)
    {
        $this->id_peticion = trim($id_peticion);
    }
    public function setUsuario($usuario)
    {
        $this->usuario = trim($usuario);
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