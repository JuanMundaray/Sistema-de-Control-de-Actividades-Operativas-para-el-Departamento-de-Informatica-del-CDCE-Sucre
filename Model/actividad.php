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
            ":id_usuario_responsable"=>$id_usuario_responsable,
            ":evidencia"=>$evidencia,
            ":informe"=>$informe));

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
            $db = DataBase::getInstance();

            //modificacion de la actividad
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

    public function ObtenerActividades($pagina=false,$num_resultados=false,$todas=false)
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

            $db = DataBase::getInstance();  
            $orden=$this->orden;       
            $consulta = "SELECT *
            FROM actividades.actividad
            LEFT JOIN actividades.tipo_actividad
            ON actividad.id_tipo_actividad=tipo_actividad.id_tipo
            LEFT JOIN actividades.usuario
            ON actividad.id_usuario_responsable=usuario.id_usuario
            LEFT JOIN actividades.estado_actividad
            ON actividad.estado_actividad=estado_actividad.id_estado_actividad
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
                $consulta .=" AND estado_actividad<>5";
            }

            if(!empty($dep_emisor)){
                $consulta .=" AND dep_emisor='$dep_emisor'";
            }

            if(!empty($dep_receptor)){
                $consulta .=" AND dep_receptor='$dep_receptor'";
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
    public function ObtenerSeguimientoActividad($pagina=false,$num_resultados=false,$todas=false)
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
        $resultado = false;
        try{
            $db = DataBase::getInstance(); 
            $estado_actividad=$this->estado_actividad; 
            $consulta = "SELECT *
            FROM actividades.actividad WHERE estado_actividad<>5";


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

            if(!empty($dep_emisor)){
                $consulta .=" AND dep_emisor=$dep_emisor";
            }

            if(!empty($dep_receptor)){
                $consulta .=" AND dep_receptor=$dep_receptor";
            }

            if($todas==false){
                $consulta .=" AND estado_actividad<>5";
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
    public function exportExcel($id_usuario=false,$todas=false){
        
        require '../Plugins/yunho-dbexport-master/src/YunhoDBExport.php';
        require_once("../Model/configurarBD.php");
          date_default_timezone_set('America/Caracas');

        $codigo_actividad = $this->codigo_actividad;
        $nombre_actividad = $this->nombre_actividad;
        $fecha_registro=$this->fecha_registro;
        $estado_actividad=$this->estado_actividad;
        $id_usuario_responsable = $this->id_usuario_responsable;
        $dep_emisor = $this->dep_emisor;
        $dep_receptor = $this->dep_receptor;

        $export=new YunhoDBExport(SERVIDOR,BD,USUARIO,CLAVE);
        
        $export->connect();

        $nombre_archivo='ACTIVIDADES REGISTRADAS';

        $campos=array(
            'codigo_actividad'=>'Codigo Actividad',
            'nombre_actividad'=>'Nombre de Actividad',
            'fecha_registro'=>'Fecha de Registro',
            'nombre_tipo'=>'Tipo de Actividad',
            'dep_emisor'=>'Departamento Emisor',
            'dep_receptor'=>'Departamento Receptor',
            'nom_atendido'=>'Nombre del Funcionario Atendido',
            'ape_atendido'=>'Apellido del Funcionario Atendido',
            'ced_atendido'=>'Cedula del Funcionario Atendido',
            'nombre_personal'=>'Nombre del Responsable de la Actividad',
            'apellido_personal'=>'Apellido del Responsable de la Actividad',
            'cedula'=>'Cedula del Responsable de la Actividad',
            'nombre_estado_actividad'=>'Estado'
        );
        $consulta="SELECT * FROM actividades.actividad
        INNER JOIN actividades.tipo_actividad
        ON actividad.id_tipo_actividad=tipo_actividad.id_tipo
        LEFT JOIN actividades.usuario
        ON actividad.id_usuario_responsable=usuario.id_usuario
        LEFT JOIN actividades.estado_actividad
        ON actividad.estado_actividad=estado_actividad.id_estado_actividad
        WHERE 1=1";
        
        if($id_usuario_responsable!=false){
            $consulta .=" AND id_usuario_responsable=$id_usuario_responsable";
            $nombre_archivo='MIS ACTIVIDADES REGISTRADAS';
        }

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
            $consulta .=" AND estado_actividad=$estado_actividad";
        }

        if($todas==false){
            $consulta .=" AND estado_actividad<>5";
        }

        if(!empty($dep_emisor)){
            $consulta .=" AND dep_emisor='$dep_emisor'";
        }

        if(!empty($dep_receptor)){
            $consulta .=" AND dep_receptor='$dep_receptor'";
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

    public function exportPDF($data_sql){
        
        require('../Plugins/fpdf186/fpdf.php');
        $pdf = new FPDF('P','mm',array(400,400));
        $pdf->AddPage();
        //titulo
        $pdf->SetFont('Arial','UB',26);
        $pdf->Cell(0,20,'Reporte Generado '.date("Y-m-d"),0,0);
        $pdf->Ln();
        //nombres de columnas de la tabla
        $pdf->SetFont('Arial','B',7);
        $pdf->Cell(60,7,'Codigo de Actividad',1,0,'C');
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
            $pdf->Cell(60,$font_size_fila,utf8_decode($fila['codigo_actividad']),1);
            $pdf->Cell(80,$font_size_fila,utf8_decode($fila['nombre_actividad']),1);
            $pdf->Cell(25,$font_size_fila,utf8_decode($fila['fecha_registro']),1);
            $pdf->Cell(25,$font_size_fila,utf8_decode($fila['nombre_estado_actividad']),1);
            $pdf->Cell(60,$font_size_fila,utf8_decode($fila['nombre_personal']).' '.$fila['apellido_personal'],1);
            $pdf->Cell(60,$font_size_fila,utf8_decode($fila['dep_receptor']),1);
            $pdf->Cell(60,$font_size_fila,utf8_decode($fila['dep_emisor']),1);
        }
        $pdf->Output('','Tabla de Actividades Registradas',true);
    }
    public function exportDetalles($actividad){
        
        require('../Plugins/fpdf186/fpdf.php');
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetMargins(20,30,20);
        //titulo
        $pdf->SetFont('Arial','UB',16);
        $pdf->Cell(200,20,'Detalles de Actividad ',0,0,'C');
        $pdf->Ln();

        //Celda de Codigo Actividad
        $pdf->SetFont('Arial','BU',10);
        $pdf->Cell(0,7,'Codigo de Actividad:',0,1,'L');
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(0,7,utf8_decode($actividad[0]['codigo_actividad']),0,1,'L');$pdf->Ln();

        //Celda de Nombre Actividad
        $pdf->SetFont('Arial','BU',10);
        $pdf->Cell(0,7,'Nombre de Actividad:',0,1,'L');
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(0,7,utf8_decode($actividad[0]['nombre_actividad']),0,1,'L'); $pdf->Ln();

        //Celda de Fecha de Registro
        $pdf->SetFont('Arial','BU',10);
        $pdf->Cell(0,7,'Fecha de Registro:',0,1,'L'); 
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(0,7,utf8_decode($actividad[0]['fecha_registro']),0,1,'L'); $pdf->Ln();

        //Celda de Departamento Emisor
        $pdf->SetFont('Arial','BU',10);
        $pdf->Cell(0,7,'Departameto Emisor:',0,1,'L');
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(0,7,utf8_decode($actividad[0]['dep_emisor']),0,1,'L');$pdf->Ln();

        //Celda de Departameto Receptor
        $pdf->SetFont('Arial','BU',10);
        $pdf->Cell(0,7,'Departameto Receptor:',0,1,'L');
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(0,7,utf8_decode($actividad[0]['dep_receptor']),0,1,'L');$pdf->Ln();

        //Celda de Estado de Actividad
        $pdf->SetFont('Arial','BU',10);
        $pdf->Cell(0,7,'Estado de Actividad:',0,1,'L');
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(0,7,utf8_decode($actividad[0]['nombre_estado_actividad']),0,1,'L');$pdf->Ln();

        //Celda de Tipo de Actividad
        $pdf->SetFont('Arial','BU',10);
        $pdf->Cell(0,7,'Tipo de Actividad:',0,1,'L');
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(0,7,utf8_decode($actividad[0]['nombre_tipo']),0,1,'L');$pdf->Ln();
        
        //Celda de Nombre y Apellido del Responsable
        $pdf->SetFont('Arial','BU',10);
        $pdf->Cell(0,7,'Nombre y Apellido del Responsable:',0,1,'L');
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(0,7,utf8_decode($actividad[0]['nombre_personal']).' '.$actividad[0]['apellido_personal'],0,1,'L');$pdf->Ln();

        //Celda de Nombre y Apellido del Atendido
        $pdf->SetFont('Arial','BU',10);
        $pdf->Cell(0,7,'Nombre y Apellido del Atendido:',0,1,'L');
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(0,7,utf8_decode($actividad[0]['nom_atendido']).' '.$actividad[0]['ape_atendido'],0,1,'L');$pdf->Ln();

        if($actividad[0]['observacion']!=''){
            $pdf->SetFont('Arial','BU',10);
            $pdf->Cell(0,7,'Observacion de Actividad:',0,1,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->MultiCell(0,7,utf8_decode($actividad[0]['observacion']),0,'J');$pdf->Ln();
        }

        if($actividad[0]['informe']!=''){
            $pdf->SetFont('Arial','BU',10);
            $pdf->Cell(0,7,'Informe de Actividad:',0,1,'L');
            $pdf->SetFont('Arial','B',10);
            $pdf->MultiCell(0,7,utf8_decode($actividad[0]['informe']),0,'J');$pdf->Ln();
        }

        if($actividad[0]['evidencia']!=''){
            $pdf->AddPage();
            $pdf->SetFont('Arial','BU',10);
            $pdf->Cell(0,7,'Evidencia de Completacion:',0,1,'L');
            $pdf->Image('../uploads/'.utf8_decode($actividad[0]['evidencia']),null,null,100,100);$pdf->Ln();
            $pdf->Ln();
        }
        $pdf->Output('','SCA_CDCE:REPORTE DE ACTIVIDAD '.$actividad[0]['codigo_actividad'],true);
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