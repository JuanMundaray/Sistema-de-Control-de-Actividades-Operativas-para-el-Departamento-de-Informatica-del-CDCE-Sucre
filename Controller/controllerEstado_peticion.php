<?php

require_once("../Model/estado_peticion.php");

$option=$_REQUEST['option'];
switch($option){

    case 'obtener':
        $estado_peticion=new estado_peticion();
        $resultado=$estado_peticion->obtener();
        if($resultado){
            $resultado=json_encode($resultado);
            echo $resultado;
        }
    break;
        

}

?>