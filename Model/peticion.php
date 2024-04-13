<?php
require_once('DataBase.php');
class peticion{
    private $id_peticion;
    private $id_usuario;
    private $nombre_peticion;
    private $departamento_peticion;
    private $detalles_peticion;
    private $fecha_peticion;
    private $tipo_actividad;
    private $estado_peticion;
    private $orden='ASC';

    
    public function guardar()
    {
        $resultado = false;
        try{
            $id_usuario = $this->id_usuario;
            $nombre_peticion = $this->nombre_peticion;
            $departamento_peticion = $this->departamento_peticion;
            $detalles_peticion = $this->detalles_peticion;
            $fecha_peticion = $this->fecha_peticion;
            $tipo_actividad=$this->tipo_actividad;
            $estado_peticion=$this->estado_peticion;
            $db = DataBase::getInstance();
            $consulta = "INSERT INTO actividades.peticiones(
            id_usuario,
            nombre_peticion,
            departamento_peticion,
            detalles_peticion,
            fecha_peticion,
            tipo_actividad,
            estado_peticion)
              VALUES (
            :id_usuario,
            :nombre_peticion,
            :departamento_peticion,
            :detalles_peticion,
            :fecha_peticion,
            :tipo_actividad,
            :estado_peticion)";
            $resultadoPDO = $db->prepare($consulta);
            $resultadoPDO->execute(array(
            ":id_usuario"=>$id_usuario,
            ":nombre_peticion"=>$nombre_peticion,
            ":departamento_peticion"=>$departamento_peticion,
            ":detalles_peticion"=>$detalles_peticion,
            ":fecha_peticion"=>$fecha_peticion,
            ":tipo_actividad"=>$tipo_actividad,
            ":estado_peticion"=>$estado_peticion));
            $resultado = $resultadoPDO->rowCount();
            $resultadoPDO->closeCursor();            
        }
        catch(Exception $objeto){
            $resultado = false;
            echo $objeto->getMessage();
        }

        return $resultado; 
    }

    public function obtener($pagina=false,$num_resultados=false,$extraer_todas=false)
    {
        $resultado = false;
        try{
            $orden=$this->orden;
            $id_usuario = $this->id_usuario;
            $nombre_peticion = $this->nombre_peticion;
            $departamento_peticion = $this->departamento_peticion;
            $fecha_peticion = $this->fecha_peticion;
            $estado_peticion=$this->estado_peticion;
            $db = DataBase::getInstance();

            $consulta="SELECT * FROM actividades.peticiones
            LEFT JOIN actividades.usuario
            ON peticiones.id_usuario=usuario.id_usuario
            LEFT JOIN actividades.departamentos
            ON peticiones.departamento_peticion=departamentos.id_departamento
            LEFT JOIN actividades.tipo_actividad
            ON peticiones.tipo_actividad=tipo_actividad.id_tipo WHERE 1=1 ";

            if(!empty($nombre_peticion)){
                $consulta .=" AND nombre_peticion ILIKE '$nombre_peticion%'";
            }

            if(!empty($departamento_peticion)){
                $consulta .=" AND peticiones.departamento_peticion=$departamento_peticion";
            }

            if(!empty($fecha_peticion)){
                $consulta .=" AND peticiones.fecha_peticion='$fecha_peticion'";
            }

            if(!empty($estado_peticion)){
                $consulta .=" AND peticiones.estado_peticion='$estado_peticion'";
            }

            if(!empty($id_usuario)){
                $consulta .=" AND peticiones.id_usuario=$id_usuario";
            }

            if($extraer_todas==false){
                $consulta .=" AND peticiones.estado_peticion!='RECHAZADA'";
            }

            if($pagina==true){
                $punto_inicio=($pagina-1)*$num_resultados;
                $consulta .=" ORDER BY id_peticion $orden LIMIT $num_resultados OFFSET $punto_inicio";
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

    public function rechazar()
    {
        $resultado = false;
        try{
            $id_peticion=$this->id_peticion;
            $db=DataBase::getInstance();

            $consulta="UPDATE actividades.peticiones 
            SET estado_peticion='RECHAZADA'
            WHERE id_peticion=:id_peticion";

            $resultadoPDO = $db->prepare($consulta);
            $resultadoPDO->execute(array(':id_peticion'=>$id_peticion));
            $resultado=$resultadoPDO->rowCount();
            $resultadoPDO->closeCursor();

        }catch(Exception $objeto){
            $resultado = false;
            echo $objeto->getMessage();
        }
        return $resultado;
    }
    public function exportarExcel(){
        require '../Plugins/yunho-dbexport-master/src/YunhoDBExport.php';
        require_once("../Model/configurarBD.php");

        date_default_timezone_set('America/Lima');
        $export=new YunhoDBExport(SERVIDOR,BD,USUARIO,CLAVE);
        
        $export->connect();

        $campos=array(
            'id_peticion'=>'ID',
            'nombre_peticion'=>'Nombre de Peticion',
            'nombre_departamento'=>'Departamento',
            'fecha_peticion'=>'Fecha de Creacion',
            'nombre_usuario'=>'Nombre de Usuario del Reponsable'
        );

        $consulta="SELECT * FROM actividades.peticiones
        LEFT JOIN actividades.usuario
        ON peticiones.id_usuario=usuario.id_usuario
        LEFT JOIN actividades.departamentos
        ON peticiones.departamento_peticion=departamentos.id_departamento";

        $export->query($consulta);

        // Formato MS Excel
        $export->to_excel();

        // Construir tabla de datos
        $tabla=$export->build_table($campos);
        
        // Descargar archivo .xls
        $export->download('Lista_peticiones');


        if ($dbhex = $export->get_error()) {
            die($dbhex->getMessage());
          }
    }
    
    public function setIdPeticion($id_peticion)
    {
        $this->id_peticion = trim($id_peticion);
    }
    public function setIdUsuario($id_usuario)
    {
        $this->id_usuario = trim($id_usuario);
    }
    public function setNombrePeticion($nombre_peticion)
    {
        $this->nombre_peticion = trim($nombre_peticion);
    }
    public function setDepartamentoPeticion($departamento_peticion)
    {
        $this->departamento_peticion = trim($departamento_peticion);
    }
    public function setDetallesPeticion($detalles_peticion)
    {
        $this->detalles_peticion = trim($detalles_peticion);
    }
    public function setFechaPeticion($fecha_peticion)
    {
        $this->fecha_peticion = trim($fecha_peticion);
    }
    public function setEstadoPeticion($estado_peticion)
    {
        $this->estado_peticion = trim($estado_peticion);
    }
    public function setTipoActividad($tipo_actividad)
    {
        $this->tipo_actividad = trim($tipo_actividad);
    }
    
    public function getIdPeticion()
    {
        return $this->id_peticion;
    }
    public function getIdUsuairo()
    {
        return $this->id_usuario;
    }
    public function getNombrePeticion()
    {
        return $this->nombre_peticion;
    }
    public function getDepartamentoPeticion()
    {
        return $this->departamento_peticion;
    }
    public function getDetallesPeticion()
    {
        return $this->detalles_peticion;
    }
    public function getFechaPeticion()
    {
        return $this->fecha_peticion;
    }
    public function getEstadoPeticion()
    {
        return $this->estado_peticion;
    }
    public function getTipoActividad()
    {
        return $this->tipo_actividad;
    }

    //-------------------------------------------------------------------------------------------//
}