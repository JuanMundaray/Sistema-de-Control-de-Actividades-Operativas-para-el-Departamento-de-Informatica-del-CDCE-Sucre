<?php
require_once('DataBase.php');
class actividad{
    private $codigo_actividad;
    private $nombre_actividad;
    private $dep_receptor;
    private $dep_emisor;
    private $id_tipo_actividad;
    private $fecha_registro;
    private $nom_atendido;
    private $ape_atendido;
    private $ced_atendido;
    private $estado_actividad;
    private $observacion;
    private $informe;
    private $evidencia;
    private $id_usuario_responsable;
    private $orden='DESC';
    
    public function __construct()
    {
        $this->observacion="";
        $this->informe="";
        $this->evidencia="";
        $this->estado_actividad="INICIADA";
    }

    
    public function guardar()
    {
        $resultado = false;
        try{
            $codigo_actividad = $this->codigo_actividad;
            $nombre_actividad = $this->nombre_actividad;
            $dep_receptor = $this->dep_receptor;
            $dep_emisor = $this->dep_emisor;
            $id_tipo_actividad = $this->id_tipo_actividad;
            $fecha_registro=$this->fecha_registro;
            $nom_atendido = $this->nom_atendido;
            $ape_atendido = $this->ape_atendido;
            $ced_atendido = $this->ced_atendido;
            $observacion=$this->observacion;
            $estado_actividad=$this->estado_actividad;
            $id_usuario_responsable = $this->id_usuario_responsable;
            $evidencia = $this->evidencia;
            $informe = $this->informe;
            $db = DataBase::getInstance();
            $consulta = "INSERT INTO actividades.actividad(
            codigo_actividad,
            nombre_actividad,
            id_tipo_actividad,
            fecha_registro,
            dep_receptor,
            dep_emisor,
            nom_atendido,
            ape_atendido,
            ced_atendido,
            observacion,
            estado_actividad,
            id_usuario_responsable,
            evidencia,
            informe)
              VALUES (
            :codigo_actividad,
            :nombre_actividad,
            :id_tipo_actividad,
            :fecha_registro,
            :dep_receptor,
            :dep_emisor,:nom_atendido,
            :ape_atendido,
            :ced_atendido,
            :observacion,
            :estado_actividad,
            :id_usuario_responsable,
            :evidencia,
            :informe)";
            $resultadoPDO = $db->prepare($consulta);
            $resultadoPDO->execute(array(
            ":codigo_actividad"=>$codigo_actividad,
            ":nombre_actividad"=>$nombre_actividad,
            ":id_tipo_actividad"=>$id_tipo_actividad,
            ":fecha_registro"=>$fecha_registro,
            ":dep_receptor"=>$dep_receptor,
            ":dep_emisor"=>$dep_emisor,
            ":nom_atendido"=>$nom_atendido,
            ":ape_atendido"=>$ape_atendido,
            ":ced_atendido"=>$ced_atendido,
            ":observacion"=>$observacion,
            ":estado_actividad"=>$estado_actividad,
            ":id_usuario_responsable"=>$id_usuario_responsable,
            ":evidencia"=>$evidencia,
            ":informe"=>$informe));
            $resultado = $resultadoPDO->rowCount();
            $resultadoPDO->closeCursor();            
        }
        catch(Exception $objeto){
            $resultado = false;
            echo $objeto->getMessage();
        }
        return $resultado; 
    }

    public function modificar()
    {
        $resultado = false;
        try{
            $estado_actividad=$this->estado_actividad;
            $observacion=$this->observacion;
            $informe=$this->informe;
            $evidencia=$this->evidencia;
            $codigo_actividad=$this->codigo_actividad;
            $db = DataBase::getInstance();
            $consulta = "UPDATE actividades.actividad
            SET 
            estado_actividad=:estado_actividad,
            observacion=:observacion,
            informe=:informe,
            evidencia=:evidencia
            WHERE codigo_actividad='$codigo_actividad'";
            $resultadoPDO = $db->prepare($consulta);
            $resultado=$resultadoPDO->execute(array(":observacion"=>$observacion,
            ":informe"=>$informe,
            ":estado_actividad"=>$estado_actividad,
            ":evidencia"=>$evidencia));
            $resultadoPDO->closeCursor();             
        } 
        catch(Exception $objeto){
            $resultado = false;
            echo $objeto->getMessage();
        }
        return $resultado; 
    }

    public function eliminar()
    {
        $resultado = false;
        try{
            $codigo_actividad=$this->codigo_actividad;
            $db=DataBase::getInstance();
            $consulta="UPDATE actividades.actividad SET estado_actividad='ELIMINADA' WHERE codigo_actividad=:codigo_actividad";
            $resultadoPDO = $db->prepare($consulta);
            $resultadoPDO->execute(array(':codigo_actividad'=>$codigo_actividad));
            $resultado=$resultadoPDO->rowCount();
            $resultadoPDO->closeCursor();

        }
        catch(Exception $objeto){
            $resultado = false;
            echo $objeto->getMessage();
        }
        return $resultado;
    }

    public function ObtenerActividades($pagina,$num_resultados,$todas=false)
    {
        $resultado = false;
        try{
            $codigo_actividad = $this->codigo_actividad;
            $nombre_actividad = $this->nombre_actividad;
            $fecha_registro=$this->fecha_registro;
            $estado_actividad=$this->estado_actividad;
            $id_usuario_responsable = $this->id_usuario_responsable;
            $db = DataBase::getInstance();  
            $orden=$this->orden;       
            $consulta = "SELECT *
            FROM actividades.actividad
            LEFT JOIN actividades.tipo_actividad
            ON actividad.id_tipo_actividad=tipo_actividad.id_tipo
            LEFT JOIN actividades.usuario
            ON actividad.id_usuario_responsable=usuario.id_usuario
            WHERE 1=1";

            if(!empty($codigo_actividad)){
                $consulta .=" AND codigo_actividad='$codigo_actividad'";
            }

            if(!empty($nombre_actividad)){
                $consulta .=" AND nombre_actividad ILIKE '$nombre_actividad%'";
            }

            if(!empty($fecha_registro)){
                $consulta .=" AND fecha_registro='$fecha_registro'";
            }

            if(!empty($estado_actividad)){
                $consulta .=" AND estado_actividad='$estado_actividad'";
            }

            if(!empty($id_usuario_responsable)){
                $consulta .=" AND id_usuario_responsable=$id_usuario_responsable";
            }

            if($todas==false){
                $consulta .=" AND estado_actividad<>'ELIMINADA'";
            }

            $consulta.=" ORDER BY fecha_registro $orden";

            if($pagina==true){
                $punto_inicio=($pagina-1)*$num_resultados; 
                $consulta.=" LIMIT $num_resultados OFFSET $punto_inicio";
            }

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

    public function buscarCodigo()
    {
        $resultado = false;
        try{
            $codigo_actividad=$this->codigo_actividad;
            $db = DataBase::getInstance();            
            $consulta = "SELECT * FROM actividades.actividad 
            LEFT JOIN actividades.tipo_actividad
            ON actividad.id_tipo_actividad=tipo_actividad.id_tipo 
            LEFT JOIN actividades.usuario
            ON actividad.id_usuario_responsable=usuario.id_usuario
            WHERE codigo_actividad=:codigo_actividad";
            $resultadoPDO=$db->prepare($consulta);
            $resultadoPDO->execute(array(':codigo_actividad'=>$codigo_actividad));
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
            $nombre_actividad=$this->nombre_actividad;
            $db = DataBase::getInstance();            
            $consulta = "SELECT * FROM actividades.actividad 
            LEFT JOIN actividades.tipo_actividad
            ON actividad.id_tipo_actividad=tipo_actividad.id_tipo WHERE nombre_actividad ILIKE '$nombre_actividad%'";
            $resultadoPDO = $db->query($consulta);
            while($data=$resultadoPDO->fetch(PDO::FETCH_ASSOC)){
                $resultado[]=$data['nombre_actividad'];
            }
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
                    $consulta = "SELECT * FROM actividades.actividad WHERE $columna ILIKE'$data_busq%'";
                }else{
                    $consulta = "SELECT * FROM actividades.actividad WHERE $columna='$data_busq'";
                }
            }
            else{
                $consulta = "SELECT * FROM actividades.actividad";
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
    //-----------------------------------funciones set
    
    public function setCodigoActividad($codigo_actividad)
    {
        $this->codigo_actividad = trim($codigo_actividad);
    }
    public function setNombreActividad($nombre_actividad)
    {
        $this->nombre_actividad = trim($nombre_actividad);
    }
    public function setDepReceptor($dep_receptor)
    {
        $this->dep_receptor = trim($dep_receptor);
    }
    public function setDepEmisor($dep_emisor)
    {
        $this->dep_emisor = trim($dep_emisor);
    }

    public function setIdTipo($id_tipo_actividad)
    {
        $this->id_tipo_actividad = trim($id_tipo_actividad);
    }
    public function setNomAtendido($nom_atendido)
    {
        $this->nom_atendido = trim($nom_atendido);
    }

    public function setApeAtendido($ape_atendido)
    {
        $this->ape_atendido = trim($ape_atendido);
    }

    public function setCedAtendido($ced_atendido)
    {
        $this->ced_atendido = trim($ced_atendido);
    }

    public function setEstadoActividad($estado_actividad)
    {
        $this->estado_actividad = trim($estado_actividad);
    }
    public function setObservacion($observacion)
    {
        $this->observacion = trim($observacion);
    }
    public function setfechaRegistro($fecha_registro)
    {
        $this->fecha_registro = trim($fecha_registro);
    }
    public function setInforme($informe)
    {
        $this->informe = trim($informe);
    }
    public function setEvidencia($evidencia){
        $this->evidencia = trim($evidencia);
    }
    public function setIdUsuario($id_usuario_responsable){
        $this->id_usuario_responsable = trim($id_usuario_responsable);
    }

    //-----------------------------------funciones get
    
    public function getCodigo()
    {
        return $this->codigo_actividad;
    }
    public function getNombre()
    {
        return $this->nombre_actividad;
    }
    public function getDepReceptor()
    {
        return $this->dep_receptor;
    }
    public function getDepEmisor()
    {
        return $this->dep_emisor;
    }

    public function getIdTipo()
    {
        return $this->id_tipo_actividad;
    }
    public function getNomAtendido()
    {
        return $this->nom_atendido;
    }

    public function getApeAtendido()
    {
        return $this->ape_atendido;
    }

    public function getCedAtendido()
    {
        return $this->ced_atendido;
    }

    public function getEstado()
    {
        return $this->estado_actividad;
    }
    public function getObservacion()
    {
        return $this->observacion;
    }
    public function getfecha($fecha_registro)
    {
        return $this->fecha_registro;
    }
    public function getInforme()
    {
        return $this->informe;
    }
    public function getEvidencia(){
        return $this->evidencia;
    }
    public function getIdUsuario(){
        return $this->id_usuario_responsable;
    }
}