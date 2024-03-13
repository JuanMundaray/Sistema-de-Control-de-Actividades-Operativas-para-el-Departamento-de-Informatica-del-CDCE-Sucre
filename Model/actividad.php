<?php
require_once('DataBase.php');
class actividad{
    private $id;
    private $codigo;
    private $nombre;
    private $dep_receptor;
    private $dep_emisor;
    private $tipo;
    private $fecha;
    private $nom_atendido;
    private $ape_atendido;
    private $ced_atendido;
    private $nom_responsable;
    private $ape_responsable;
    private $ced_responsable;
    private $estado;
    private $observacion;
    private $informe;
    private $db;
    private $orden='desc';
    
    public function __construct()
    {
        $this->observacion="";
        $this->informe="";
        $this->estado="INICIADA";
    }

    
    public function guardar()
    {
        $resultado = false;
        try{
            $codigo = $this->codigo;
            $nombre = $this->nombre;
            $dep_receptor = $this->dep_receptor;
            $dep_emisor = $this->dep_emisor;
            $tipo = $this->tipo;
            $fecha=$this->fecha;
            $nom_atendido = $this->nom_atendido;
            $ape_atendido = $this->ape_atendido;
            $ced_atendido = $this->ced_atendido;
            $observacion=$this->observacion;
            $nom_responsable = $this->nom_responsable;
            $ape_responsable = $this->ape_responsable;
            $ced_responsable = $this->ced_responsable;
            $estado=$this->estado;
            $db = DataBase::getInstance();
            $consulta = "INSERT INTO actividades.actividad(
            codigo,nombre,
            tipo,fecha,
            dep_receptor,dep_emisor, nom_atendido,
            ape_atendido,ced_atendido,
            observacion,nom_responsable,
            ape_responsable, ced_responsable,estado)
              VALUES (
            :codigo,:nombre,
            :tipo,:fecha,
            :dep_receptor,:dep_emisor,:nom_atendido,
            :ape_atendido,:ced_atendido,
            :observacion,:nom_responsable,
            :ape_responsable,:ced_responsable,:estado)";
            $resultadoPDO = $db->prepare($consulta);
            $resultadoPDO->execute(array(":codigo"=>$codigo,":nombre"=>$nombre,
            ":tipo"=>$tipo, ":fecha"=>$fecha,
            ":dep_receptor"=>$dep_receptor,
            ":dep_emisor"=>$dep_emisor,":nom_atendido"=>$nom_atendido,
            ":ape_atendido"=>$ape_atendido,":ced_atendido"=>$ced_atendido,
            ":observacion"=>$observacion,":nom_responsable"=>$nom_responsable,
            ":ape_responsable"=>$ape_responsable,":ced_responsable"=>$ced_responsable, ":estado"=>$estado));
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

    public function modificar()
    {
        $resultado = false;
        try{
            $estado=$this->estado;
            $observacion=$this->observacion;
            $informe=$this->informe;
            $id=$this->id;
            $db = DataBase::getInstance();
            $consulta = "UPDATE actividades.actividad
            SET estado=:estado,observacion=:observacion,informe=:informe
            WHERE id='$id'";
            $resultadoPDO = $db->prepare($consulta);
            $resultadoPDO->execute(array(":observacion"=>$observacion,":informe"=>$informe,":estado"=>$estado));
            $resultadoPDO->closeCursor();                   
        }
        catch(Exception $objeto){
            $resultado = false;
            echo $objeto->getLine();
            echo $objeto->getMessage();
        }
        return $resultado; 
    }

    public function eliminar()
    {
        $resultado = false;
        try{
            $id=$this->id;
            $db=DataBase::getInstance();
            $consulta="DELETE from actividades.actividad where id=:id";
            $resultadoPDO = $db->prepare($consulta);
            $resultadoPDO->execute(array(':id'=>$id));
            $resultado=$resultadoPDO->rowCount();
            $resultadoPDO->closeCursor();

        }catch(Exception $e){
            $resultado=false;
            echo $e->getLine();
            echo $e->getMessage();
        }
    }

    public function obtener()
    {
        $resultado = false;
        try{
            $orden=$this->orden;
            $db = DataBase::getInstance();            
            $consulta = "SELECT * FROM actividades.actividad
            INNER JOIN actividades.tipo_actividad
            ON actividad.tipo=tipo_actividad.id_tipo
            ORDER BY id $orden";
            $resultadoPDO = $db->query($consulta);
            $resultado = $resultadoPDO->fetchAll();
            $resultadoPDO->closeCursor();                        
        }
        catch(Exception $objeto){
            
            $resultado = false;
        }
        
        return $resultado; 
    }
    public function buscar($parametro)
    {
        $resultado = false;
        try{
            $nombre=$this->nombre;
            $db = DataBase::getInstance();            
            $consulta = "SELECT * FROM actividades.actividad 
            INNER JOIN actividades.tipo_actividad
            ON actividad.tipo=tipo_actividad.id_tipo WHERE $parametro LIKE '$nombre%' ";
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

    public function buscarId()
    {
        $resultado = false;
        try{
            $id=$this->id;
            $db = DataBase::getInstance();            
            $consulta = "SELECT * FROM actividades.actividad INNER JOIN actividades.tipo_actividad
            ON actividad.tipo=tipo_actividad.id_tipo WHERE id=:id";
            $resultadoPDO=$db->prepare($consulta);
            $resultadoPDO->execute(array(':id'=>$id));
            $resultado = $resultadoPDO->fetchAll();
            $resultadoPDO->closeCursor();                        
        }
        catch(Exception $objeto){
            
            $resultado = false;
            echo $objeto->getMessage();
        }
        
        return $resultado; 
    }

    public function autocompletar()
    {
        $resultado = false;
        try{
            $nombre=$this->nombre;
            $db = DataBase::getInstance();            
            $consulta = "Select * from actividades.actividad 
            INNER JOIN actividades.tipo_actividad
            on actividad.tipo=tipo_actividad.id_tipo where nombre ilike '%$nombre%'";
            $resultadoPDO = $db->query($consulta);
            while($data=$resultadoPDO->fetch(PDO::FETCH_ASSOC)){
                $resultado[]=$data['nombre'];
            }
            $resultadoPDO->closeCursor(); 
        }
        
        catch(Exception $objeto){
            $resultado = false;
            echo $objeto->getMessage();
        }
        
        return $resultado; 
    }
    
    
    public function setCodigo($codigo)
    {
        $this->codigo = trim($codigo);
    }
    public function setNombre($nombre)
    {
        $this->nombre = trim($nombre);
    }
    public function setDep_receptor($dep_receptor)
    {
        $this->dep_receptor = trim($dep_receptor);
    }
    public function setDep_emisor($dep_emisor)
    {
        $this->dep_emisor = trim($dep_emisor);
    }

    public function setTipo($tipo)
    {
        $this->tipo = trim($tipo);
    }
    public function setNom_atendido($nom_atendido)
    {
        $this->nom_atendido = trim($nom_atendido);
    }

    public function setNom_responsable($nom_responsable)
    {
        $this->nom_responsable = trim($nom_responsable);
    }
    public function setApe_responsable($ape_responsable)
    {
        $this->ape_responsable = trim($ape_responsable);
    }

    public function setApe_atendido($ape_atendido)
    {
        $this->ape_atendido = trim($ape_atendido);
    }
    public function setCed_atendido($ced_atendido)
    {
        $this->ced_atendido = trim($ced_atendido);
    }

    public function setCed_responsable($ced_responsable)
    {
        $this->ced_responsable = trim($ced_responsable);
    }
    public function setEstado($estado)
    {
        $this->estado = trim($estado);
    }
    public function setObservacion($observacion)
    {
        $this->observacion = trim($observacion);
    }
    public function setfecha($fecha)
    {
        $this->fecha = trim($fecha);
    }

    public function setID($id)
    {
        $this->id = trim($id);
    }
    public function setInforme($informe)
    {
        $this->informe = trim($informe);
    }



    //-------------------------------------------------------------------------------------------//
}