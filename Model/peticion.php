<?php
require_once('DataBase.php');
class peticion{
    private $id_peticion;
    private $id_usuario;
    private $nombre_peticion;
    private $departamento_peticion;
    private $detalles_peticion;
    private $fecha_peticion;
    private $db;
    private $orden='asc';
    
    public function __construct()
    {
        $this->setFecha_peticion(date("Y-m-d"));
    }

    
    public function guardar()
    {
        $resultado = false;
        try{
            $id_usuario = $this->id_usuario;
            $nombre_peticion = $this->nombre_peticion;
            $departamento_peticion = $this->departamento_peticion;
            $detalles_peticion = $this->detalles_peticion;
            $fecha_peticion = $this->fecha_peticion;
            $db = DataBase::getInstance();
            $consulta = "INSERT INTO actividades.peticiones(
            id_usuario,nombre_peticion,
            departamento_peticion,detalles_peticion,
            fecha_peticion)
              VALUES (
            :id_usuario,:nombre_peticion,
            :departamento_peticion,:detalles_peticion,
            :fecha_peticion)";
            $resultadoPDO = $db->prepare($consulta);
            $resultadoPDO->execute(array(":id_usuario"=>$id_usuario,":nombre_peticion"=>$nombre_peticion,
            ":departamento_peticion"=>$departamento_peticion, ":detalles_peticion"=>$detalles_peticion,
            ":fecha_peticion"=>$fecha_peticion));
            $resultado = $resultadoPDO->rowCount();
            $resultadoPDO->closeCursor();            
        }
        catch(Exception $objeto){
            $resultado = false;
            echo $objeto->getMessage();
        }

        return $resultado; 
    }

    public function getPeticiones($pagina,$num_resultados)
    {
        $resultado = false;
        try{
            $NumRegistros=$this->getNumRegistros();
            $total_paginas=ceil($NumRegistros/$num_resultados);
            $punto_inicio=($pagina-1)*$num_resultados;

            $orden=$this->orden;
            $db = DataBase::getInstance();            
            $consulta = "SELECT * FROM actividades.peticiones 
            ORDER BY id_peticion $orden 
            LIMIT $num_resultados OFFSET $punto_inicio";
            $resultadoPDO = $db->query($consulta);
            $resultado = $resultadoPDO->fetchAll();
            $resultadoPDO->closeCursor();                        
        }
        catch(Exception $objeto){
            $resultado = false;
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
            $consulta="DELETE FROM actividades.peticiones WHERE id_peticion=:id_peticion";
            $resultadoPDO = $db->prepare($consulta);
            $resultadoPDO->execute(array(':id_peticion'=>$id_peticion));
            $resultado=$resultadoPDO->rowCount();
            $resultadoPDO->closeCursor();

        }catch(Exception $objeto){
            $resultado = false;
            echo $objeto->getMessage();
        }
    }

    public function buscar($parametro,$data_busq,$pagina,$num_resultados)
    {
        $resultado = false;
        try{
            $NumRegistros=$this->getNumRegistros($parametro,$data_busq);
            $total_paginas=ceil($NumRegistros/$num_resultados);
            $punto_inicio=($pagina-1)*$num_resultados;

            $orden=$this->orden;
            $data_busq=$data_busq;
            $db = DataBase::getInstance();
            $consulta = "SELECT * FROM actividades.peticiones 
            WHERE $parametro ILIKE '$data_busq%'
            LIMIT $num_resultados OFFSET $punto_inicio";

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

    public function getNumRegistros($condicion=false,$data_busq=null)
    {
        $resultado = false;
        try{
            $db = DataBase::getInstance();
            if($condicion){
                $consulta = "SELECT * FROM actividades.peticiones WHERE $condicion ILIKE '$data_busq%'";
                $resultadoPDO = $db->query($consulta);
            }
            else{
                $consulta = "SELECT * FROM actividades.peticiones";
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
    
    public function setId_peticion($id_peticion)
    {
        $this->id_peticion = trim($id_peticion);
    }
    public function setid_usuario($id_usuario)
    {
        $this->id_usuario = trim($id_usuario);
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