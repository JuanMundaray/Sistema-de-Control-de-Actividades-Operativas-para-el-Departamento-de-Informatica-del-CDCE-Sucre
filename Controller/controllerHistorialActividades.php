<?php

require_once("../Model/historial_actividad.php");

$option=$_REQUEST['option'];

switch($option){

    case 'obtener':
        $historial_actividad=new historial_actividad();
        //-----------------paginacion
        $pagina=$_REQUEST['pagina'];//Pagina actual en la paginacion
        $num_resultados=$_REQUEST['num_resultados'];
        //-----------------paginacion
        $resultado=$historial_actividad->getHistorial_actividades($pagina,$num_resultados);
        if($resultado){
            $resultado=json_encode($resultado);
            echo $resultado;
        }
    break;

    case 'buscar':
        $data_busq=$_REQUEST['data_busq'];
        $parametro_busq=$_REQUEST['parametro_busq'];
        $actividad=new actividad();
        
        //-----------------paginacion
        $pagina=$_REQUEST['pagina'];//Pagina actual en la paginacion
        $num_resultados=$_REQUEST['num_resultados'];
        //-----------------paginacion

        if(($parametro_busq=='fecha') || ($parametro_busq=='fecha')){
            $resultado=$actividad->buscarExacta($parametro_busq,$data_busq,$pagina,$num_resultados);
        }

        else{
            $resultado=$actividad->buscar($parametro_busq,$data_busq,$pagina,$num_resultados);
        }

        if($resultado){
            $resultado=json_encode($resultado);
            echo $resultado;
        }
    break;

    case 'buscarId':
        $data_busq=$_REQUEST['data_busq'];
        $actividad=new actividad();
        $actividad->setID($data_busq);
        $resultado=$actividad->buscarId();
        if($resultado){
            $resultado=json_encode($resultado);
            echo $resultado;
        }else{
            $resultado=json_encode($resultado);
            echo $resultado;
        }
    break;

    case 'contarRegistros':
        $historial_actividad=new historial_actividad();

        if((isset($_REQUEST['data_busq']))&&(isset($_REQUEST['parametro_busq']))){
            //resultado sera todos los registros de la tabla segun la condicion en el where
            $data_busq=$_REQUEST['data_busq'];
            $parametro_busq=$_REQUEST['parametro_busq'];
            $resultado=$historial_actividad->getNumRegistros($parametro_busq,$data_busq);
        }
        else{//resultado sera todos los registros de la tabla
            $resultado=$historial_actividad->getNumRegistros();
        }
        
        if($resultado){
            $resultado=json_encode($resultado);
            echo $resultado;
        }
    break;
}

?>