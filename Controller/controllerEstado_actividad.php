<?php

require_once("../Model/estado_actividad.php");

$option=$_REQUEST['option'];
switch($option){

    case 'obtener':
        $estado_actividad=new estado_actividad();
        $resultado=$estado_actividad->obtener();
        if($resultado){
            $resultado=json_encode($resultado);
            echo $resultado;
        }
    break;
        

}

?>