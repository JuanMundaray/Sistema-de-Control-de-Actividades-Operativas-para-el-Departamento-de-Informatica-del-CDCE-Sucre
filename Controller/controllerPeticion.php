<?php

require_once("../Model/peticion.php");

$option=$_REQUEST['option'];
switch($option){

    case 'crear_peticion':
        date_default_timezone_set('America/Caracas');
        $peticion=new peticion();
        $id_usuario=$_REQUEST['id_usuario'];
        $nombre_peticion=$_REQUEST['nombre_peticion'];
        $departamento_peticion=$_REQUEST['departamento_peticion'];
        $detalles_peticion=$_REQUEST['detalles_peticion'];
        $tipo_actividad=$_REQUEST['tipo_actividad'];
        $peticion->setNombrePeticion(strtoupper($nombre_peticion));
        $peticion->setIdUsuario($id_usuario);
        $peticion->setDepartamentoPeticion($departamento_peticion);
        $peticion->setDetallesPeticion($detalles_peticion);
        $peticion->setTipoActividad($tipo_actividad);
        $peticion->setEstadoPeticion(1);
        $peticion->setFechaPeticion(date("Y-m-d"));
        $resultado=$peticion->guardar();
        if($resultado){
            header("location:../View/peticiones-registradas.php");
            exit();
        }
    break;

    case 'obtener':
        $peticion=new peticion();

        if(isset($_REQUEST['id_usuario'])){
            $peticion->setIdUsuario($_REQUEST['id_usuario']);
        }
        if(isset($_REQUEST['id_peticion'])){
            $peticion->setIdPeticion($_REQUEST['id_peticion']);
        }
        if(isset($_REQUEST['nombre_peticion'])){
            $peticion->setNombrePeticion($_REQUEST['nombre_peticion']);
        }
        if(isset($_REQUEST['departamento_peticion'])){
            $peticion->setDepartamentoPeticion($_REQUEST['departamento_peticion']);
        }
        if(isset($_REQUEST['fecha_peticion'])){
            $peticion->setFechaPeticion($_REQUEST['fecha_peticion']);
        }
        if(isset($_REQUEST['estado_peticion'])){
            $peticion->setEstadoPeticion($_REQUEST['estado_peticion']);
        }
        if(isset($_REQUEST['day'])){
            $peticion->setDay($_REQUEST['day']);
        }
        if(isset($_REQUEST['month'])){
            $peticion->setMonth($_REQUEST['month']);
        }
        if(isset($_REQUEST['year'])){
            $peticion->setYear($_REQUEST['year']);
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
        $resultado=$peticion->obtener($pagina,$num_resultados);
        
        $resultado=json_encode($resultado);
        echo $resultado;
    break;

    case 'contarRegistros':
        $peticion=new peticion();

        if(isset($_REQUEST['id_usuario'])){
            $peticion->setIdUsuario($_REQUEST['id_usuario']);
        }
        if(isset($_REQUEST['id_peticion'])){
            $peticion->setIdPeticion($_REQUEST['id_peticion']);
        }
        if(isset($_REQUEST['nombre_peticion'])){
            $peticion->setNombrePeticion($_REQUEST['nombre_peticion']);
        }
        if(isset($_REQUEST['departamento_peticion'])){
            $peticion->setDepartamentoPeticion($_REQUEST['departamento_peticion']);
        }
        if(isset($_REQUEST['fecha_peticion'])){
            $peticion->setFechaPeticion($_REQUEST['fecha_peticion']);
        }
        if(isset($_REQUEST['estado_peticion'])){
            $peticion->setEstadoPeticion($_REQUEST['estado_peticion']);
        }
        if(isset($_REQUEST['todas'])){
            $todas=true;
        }else{
            $todas=false;
        }
        $resultado=$peticion->contarNumRegistros($todas);

        if($resultado){
            $resultado=json_encode($resultado);
            echo $resultado;
        }else{
            echo $resultado;
        }
    break;

    case 'exportarExcel':
        $peticion=new peticion();

        if(isset($_REQUEST['departamento_peticion'])){
            $peticion->setDepartamentoPeticion($_REQUEST['departamento_peticion']);
        }
        if(isset($_REQUEST['fecha_peticion'])){
            $peticion->setFechaPeticion($_REQUEST['fecha_peticion']);
        }
        if(isset($_REQUEST['estado_peticion'])){
            $peticion->setEstadoPeticion($_REQUEST['estado_peticion']);
        }
        if(isset($_REQUEST['day'])){
            $peticion->setDay($_REQUEST['day']);
        }
        if(isset($_REQUEST['month'])){
            $peticion->setMonth($_REQUEST['month']);
        }
        if(isset($_REQUEST['year'])){
            $peticion->setYear($_REQUEST['year']);
        }

        $peticion->exportarExcel();
        
    break;

    case 'exportarPDF':
        $peticion=new peticion();

        if(isset($_REQUEST['departamento_peticion'])){
            $peticion->setDepartamentoPeticion($_REQUEST['departamento_peticion']);
        }
        if(isset($_REQUEST['fecha_peticion'])){
            $peticion->setFechaPeticion($_REQUEST['fecha_peticion']);
        }
        if(isset($_REQUEST['estado_peticion'])){
            $peticion->setEstadoPeticion($_REQUEST['estado_peticion']);
        }
        if(isset($_REQUEST['day'])){
            $peticion->setDay($_REQUEST['day']);
        }
        if(isset($_REQUEST['month'])){
            $peticion->setMonth($_REQUEST['month']);
        }
        if(isset($_REQUEST['year'])){
            $peticion->setYear($_REQUEST['year']);
        }
        $resultado=$peticion->obtener();
        $peticion->exportarPDF($resultado);
        
    break;

    case 'rechazar':
        $id_peticion=$_REQUEST['id_peticion'];
        $peticion=new peticion();
        $peticion->setIdPeticion($id_peticion);
        $resultado=$peticion->rechazar();
        echo $resultado;
    break;

    case 'eliminar':
        $id_peticion=$_REQUEST['id_peticion'];
        $peticion=new peticion();
        $peticion->setIdPeticion($id_peticion);
        $resultado=$peticion->eliminar();
        echo $resultado;
    break;

    case 'aceptar':
        $id_peticion=$_REQUEST['id_peticion'];
        $actividad_originada=$_REQUEST['actividad_originada'];
        $peticion=new peticion();
        $peticion->setIdPeticion($id_peticion);
        $peticion->setActividadOriginada($actividad_originada);
        $resultado=$peticion->aceptar();
        echo $resultado;
    break;

}

?>