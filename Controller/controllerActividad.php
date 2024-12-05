<?php

ini_set('session.cache_limiter','public');
session_cache_limiter(false);
require_once("../Model/actividad.php");

$option=$_REQUEST['option'];
switch($option){

    case 'guardar':
        date_default_timezone_set('America/Caracas');
        $actividad=new actividad();
        $codigo_actividad=$_REQUEST['codigo_actividad'];
        $nombre_actividad=$_REQUEST['nombre_actividad'];
        $id_tipo_actividad=$_REQUEST['id_tipo_actividad'];
        $dep_receptor=$_REQUEST['dep_receptor'];
        $dep_emisor=$_REQUEST['dep_emisor'];
        $fecha_inicio=$_REQUEST['fecha_inicio'];
        $observacion=$_REQUEST['observacion'];
        $nom_atendido=$_REQUEST['nom_atendido'];
        $ape_atendido=$_REQUEST['ape_atendido'];
        $ced_atendido=$_REQUEST['ced_atendido'];
        $id_usuario_responsable=$_REQUEST['id_usuario_responsable'];
        $actividad->setCodigo($codigo_actividad);
        $actividad->setNombre(strtoupper($nombre_actividad));
        $actividad->setIdTipo($id_tipo_actividad);
        $actividad->setDepReceptor($dep_receptor);
        $actividad->setDepEmisor($dep_emisor);
        $actividad->setfechaRegistro(date("Y-m-d H:i:s"));
        $actividad->setObservacion($observacion);
        $actividad->setEstadoActividad(1);
        $actividad->setNomAtendido(strtoupper($nom_atendido));
        $actividad->setApeAtendido(strtoupper($ape_atendido));
        $actividad->setCedAtendido($ced_atendido);
        $actividad->setIdUsuario($id_usuario_responsable);
        $actividad->setUltimaModificacion(date("Y-m-d H:i:s"));
        $actividad->setFechaInicio($fecha_inicio);
        $resultado=$actividad->guardar();

    case 'aceptarPeticion':
        date_default_timezone_set('America/Caracas');
        $actividad=new actividad();
        $codigo_actividad=$_REQUEST['codigo_actividad'];
        $nombre_actividad=$_REQUEST['nombre_actividad'];
        $id_tipo_actividad=$_REQUEST['id_tipo_actividad'];
        $dep_receptor=$_REQUEST['dep_receptor'];
        $dep_emisor=$_REQUEST['dep_emisor'];
        $observacion=$_REQUEST['observacion'];
        $fecha_inicio=$_REQUEST['fecha_inicio'];
        $nom_atendido=$_REQUEST['nom_atendido'];
        $ape_atendido=$_REQUEST['ape_atendido'];
        $ced_atendido=$_REQUEST['ced_atendido'];
        $id_usuario_responsable=$_REQUEST['id_usuario_responsable'];
        $actividad->setEstadoActividad(1);
        $actividad->setCodigo($codigo_actividad);
        $actividad->setNombre(strtoupper($nombre_actividad));
        $actividad->setIdTipo($id_tipo_actividad);
        $actividad->setDepReceptor($dep_receptor);
        $actividad->setDepEmisor($dep_emisor);
        $actividad->setfechaRegistro(date("Y-m-d H:i:s"));
        $actividad->setObservacion($observacion);
        $actividad->setNomAtendido(strtoupper($nom_atendido));
        $actividad->setApeAtendido(strtoupper($ape_atendido));
        $actividad->setCedAtendido($ced_atendido);
        $actividad->setIdUsuario($id_usuario_responsable);
        $actividad->setUltimaModificacion(date("Y-m-d H:i:s"));
        $actividad->setFechaInicio($fecha_inicio);
        $resultado=$actividad->guardar();
        if($resultado){
            $resultado=json_encode($resultado);
            echo $resultado;
        }
    break;


    case 'obtener':
        $actividad=new actividad();

        if(isset($_REQUEST['nombre_actividad'])){
            $actividad->setNombre($_REQUEST['nombre_actividad']);
        }
        if(isset($_REQUEST['codigo_actividad'])){
            $actividad->setCodigo($_REQUEST['codigo_actividad']);
        }
        if(isset($_REQUEST['estado_actividad'])){
            $actividad->setEstadoActividad($_REQUEST['estado_actividad']);
        }
        if(isset($_REQUEST['fecha_registro'])){
            $actividad->setfechaRegistro($_REQUEST['fecha_registro']);
        }
        if(isset($_REQUEST['id_usuario_responsable'])){
            $actividad->setIdUsuario($_REQUEST['id_usuario_responsable']);
        }
        if(isset($_REQUEST['day'])){
            $actividad->setDay($_REQUEST['day']);
        }
        if(isset($_REQUEST['month'])){
            $actividad->setMonth($_REQUEST['month']);
        }
        if(isset($_REQUEST['year'])){
            $actividad->setYear($_REQUEST['year']);
        }
        if(isset($_REQUEST['todas'])){
            $todas=true;
        }else{
            $todas=false;
        }
        //-----------------paginacion
        if((isset($_REQUEST['pagina']))&&(isset($_REQUEST['num_resultados']))){
            $pagina=$_REQUEST['pagina'];//Pagina actual en la paginacion
            $num_resultados=$_REQUEST['num_resultados'];
        }else{
            $pagina=false;
            $num_resultados=false;
        }
        //-----------------paginacion
        $resultado=$actividad->obtener($pagina,$num_resultados,$todas);

        $resultado=json_encode($resultado);
        echo $resultado;
    break;

    case 'eliminar':
        $codigo_actividad=$_REQUEST['codigo_actividad'];
        $actividad=new actividad();
        $actividad->setCodigo($codigo_actividad);
        $resultado=$actividad->eliminar();
        echo $resultado;
        json_encode($resultado);
    break;

    case 'modificar':
        $actividad=new actividad();
        $observacion=$_REQUEST['observacion'];
        $codigo_actividad=$_REQUEST['codigo_actividad'];
        $informe=$_REQUEST['informe'];
        $estado=$_REQUEST['estado'];
        if(isset($_FILES['evidencia']) && $_FILES['evidencia']['error'] == UPLOAD_ERR_OK){
            $fileType = mime_content_type($_FILES['evidencia']['tmp_name']);
            
            // Verificar si el tipo de archivo es PDF
            if (($fileType === 'image/png')||($fileType === 'image/jpg')||$fileType === 'image/jpeg') {
                $nombre_file=$_FILES["evidencia"]['name'];
                $tipo_file=$_FILES["evidencia"]["type"];
                $file_size=$_FILES["evidencia"]["size"];
                //Ruta de destino donde se guardara el archivo en el servidor
                $ruta_destino=$_SERVER['DOCUMENT_ROOT'].'/sca_cdce/uploads/';
                //mover la imagen a la carpeta de destino
                move_uploaded_file($_FILES['evidencia']['tmp_name'],$ruta_destino.$nombre_file);
                $actividad->setEvidencia(($nombre_file));
            }
            
            else {
                header("location:../View/error_subir_archivo.php");
                exit();
            }
        }

        $actividad->setCodigo($codigo_actividad);
        $actividad->setEstadoActividad(strtoupper($estado));
        $actividad->setObservacion(strtoupper($observacion));
        $actividad->setInforme(strtoupper($informe));
        $resultado=$actividad->modificar();

        if($resultado){
            header("location:../View/actividades-registradas.php");
            exit();
        }
    break;

    case 'obtenerRegistrosModificacion':
        
        $actividad=new actividad();
        $actividad->setCodigo($_REQUEST['codigo_actividad']);
        //-----------------paginacion
        if((isset($_REQUEST['pagina']))&&(isset($_REQUEST['num_resultados']))){
            $pagina=$_REQUEST['pagina'];//Pagina actual en la paginacion
            $num_resultados=$_REQUEST['num_resultados'];
        }else{
            $pagina=false;
            $num_resultados=false;
        }
        //-----------------paginacion
        $resultado=$actividad->obtenerSeguimientoActividad($pagina,$num_resultados);

        $resultado=json_encode($resultado);
        echo $resultado;
    break;

    case 'contarRegistros':
        $actividad=new actividad();

        if(isset($_REQUEST['nombre_actividad'])){
            $actividad->setNombre($_REQUEST['nombre_actividad']);
        }
        if(isset($_REQUEST['codigo_actividad'])){
            $actividad->setCodigo($_REQUEST['codigo_actividad']);
        }
        if(isset($_REQUEST['estado_actividad'])){
            $actividad->setEstadoActividad($_REQUEST['estado_actividad']);
        }
        if(isset($_REQUEST['fecha_registro'])){
            $actividad->setfechaRegistro($_REQUEST['fecha_registro']);
        }
        if(isset($_REQUEST['id_usuario_responsable'])){
            $actividad->setIdUsuario($_REQUEST['id_usuario_responsable']);
        }
        if(isset($_REQUEST['day'])){
            $actividad->setDay($_REQUEST['day']);
        }
        if(isset($_REQUEST['month'])){
            $actividad->setMonth($_REQUEST['month']);
        }
        if(isset($_REQUEST['year'])){
            $actividad->setYear($_REQUEST['year']);
        }
        if(isset($_REQUEST['todas'])){
            $todas=true;
        }else{
            $todas=false;
        }
        $resultado=$actividad->contarNumRegistros($todas);

        if($resultado){
            $resultado=json_encode($resultado);
            echo $resultado;
        }else{
            echo $resultado;
        }
    break;

    case 'exportarExcel':
        $actividad=new actividad();
        
        //SE UTILIZAN LOS SET
        if(isset($_REQUEST['nombre_actividad'])){
            $actividad->setNombre($_REQUEST['nombre_actividad']);
        }
        if(isset($_REQUEST['codigo_actividad'])){
            $actividad->setCodigo($_REQUEST['codigo_actividad']);
        }
        if(isset($_REQUEST['estado_actividad'])){
            $actividad->setEstadoActividad($_REQUEST['estado_actividad']);
        }
        if(isset($_REQUEST['fecha_registro'])){
            $actividad->setfechaRegistro($_REQUEST['fecha_registro']);
        }
        if(isset($_REQUEST['id_usuario_sesion'])){
            $actividad->setIdUsuario($_REQUEST['id_usuario_sesion']);
        }
        if(isset($_REQUEST['dep_emisor'])){
            $actividad->setDepEmisor($_REQUEST['dep_emisor']);
        }
        if(isset($_REQUEST['dep_receptor'])){
            $actividad->setDepReceptor($_REQUEST['dep_receptor']);
        }
        if(isset($_REQUEST['day'])){
            $actividad->setDay($_REQUEST['day']);
        }
        if(isset($_REQUEST['month'])){
            $actividad->setMonth($_REQUEST['month']);
        }
        if(isset($_REQUEST['year'])){
            $actividad->setYear($_REQUEST['year']);
        }

        if(isset($_REQUEST['id_usuario_sesion'])){
            $id_usuario=$_REQUEST['id_usuario_sesion'];
        }

        $todas=false;

        if(isset($_REQUEST['todas'])){
            $todas=true;
        }

        $consulta=$actividad->obtener(false,false,$todas);
        $actividad->exportExcel($consulta,$todas);

    break;
    
    case 'exportarPDF':
        $actividad=new actividad();
        
        //SE REALIZA LA CONSULTA SQL Y SE RECIBE SU RESULTADO EN UNA VARIABLE LLAMADA RESULTADO
        if(isset($_REQUEST['nombre_actividad'])){
            $actividad->setNombre($_REQUEST['nombre_actividad']);
        }
        if(isset($_REQUEST['codigo_actividad'])){
            $actividad->setCodigo($_REQUEST['codigo_actividad']);
        }
        if(isset($_REQUEST['estado_actividad'])){
            $actividad->setEstadoActividad($_REQUEST['estado_actividad']);
        }
        if(isset($_REQUEST['fecha_registro'])){
            $actividad->setfechaRegistro($_REQUEST['fecha_registro']);
        }
        if(isset($_REQUEST['id_usuario_sesion'])){
            $actividad->setIdUsuario($_REQUEST['id_usuario_sesion']);
        }
        if(isset($_REQUEST['dep_emisor'])){
            $actividad->setDepEmisor($_REQUEST['dep_emisor']);
        }
        if(isset($_REQUEST['dep_receptor'])){
            $actividad->setDepReceptor($_REQUEST['dep_receptor']);
        }
        if(isset($_REQUEST['day'])){
            $actividad->setDay($_REQUEST['day']);
        }
        if(isset($_REQUEST['month'])){
            $actividad->setMonth($_REQUEST['month']);
        }
        if(isset($_REQUEST['year'])){
            $actividad->setYear($_REQUEST['year']);
        }
        if(isset($_REQUEST['todas'])){
            $todas=true;
        }else{
            $todas=false;
        }
        $resultado=$actividad->obtener(false,false,$todas);
        $actividad->exportPDF($resultado);

    break;

    
    
    case 'exportarDetalles':
        $actividad=new actividad();
        $actividad->setCodigo($_REQUEST['codigo_actividad']);
        $resultado=$actividad->obtener();
        $actividad->exportDetalles($resultado);

    break;
}

?>