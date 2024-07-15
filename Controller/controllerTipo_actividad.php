<?php

require_once("../Model/tipo_actividad.php");

$option=$_REQUEST['option'];

switch($option){

    case 'crear':
        $tipo_actividad=new tipo_actividad();
        $nombre_tipo=$_REQUEST['nombre_tipo'];
        $tipo_actividad->setNombreTipo(strtoupper($nombre_tipo));
        $resultado=$tipo_actividad->crear();
    break;


    case 'obtener':
        $tipo_actividad=new tipo_actividad();

        if(isset($_REQUEST['nombre_tipo'])){
            $tipo_actividad->setNombreTipo($_REQUEST['nombre_tipo']);
        }
        if(isset($_REQUEST['id_tipo'])){
            $tipo_actividad->setIDTipo($_REQUEST['id_tipo']);
        }

        if(isset($_REQUEST['pagina'])&&(isset($_REQUEST['num_resultados']))){
            //-----------------paginacion
            $pagina=$_REQUEST['pagina'];//Pagina actual en la paginacion
            $num_resultados=$_REQUEST['num_resultados'];
            //-----------------paginacion
            $resultado=$tipo_actividad->obtener($pagina,$num_resultados);
        }

        else{
            $resultado=$tipo_actividad->obtener();
        }

        $resultado=json_encode($resultado);
        echo $resultado;
    break;

    case 'contarRegistros':

        $tipo_actividad=new tipo_actividad();

        if(isset($_REQUEST['nombre_tipo'])){
            $tipo_actividad->setNombreTipo($_REQUEST['nombre_tipo']);
        }
        if(isset($_REQUEST['id_tipo'])){
            $tipo_actividad->setIDTipo(($_REQUEST['id_tipo']));
        }

        $resultado=$tipo_actividad->contarNumRegistros();

        if($resultado){
            $resultado=json_encode($resultado);
            echo $resultado;
        }else{
            echo $resultado;
        }
}

?>