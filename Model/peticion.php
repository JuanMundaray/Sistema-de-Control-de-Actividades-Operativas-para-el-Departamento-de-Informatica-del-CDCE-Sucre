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
    private $actividad_originada;
    private $orden='DESC';

    
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

    public function obtener($pagina=false,$num_resultados=false)
    {
        $resultado = false;
        try{
            $orden=$this->orden;
            $id_peticion=$this->id_peticion;
            $id_usuario = $this->id_usuario;
            $nombre_peticion = $this->nombre_peticion;
            $departamento_peticion = $this->departamento_peticion;
            $fecha_peticion = $this->fecha_peticion;
            $estado_peticion=$this->estado_peticion;
            $db = DataBase::getInstance();

            $consulta="SELECT *
            FROM actividades.peticiones
            LEFT JOIN actividades.usuario
            ON peticiones.id_usuario=usuario.id_usuario
            LEFT JOIN actividades.departamentos
            ON peticiones.departamento_peticion=departamentos.id_departamento
            LEFT JOIN actividades.tipo_actividad
            ON peticiones.tipo_actividad=tipo_actividad.id_tipo
            LEFT JOIN actividades.actividad
            ON peticiones.actividad_originada=actividad.codigo_actividad
            LEFT JOIN actividades.estado_peticion
            ON estado_peticion.id_estado_peticion=peticiones.estado_peticion
            WHERE 1=1 ";

            if(!empty($nombre_peticion)){
                $consulta .=" AND nombre_peticion ILIKE '$nombre_peticion%'";
            }

            if(!empty($departamento_peticion)){
                $consulta .=" AND peticiones.departamento_peticion='$departamento_peticion'";
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

            if(!empty($id_peticion)){
                $consulta .=" AND peticiones.id_peticion=$id_peticion";
            }

            $consulta .=" ORDER BY id_peticion $orden";

            if($pagina==true){
                $punto_inicio=($pagina-1)*$num_resultados;
                $consulta .=" LIMIT $num_resultados OFFSET $punto_inicio";
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
            SET estado_peticion=3
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

    public function aceptar()
    {
        $resultado = false;
        try{
            $id_peticion=$this->id_peticion;
            $actividad_originada=$this->actividad_originada;
            $db=DataBase::getInstance();

            $consulta="UPDATE actividades.peticiones 
            SET 
            actividad_originada=:actividad_originada,
            estado_peticion=2
            WHERE id_peticion=:id_peticion";

            $resultadoPDO = $db->prepare($consulta);
            $resultadoPDO->execute(array(
            ':id_peticion'=>$id_peticion,
            ':actividad_originada'=>$actividad_originada));
            
            $resultado=$resultadoPDO->rowCount();
            $resultadoPDO->closeCursor();

        }catch(Exception $objeto){
            $resultado = false;
            echo $objeto->getMessage();
        }
        return $resultado;
    }

    public function eliminar()
    {
        $resultado = false;
        try{
            $id_peticion=$this->id_peticion;
            $db=DataBase::getInstance();

            $consulta="DELETE FROM actividades.peticiones 
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

    public function contarNumRegistros($todas){
        $resultado = false;
        try{
            $orden=$this->orden;
            $id_peticion=$this->id_peticion;
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
            ON peticiones.tipo_actividad=tipo_actividad.id_tipo
            LEFT JOIN actividades.actividad
            ON peticiones.actividad_originada=actividad.codigo_actividad
            LEFT JOIN actividades.estado_peticion
            ON estado_peticion.id_estado_peticion=peticiones.estado_peticion
            WHERE 1=1 ";

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

            if(!empty($id_peticion)){
                $consulta .=" AND peticiones.id_peticion=$id_peticion";
            }

            $consulta .=" ORDER BY id_peticion $orden";

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

    public function exportarExcel(){
        $departamento_peticion = $this->departamento_peticion;
        $fecha_peticion = $this->fecha_peticion;
        $estado_peticion=$this->estado_peticion;

        require '../Librarys/yunho-dbexport-master/src/YunhoDBExport.php';
        require_once("../Model/configurarBD.php");

        $id_usuario=$this->id_usuario;
          date_default_timezone_set('America/Caracas');
        $export=new YunhoDBExport(SERVIDOR,BD,USUARIO,CLAVE);
        
        $export->connect();

        $campos=array(
            'id_peticion'=>'ID',
            'nombre_peticion'=>'Nombre de Peticion',
            'nombre_departamento'=>'Departamento',
            'fecha_peticion'=>'Fecha de Creacion',
            'nombre_usuario'=>'Nombre de Usuario del Reponsable',
            'nombre_estado_peticion'=>'Estado de Peticion'
        );

        $consulta="SELECT * FROM 
        LEFT JOIN actividades.usuario
        ON peticiones.id_usuario=usuario.id_usuario
        LEFT JOIN actividades.departamentos
        ON peticiones.departamento_peticion=departamentos.id_departamento
        LEFT JOIN actividades.tipo_actividad
        ON peticiones.tipo_actividad=tipo_actividad.id_tipo
        LEFT JOIN actividades.actividad
        ON peticiones.actividad_originada=actividad.codigo_actividad
        LEFT JOIN actividades.estado_peticion
        ON estado_peticion.id_estado_peticion=peticiones.estado_peticion
        WHERE 1=1";

        if(!empty($id_usuario)){
            $consulta.=" AND peticiones.id_usuario=$id_usuario";
            $campos=array(
                'id_peticion'=>'ID',
                'nombre_peticion'=>'Nombre de Peticion',
                'nombre_departamento'=>'Departamento',
                'fecha_peticion'=>'Fecha de Creacion',
                'nombre_usuario'=>'Nombre de Usuario del Reponsable',
            );
            $nombre_archivo='LISTA DE MIS PETICIONES';
        }
        else{
            $nombre_archivo='LISTA DE PETICIONES';
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

        $export->query($consulta);

        // Formato MS Excel
        $export->to_excel();

        // Construir tabla de datos
        $tabla=$export->build_table($campos);
        
        // Descargar archivo .xls
        $export->download($nombre_archivo);


        if ($dbhex = $export->get_error()) {
            die($dbhex->getMessage());
          }
    }
    public function exportarPDF($data_sql){
        
        require('../Librarys/fpdf186/fpdf.php');
        $pdf = new FPDF('P','mm',array(400,400));
        $pdf->AddPage();
        $pdf->SetMargins(25.4, 25.4, 25.4);
        // Logo
        $pdf->Image('../View/Resources/Imagenes/logo.jpg', 330, 0, 60);
        //Encabezado
        $pdf->SetFont('Arial','',12);
        $pdf->Ln();
        $pdf->Cell(0,6,'Ministerio del Poder Popular para la Educacion',0,0,'C');
        $pdf->Ln();
        $pdf->Cell(0,6,'Republica Bolivariana de Venezuela',0,0,'C');
        $pdf->Ln();
        $pdf->Cell(0,6,'Centro de Desarrollo de Calidad Educativa',0,0,'C');
        for($i=0;$i<3;$i++){$pdf->Ln();}
        //titulo
        $pdf->SetFont('Arial','UB',12);
        $pdf->Cell(0,20,'Reporte Generado '.date("Y-m-d"),0,0);
        $pdf->Ln();
        //nombres de columnas de la tabla
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(40,7,'ID de Peticion',1,0,'C');
        $pdf->Cell(80,7,'Nombre de Peticion',1,0,'C');
        $pdf->Cell(60,7,'Departamento de Peticion',1,0,'C');
        $pdf->Cell(25,7,'Fecha de Creacion',1,0,'C');
        $pdf->Cell(60,7,'Nombre de Usuario Responsable de Peticion',1,0,'C');
        $pdf->Cell(60,7,'Estado de Peticion',1,0,'C');
        $pdf->SetFont('Arial','',7);

        $font_size_fila=5;
        //Anadir datos de la tablas
        foreach($data_sql as $fila){
            $pdf->Ln();
            $pdf->Cell(40,$font_size_fila,utf8_decode($fila['id_peticion']),1,0,'C');
            $pdf->Cell(80,$font_size_fila,utf8_decode($fila['nombre_peticion']),1,0,'C');
            $pdf->Cell(60,$font_size_fila,utf8_decode($fila['nombre_departamento']),1,0,'C');
            $pdf->Cell(25,$font_size_fila,utf8_decode($fila['fecha_peticion']),1,0,'C');
            $pdf->Cell(60,$font_size_fila,utf8_decode($fila['nombre_usuario']),1,0,'C');
            $pdf->Cell(60,$font_size_fila,utf8_decode($fila['nombre_estado_peticion']),1,0,'C');
        }
        $pdf->Output('','Tabla de Peticiones Registradas',true);
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
    public function setActividadOriginada($actividad_originada)
    {
        $this->actividad_originada = trim($actividad_originada);
    }
    //FUNCIONES GET--------------------------------------------
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
    public function getActividadOriginada()
    {
        return $this->actividad_originada;
    }

    //-------------------------------------------------------------------------------------------//
}