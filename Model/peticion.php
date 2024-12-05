<?php
require_once('DataBase.php');
class peticion{
    private $id_peticion;
    private $id_usuario;
    private $nombre_peticion;
    private $departamento_peticion;
    private $detalles_peticion;
    private $fecha_registro;
    private $tipo_actividad;
    private $estado_peticion;
    private $actividad_originada;
    private $day;
    private $month;
    private $year;
    private $orden='DESC';

    
    public function guardar()
    {
        $resultado = false;
        try{
            $id_usuario = $this->id_usuario;
            $nombre_peticion = $this->nombre_peticion;
            $departamento_peticion = $this->departamento_peticion;
            $detalles_peticion = $this->detalles_peticion;
            $fecha_registro = $this->fecha_registro;
            $tipo_actividad=$this->tipo_actividad;
            $estado_peticion=$this->estado_peticion;
            $db = DataBase::getInstance();
            $consulta = "INSERT INTO actividades.peticiones(
            id_usuario,
            nombre_peticion,
            departamento_peticion,
            detalles_peticion,
            fecha_registro,
            tipo_actividad,
            estado_peticion)
            VALUES (
            :id_usuario,
            :nombre_peticion,
            :departamento_peticion,
            :detalles_peticion,
            :fecha_registro,
            :tipo_actividad,
            :estado_peticion)";
            
            $resultadoPDO = $db->prepare($consulta);
            $resultadoPDO->execute(array(
            ":id_usuario"=>$id_usuario,
            ":nombre_peticion"=>$nombre_peticion,
            ":departamento_peticion"=>$departamento_peticion,
            ":detalles_peticion"=>$detalles_peticion,
            ":fecha_registro"=>$fecha_registro,
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
            $fecha_registro = $this->fecha_registro;
            $estado_peticion=$this->estado_peticion;
            $day = $this->day;
            $month = $this->month;
            $year = $this->year;
            
            $db = DataBase::getInstance();

            $consulta="SELECT 
            peticiones.id_peticion, 
            peticiones.nombre_peticion, 
            peticiones.departamento_peticion, 
            peticiones.detalles_peticion, 
            TO_CHAR(peticiones.fecha_registro,'DD-MM-YYYY') AS fecha_registro, 
            peticiones.id_usuario, 
            peticiones.actividad_originada, 
            estado_peticion.nombre_estado_peticion,
            departamentos.nombre_departamento,
            tipo_actividad.nombre_tipo,
            usuario.id_usuario,
            usuario.nombre_personal,
            usuario.cedula,
            usuario.apellido_personal,
            usuario.nombre_usuario,
            actividad.estado_actividad
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

            if(!empty($fecha_registro)){
                $consulta .=" AND peticiones.fecha_registro='$fecha_registro'";
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

            if(!empty($day)){
                $consulta .=" AND EXTRACT(DAY FROM peticiones.fecha_registro)='$day'";
            }
    
            if(!empty($month)){
                $consulta .=" AND EXTRACT(MONTH FROM peticiones.fecha_registro)='$month'";
            }
    
            if(!empty($year)){
                $consulta .=" AND EXTRACT(YEAR FROM peticiones.fecha_registro)='$year'";
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
            $fecha_registro = $this->fecha_registro;
            $estado_peticion=$this->estado_peticion;
            $day = $this->day;
            $month = $this->month;
            $year = $this->year;
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

            if(!empty($fecha_registro)){
                $consulta .=" AND peticiones.fecha_registro='$fecha_registro'";
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

            if(!empty($day)){
                $consulta .=" AND EXTRACT(DAY FROM peticiones.fecha_registro)='$day'";
            }
    
            if(!empty($month)){
                $consulta .=" AND EXTRACT(MONTH FROM peticiones.fecha_registro)='$month'";
            }
    
            if(!empty($year)){
                $consulta .=" AND EXTRACT(YEAR FROM peticiones.fecha_registro)='$year'";
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

    public function exportarExcel($consulta){
        $salida=utf8_decode('
        <table>
            <tbody>
                <tr>
                </tr>
                <tr>
                    <th colspan=7>
                        <h2>TABLA DE PETICIONES REGISTRADAS- REPORTE GENERADO '.date('Y-m-d').'</h2>
                    </th>
                </tr>
                
                <tr>
                    <th colspan=7>Ministerio del Poder Popular para la Educación</th>
                </tr>

                <tr>
                    <th colspan=7>Centro de Desarrollo de Calidad Educativa</th>
                </tr>

                <tr>
                    <th colspan=7>Cumaná - Municipio Sucre - Estado Sucre</th>
                </tr><tr></tr>
                <tr>
                </tr>
                <tr>
                </tr>
                <tr style="text-align: center; font-weight: bold;">
                    <td>Id de Petición</td>
                    <td>Nombre de Petición</td>
                    <td>Departameto de Petición</td>
                    <td>Fecha de Petición</td>
                    <td>Nombre de Usuario de Petición</td>
                    <td>Estado de Peticion</td>
                </tr>');
        foreach($consulta as $data){
            $salida.='
                    <tr style="text-align: center;">
                        <td>'.$data[utf8_decode('id_peticion')].'</td>
                        <td>'.$data[utf8_decode('nombre_peticion')].'</td>
                        <td>'.$data[utf8_decode('nombre_departamento')].'</td>
                        <td>'.$data[utf8_decode('fecha_registro')].'</td>
                        <td>'.$data[utf8_decode('nombre_usuario')].'</td>
                        <td>'.$data[utf8_decode('nombre_estado_peticion')].'</td>
                    </tr>';
        }
        $salida.='
                </tbody>
            </table>
            ';
        $filename = "Tabla de Peticiones_".date('Y-m-d') . ".xls";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$filename");
        header('Pragma:no-cache');
        header('Expires:0');
        echo $salida;
    }
    public function exportarPDF($data_sql){
        
        require('../Librarys/fpdf186/fpdf.php');
        $pdf = new FPDF('P','mm',array(400,400));
        $pdf->AddPage();
        $pdf->SetMargins(25.4, 25.4, 25.4);
        // Logo
        $pdf->Image('../View/Resources/Imagenes/logo_ministerio.png', 5, 0, 100);
        $pdf->Image('../View/Resources/Imagenes/logo.jpg', 330, 0, 60);
        //Encabezado
        $pdf->SetFont('Arial','',12);
        $pdf->Ln();
        $pdf->Cell(0,6,utf8_decode('Ministerio del Poder Popular para la Educación'),0,1,'C');
        $pdf->Cell(0,6,utf8_decode('República Bolivariana de Venezuela'),0,1,'C');
        $pdf->Cell(0,6,utf8_decode('Centro de Desarrollo de Calidad Educativa'),0,1,'C');
        $pdf->Cell(0,6,utf8_decode('Cumaná - Municipio Sucre - Estado Sucre'),0,0,'C');
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
            $pdf->Cell(25,$font_size_fila,utf8_decode($fila['fecha_registro']),1,0,'C');
            $pdf->Cell(60,$font_size_fila,utf8_decode($fila['nombre_usuario']),1,0,'C');
            $pdf->Cell(60,$font_size_fila,utf8_decode($fila['nombre_estado_peticion']),1,0,'C');
        }
        // Sello y Firma
        for($i=0;$i<3;$i++){$pdf->Ln();}
        $pdf->Image('../View/Resources/firmas/firma_cdce.jpg', 160,null,90);

        $pdf->Output('I','Tabla de Peticiones Registradas',true);
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
    public function setFechaRegistro($fecha_registro)
    {
        $this->fecha_registro = trim($fecha_registro);
    }
    public function setDay($day)
    {
        $this->day = trim($day);
    }
    public function setMonth($month)
    {
        $this->month = trim($month);
    }
    public function setYear($year)
    {
        $this->year = trim($year);
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
    public function getFechaRegistro()
    {
        return $this->fecha_registro;
    }
    public function getDay($day)
    {
        return $this->day;
    }
    public function getMonth($month)
    {
        return $this->month;
    }
    public function getYear($year)
    {
        return $this->year;
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