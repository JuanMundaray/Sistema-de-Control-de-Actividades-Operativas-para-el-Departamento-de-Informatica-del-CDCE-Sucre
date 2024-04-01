<?php

require_once("../Model/tipo_actividad.php");

$option=$_REQUEST['option'];
switch($option){

    case 'crear':
        $tipo_actividad=new tipo_actividad();
        $nombre_tipo=$_REQUEST['nombre_tipo'];
        $tipo_actividad->setNombre_tipo(strtoupper($nombre_tipo));
        $resultado=$tipo_actividad->crear();
        if($resultado){
            header("location:../View/actividades-registradas.php");
            exit();
        }
    break;


    case 'obtener':
        $tipo_actividad=new tipo_actividad();
        if(isset($_REQUEST['pagina'])){
            //-----------------paginacion
            $pagina=$_REQUEST['pagina'];//Pagina actual en la paginacion
            $num_resultados=$_REQUEST['num_resultados'];
            //-----------------paginacion
            $resultado=$tipo_actividad->obtener($pagina,$num_resultados);
        }
        else{
            $resultado=$tipo_actividad->obtener();
        }
        if($resultado){
            $resultado=json_encode($resultado);
            echo $resultado;
        }
    break;
    case 'buscar':
        $data_busq=$_REQUEST['data_busq'];
        $tipo_actividad=new tipo_actividad();
        $tipo_actividad->setNombre_tipo(strtoupper($data_busq));
        $resultado=$tipo_actividad->buscar();
        $resultado=json_encode($resultado);
        echo $resultado;
    break;

    case 'contarRegistros':
        $tipo_actividad=new tipo_actividad();

        if((isset($_REQUEST['data_busq']))&&(isset($_REQUEST['parametro_busq']))){
            //resultado sera todos los registros de la tabla segun la condicion en el where
            $data_busq=$_REQUEST['data_busq'];
            $parametro_busq=$_REQUEST['parametro_busq'];
            $resultado=$tipo_actividad->getNumRegistros($parametro_busq,$data_busq);
        }
        else{//resultado sera todos los registros de la tabla
            $resultado=$tipo_actividad->getNumRegistros();
        }
        
        if($resultado){
            $resultado=json_encode($resultado);
            echo $resultado;
        }
    break;
        

}

?>