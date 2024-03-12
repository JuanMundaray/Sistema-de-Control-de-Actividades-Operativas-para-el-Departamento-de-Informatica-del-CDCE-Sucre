<?php

require_once("../Model/actividad.php");

$data_busq=$_REQUEST['term'];
$actividad=new actividad();
$actividad->setNombre($data_busq);
$actividad->setCodigo($data_busq);
$resultado=$actividad->autocompletar();
if($resultado){
    $resultado=json_encode($resultado);
    echo $resultado;
}else{
    $resultado=json_encode($resultado);
    echo $resultado;
}

?>