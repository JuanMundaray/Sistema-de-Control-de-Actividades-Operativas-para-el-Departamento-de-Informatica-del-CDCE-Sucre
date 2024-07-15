<?php
require_once('DataBase.php');
class actividad{
    private $codigo_actividad;
    private $nombre_actividad;
    private $dep_receptor;
    private $dep_emisor;
    private $id_tipo_actividad;
    private $fecha_registro;
    private $day;
    private $month;
    private $year;
    private $nom_atendido;
    private $ape_atendido;
    private $ced_atendido;
    private $estado_actividad;
    private $observacion;
    private $informe;
    private $evidencia;
    private $id_usuario_responsable;
    private $ultima_modificacion;
    private $orden='DESC';
    private $fecha_inicio;
    
    public function __construct()
    {
        $this->observacion="";
        $this->informe="";
        $this->evidencia="";
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
            $id_usuario_responsable = $this->id_usuario_responsable;
            $estado_actividad= $this->estado_actividad;
            $evidencia = $this->evidencia;
            $informe = $this->informe;
            $ultima_modificacion=$this->ultima_modificacion;
            $fecha_inicio=$this->fecha_inicio;
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
            id_usuario_responsable,
            evidencia,
            informe,
            estado_actividad,
            ultima_modificacion,
            fecha_inicio
            )
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
            :id_usuario_responsable,
            :evidencia,
            :informe,
            :estado_actividad,
            :ultima_modificacion,
            :fecha_inicio)";

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
            ":id_usuario_responsable"=>$id_usuario_responsable,
            ":evidencia"=>$evidencia,
            ":informe"=>$informe,
            ":estado_actividad"=>$estado_actividad,
            "ultima_modificacion"=>$ultima_modificacion,
            "fecha_inicio"=>$fecha_inicio));

            $this->registrarModificacion();
            
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
            $ultima_modificacion=date("Y-m-d H:i:s");
            $db = DataBase::getInstance();

            //modificacion de la actividad
            $consulta = "UPDATE actividades.actividad
            SET 
            estado_actividad=:estado_actividad,
            observacion=:observacion,
            informe=:informe,
            evidencia=:evidencia,
            ultima_modificacion=:ultima_modificacion
            WHERE codigo_actividad='$codigo_actividad'";

            $resultadoPDO = $db->prepare($consulta);

            $resultado=$resultadoPDO->execute(array(
            ":observacion"=>$observacion,
            ":informe"=>$informe,
            ":estado_actividad"=>$estado_actividad,
            ":evidencia"=>$evidencia,
            ":ultima_modificacion"=>$ultima_modificacion));    
            
            $this->registrarModificacion();

            $resultadoPDO->closeCursor(); 
        } 
        catch(Exception $objeto){
            $resultado = false;
            echo $objeto->getMessage();
        }
        return $resultado; 
    }

    private function registrarModificacion(){
        $resultado = false;
        try{
            $estado_actividad=$this->estado_actividad;
            $codigo_actividad=$this->codigo_actividad;
            $db = DataBase::getInstance();
            
            //obtener el nombre del estado de actividad
            $consulta = "SELECT
            nombre_estado_actividad
            FROM
            actividades.estado_actividad
            WHERE
            id_estado_actividad=$estado_actividad";

            $resultado=$db->query($consulta);
            $estado_actividad=$resultado->fetchAll();
            $estado_actividad=$estado_actividad[0]['nombre_estado_actividad'];

            //guardar registro de modificacion

            date_default_timezone_set('America/Caracas');
            $fecha_modificacion=date("Y-m-d");
            
            $hora_modificacion=date("H:i:s");
            $consulta = "INSERT INTO actividades.registro_modificaciones_actividad
            (
                codigo_actividad,
                fecha_modificacion,
                hora_modificacion,
                estado_modificado
                )
	        VALUES (
                '$codigo_actividad',
                :fecha_modificacion,
                :hora_modificacion,
                :estado_actividad
                )";

            $resultadoPDO = $db->prepare($consulta);

            $resultado=$resultadoPDO->execute(array(
            ":fecha_modificacion"=>$fecha_modificacion,
            ":hora_modificacion"=>$hora_modificacion,
            ":estado_actividad"=>$estado_actividad)); 

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
            $consulta="UPDATE actividades.actividad SET estado_actividad=5 WHERE codigo_actividad=:codigo_actividad";
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

    public function obtener($pagina=false,$num_resultados=false,$todas=false)
    {
        $resultado = false;
        try{
            $codigo_actividad = $this->codigo_actividad;
            $nombre_actividad = $this->nombre_actividad;
            $fecha_registro=$this->fecha_registro;
            $estado_actividad=$this->estado_actividad;
            $id_usuario_responsable = $this->id_usuario_responsable;
            $dep_emisor = $this->dep_emisor;
            $dep_receptor = $this->dep_receptor;
            $day = $this->day;
            $month = $this->month;
            $year = $this->year;

            $db = DataBase::getInstance();  
            $orden=$this->orden;       
            $consulta = "SELECT 
            actividad.codigo_actividad, 
            actividad.nombre_actividad, 
            TO_CHAR(actividad.fecha_registro,'DD-MM-YYYY') AS fecha_registro, 
            actividad.dep_emisor, 
            actividad.dep_receptor, 
            actividad.nom_atendido, 
            actividad.ape_atendido, 
            actividad.ced_atendido, 
            actividad.observacion, 
            actividad.id_tipo_actividad, 
            actividad.informe, 
            actividad.evidencia, 
            actividad.id_usuario_responsable, 
            actividad.estado_actividad, 
            actividad.ultima_modificacion,
            estado_actividad.nombre_estado_actividad,
            tipo_actividad.nombre_tipo,
            usuario.id_usuario, 
            usuario.nombre_usuario, 
            usuario.nombre_personal, 
            usuario.cedula, 
            usuario.tipo_usuario, 
            usuario.departamento_usuario, 
            usuario.apellido_personal,
            EXTRACT(DAY FROM fecha_registro) AS day,
            EXTRACT(MONTH FROM fecha_registro) AS month,
            EXTRACT(YEAR FROM fecha_registro) AS year
            FROM actividades.actividad
            LEFT JOIN actividades.tipo_actividad
            ON actividad.id_tipo_actividad=tipo_actividad.id_tipo
            LEFT JOIN actividades.usuario
            ON actividad.id_usuario_responsable=usuario.id_usuario
            LEFT JOIN actividades.estado_actividad
            ON actividad.estado_actividad=estado_actividad.id_estado_actividad
            WHERE 1=1";

            if(!empty($codigo_actividad)){
                $consulta .=" AND actividad.codigo_actividad='$codigo_actividad'";
            }

            if(!empty($nombre_actividad)){
                $consulta .=" AND actividad.nombre_actividad ILIKE '$nombre_actividad%'";
            }

            if(!empty($fecha_registro)){
                $consulta .=" AND actividad.fecha_registro='$fecha_registro'";
            }

            if(!empty($estado_actividad)){
                $consulta .=" AND actividad.estado_actividad='$estado_actividad'";
            }

            if(!empty($id_usuario_responsable)){
                $consulta .=" AND actividad.id_usuario_responsable=$id_usuario_responsable";
            }

            if($todas==false){
                $consulta .=" AND actividad.estado_actividad<>5";
            }

            if(!empty($dep_emisor)){
                $consulta .=" AND actividad.dep_emisor='$dep_emisor'";
            }

            if(!empty($dep_receptor)){
                $consulta .=" AND actividad.dep_receptor='$dep_receptor'";
            }

            if(!empty($day)){
                $consulta .=" AND EXTRACT(DAY FROM actividad.fecha_registro)='$day'";
            }

            if(!empty($month)){
                $consulta .=" AND EXTRACT(MONTH FROM actividad.fecha_registro)='$month'";
            }

            if(!empty($year)){
                $consulta .=" AND EXTRACT(YEAR FROM actividad.fecha_registro)='$year'";
            }

            $consulta.=" ORDER BY actividad.ultima_modificacion $orden";

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
    public function obtenerSeguimientoActividad($pagina=false,$num_resultados=false,$todas=false)
    {
        $resultado = false;
        try{
            $codigo_actividad = $this->codigo_actividad;

            $db = DataBase::getInstance();  
            $orden=$this->orden;       
            $consulta = "SELECT *
            FROM actividades.actividad 
            LEFT JOIN actividades.tipo_actividad
            ON actividad.id_tipo_actividad=tipo_actividad.id_tipo
            LEFT JOIN actividades.estado_actividad
            ON actividad.estado_actividad=estado_actividad.id_estado_actividad
            INNER JOIN
            actividades.registro_modificaciones_actividad 
            ON actividad.codigo_actividad=registro_modificaciones_actividad.codigo_actividad
            WHERE actividad.codigo_actividad='$codigo_actividad'";

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

    public function contarNumRegistros($todas)
    {
        $codigo_actividad = $this->codigo_actividad;
        $nombre_actividad = $this->nombre_actividad;
        $fecha_registro=$this->fecha_registro;
        $estado_actividad=$this->estado_actividad;
        $id_usuario_responsable = $this->id_usuario_responsable;
        $dep_emisor = $this->dep_emisor;
        $dep_receptor = $this->dep_receptor;
        $day = $this->day;
        $month = $this->month;
        $year = $this->year;
        $resultado = false;
        try{
            $db = DataBase::getInstance(); 
            $estado_actividad=$this->estado_actividad; 
            $consulta = "SELECT *
            FROM actividades.actividad WHERE estado_actividad<>5";


            if(!empty($codigo_actividad)){
                $consulta .=" AND actividad.codigo_actividad='$codigo_actividad'";
            }

            if(!empty($nombre_actividad)){
                $consulta .=" AND actividad.nombre_actividad ILIKE '$nombre_actividad%'";
            }

            if(!empty($fecha_registro)){
                $consulta .=" AND actividad.fecha_registro='$fecha_registro'";
            }

            if(!empty($estado_actividad)){
                $consulta .=" AND actividad.estado_actividad='$estado_actividad'";
            }

            if(!empty($id_usuario_responsable)){
                $consulta .=" AND actividad.id_usuario_responsable=$id_usuario_responsable";
            }

            if(!empty($dep_emisor)){
                $consulta .=" AND actividad.dep_emisor=$dep_emisor";
            }

            if(!empty($dep_receptor)){
                $consulta .=" AND actividad.dep_receptor=$dep_receptor";
            }

            if(!empty($day)){
                $consulta .=" AND EXTRACT(DAY FROM actividad.fecha_registro)='$day'";
            }

            if(!empty($month)){
                $consulta .=" AND EXTRACT(MONTH FROM actividad.fecha_registro)='$month'";
            }

            if(!empty($year)){
                $consulta .=" AND EXTRACT(YEAR FROM actividad.fecha_registro)='$year'";
            }
            
            if($todas==false){
                $consulta .=" AND actividad.estado_actividad<>5";
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

    //FUNCIONES PARA GENERAR REPORTES--------------------------------------------------------------------------
    public function exportExcel($consulta,$todas=false){
        $salida=utf8_decode('
        <table>
            <tbody>
                <tr>
                    <th colspan=7>
                        <h2>TABLA DE ACTIVIDADES REGISTRADAS- REPORTE GENERADO '.date('Y-m-d').'</h2>
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
                
                <tr style="text-align: center;">
                    <td>Codigo de Actividad</td>
                    <td>Nombre de Actividad</td>
                    <td>Fecha de Registro</td>
                    <td>Estado de Actividad</td>
                    <td>Responable del Registro</td>
                    <td>Departamento Receptor</td>
                    <td>Departamento Emisor</td>
                </tr>');
        foreach($consulta as $data){
            $salida.='
                    <tr style="text-align: center;">
                        <td>'.utf8_decode($data['codigo_actividad']).'</td>
                        <td>'.utf8_decode($data['nombre_actividad']).'</td>
                        <td>'.utf8_decode($data['fecha_registro']).'</td>
                        <td>'.utf8_decode($data['nombre_estado_actividad']).'</td>
                        <td>'.utf8_decode($data['nombre_personal']).'</td>
                        <td>'.utf8_decode($data['dep_receptor']).'</td>
                        <td>'.utf8_decode($data['dep_emisor']).'</td>
                    </tr>';
        }
        $salida.='
                </tbody>
            </table>
            ';
        $filename = "Tabla de Actividades_".date('Y-m-d') . ".xls";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=$filename");
        header('Pragma:no-cache');
        header('Expires:0');
        echo $salida;

    }

    public function exportPDF($data_sql){
        
        require('../Librarys/fpdf186/fpdf.php');
        $pdf = new FPDF('P','mm',array(400,400));
        $pdf->AddPage();
        $pdf->SetMargins(25.4, 25.4, 25.4);
        // Logo
        $pdf->Image('../View/Resources/Imagenes/logo_ministerio.png', 5, 0, 100);
        $pdf->Image('../View/Resources/Imagenes/logo.jpg', 330, 0, 60);
        //titulo
        $pdf->SetFont('Arial','',12);
        $pdf->Ln();
        $pdf->Cell(0,6,utf8_decode('Ministerio del Poder Popular para la Educación'),0,1,'C');
        $pdf->Cell(0,6,utf8_decode('República Bolivariana de Venezuela'),0,1,'C');
        $pdf->Cell(0,6,utf8_decode('Centro de Desarrollo de Calidad Educativa'),0,1,'C');
        $pdf->Cell(0,6,utf8_decode('Cumaná - Municipio Sucre - Estado Sucre'),0,0,'C');
        for($i=0;$i<3;$i++){$pdf->Ln();}
        //titulo
        $pdf->SetFont('Arial','UB',10);
        $pdf->Cell(0,20,'Reporte Generado '.date("Y-m-d"),0,0);
        $pdf->Ln();
        //nombres de columnas de la tabla
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(30,7,utf8_decode('Código de Actividad'),1,0,'C');
        $pdf->Cell(80,7,'Nombre de Actividad',1,0,'C');
        $pdf->Cell(25,7,'Fecha de Registro',1,0,'C');
        $pdf->Cell(25,7,'Estado de Actividad',1,0,'C');
        $pdf->Cell(60,7,'Responable del Registro',1,0,'C');
        $pdf->Cell(60,7,'Departamento Receptor',1,0,'C');
        $pdf->Cell(60,7,'Departamento Emisor',1,0,'C');
        $pdf->SetFont('Arial','',7);

        $font_size_fila=5;
        //Anadir datos de la tablas
        foreach($data_sql as $fila){
            $pdf->Ln();
            $pdf->Cell(30,$font_size_fila,utf8_decode($fila['codigo_actividad']),1,0,'C');
            $pdf->Cell(80,$font_size_fila,utf8_decode($fila['nombre_actividad']),1,0,'C');
            $pdf->Cell(25,$font_size_fila,utf8_decode($fila['fecha_registro']),1,0,'C');
            $pdf->Cell(25,$font_size_fila,utf8_decode($fila['nombre_estado_actividad']),1,0,'C');
            $pdf->Cell(60,$font_size_fila,utf8_decode($fila['nombre_personal']).' '.utf8_decode($fila['apellido_personal']),1,0,'C');
            $pdf->Cell(60,$font_size_fila,utf8_decode($fila['dep_receptor']),1,0,'C');
            $pdf->Cell(60,$font_size_fila,utf8_decode($fila['dep_emisor']),1,0,'C');
        }
        // Sello y Firma
        for($i=0;$i<3;$i++){$pdf->Ln();}
        $pdf->Image('../View/Resources/Imagenes/firma_sello_zona.jpg', 160,null,90);

        $pdf->Output('I','Tabla de Actividades Registradas',true);
    }
    public function exportDetalles($data_sql){
        
        require('../Librarys/fpdf186/fpdf.php');
        $pdf = new FPDF('L');
        $pdf->AddPage();
        $pdf->SetMargins(25.4, 25.4, 25.4);
        // Logo
        $pdf->Image('../View/Resources/Imagenes/logo_ministerio.png', 5, 0, 100);
        $pdf->Image('../View/Resources/Imagenes/logo.jpg', 230, 0, 60);
        //titulo
        $pdf->SetFont('Arial','',10);
        $pdf->Ln();
        $pdf->Cell(0,5,utf8_decode('Ministerio del Poder Popular para la Educación'),0,1,'C');
        $pdf->Cell(0,5,utf8_decode('República Bolivariana de Venezuela'),0,1,'C');
        $pdf->Cell(0,5,utf8_decode('Centro de Desarrollo de Calidad Educativa'),0,1,'C');
        $pdf->Cell(0,5,utf8_decode('Cumaná - Municipio Sucre - Estado Sucre'),0,0,'C');
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Ln();

        //nombres de columnas de la tabla
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(75,7,'Nombre de Actividad',1,0,'C');
        $pdf->Cell(25,7,'Fecha de Registro',1,0,'C');
        $pdf->Cell(25,7,'Estado de Actividad',1,0,'C');
        $pdf->Cell(70,7,'Departamento Receptor',1,0,'C');
        $pdf->Cell(0,7,'Departamento Emisor',1,0,'C');
        $font_size_fila=5;

        //Anadir datos de la tablas
        $pdf->SetFont('Arial','',7);
        foreach($data_sql as $fila){
            $pdf->Ln();
            $pdf->Cell(75,$font_size_fila,utf8_decode($fila['nombre_actividad']),1,0,'C');
            $pdf->Cell(25,$font_size_fila,utf8_decode($fila['fecha_registro']),1,0,'C');
            $pdf->Cell(25,$font_size_fila,utf8_decode($fila['nombre_estado_actividad']),1,0,'C');
            $pdf->Cell(70,$font_size_fila,utf8_decode($fila['dep_receptor']),1,0,'C');
            $pdf->Cell(0,$font_size_fila,utf8_decode($fila['dep_emisor']),1,0,'C');
            $pdf->Ln();
            $pdf->Ln();
        }

        if($fila['observacion']!=''){
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(0,7,'Observacion de Actividad:',1,1,'L');
            $pdf->SetFont('Arial','',7);
            $pdf->MultiCell(0,7,utf8_decode($fila['observacion']),1,'J');$pdf->Ln();
        }

        if($fila['informe']!=''){
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(0,7,'Informe de Actividad:',1,1,'L');
            $pdf->SetFont('Arial','',7);
            $pdf->MultiCell(0,7,utf8_decode($fila['informe']),1,'J');
        }
        
        // Sello y Firma
        $pdf->Image('../View/Resources/Imagenes/firma_sello_zona.jpg', 100,null,90);

        $pdf->Output('I','SCA_CDCE:REPORTE DE ACTIVIDAD '.$fila['codigo_actividad'],true);
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
    public function setUltimaModificacion($ultima_modificacion){
        $this->ultima_modificacion = trim($ultima_modificacion);
    }
    public function setFechaInicio($fecha_inicio){
        $this->fecha_inicio = trim($fecha_inicio);
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
    public function getUltimaModificaion(){
        return $this->ultima_modificacion;
    }
    public function getFechaInicio(){
        return $this->fecha_inicio;
    }
}