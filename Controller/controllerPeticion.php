<?php

require_once("../Model/peticion.php");

$option=$_REQUEST['option'];
switch($option){

    case 'crear_peticion':
        date_default_timezone_set('America/Lima');
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
        $peticion->setEstadoPeticion("ESPERA");
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
        //-----------------paginacion
        $pagina=$_REQUEST['pagina'];//Pagina actual en la paginacion
        $num_resultados=$_REQUEST['num_resultados'];
        //-----------------paginacion
        $resultado=$peticion->obtener($pagina,$num_resultados);
        
        $resultado=json_encode($resultado);
        echo $resultado;
    break;

    case 'exportarExcel':
        $peticion=new peticion();
        $peticion->exportarExcel();
    break;

    case 'rechazar':
        $id_peticion=$_REQUEST['id_peticion'];
        $peticion=new peticion();
        $peticion->setIdPeticion($id_peticion);
        $resultado=$peticion->rechazar();
        echo $resultado;
    break;

}

?>