<?php

require_once("../Model/tipo_actividad.php");

$option=$_REQUEST['option'];
switch($option){

    case 'crear':
        $tipo_actividad=new tipo_actividad();
        $codigo=$_REQUEST['codigo'];
        $nombre_tipo=$_REQUEST['nombre_tipo'];
        $tipo_actividad->setCodigo_tipo($codigo);
        $tipo_actividad->setNombre_tipo(strtoupper($nombre_tipo));
        $resultado=$tipo_actividad->crear();
    break;


    case 'obtener':
        $tipo_actividad=new tipo_actividad();
        $resultado=$tipo_actividad->obtener();
        if($resultado){
            $resultado=json_encode($resultado);
            echo $resultado;
        }
    break;
    case 'buscar':
        $data_busq=$_REQUEST['data_busq'];
        $tipo_actividad=new tipo_actividad();
        $tipo_actividad->setNombre_tipo(strtoupper($data_busq));
        $tipo_actividad->setCodigo_tipo($data_busq);
        $resultado=$tipo_actividad->buscar();
        $resultado=json_encode($resultado);
        echo $resultado;
    break;
        

}

?>