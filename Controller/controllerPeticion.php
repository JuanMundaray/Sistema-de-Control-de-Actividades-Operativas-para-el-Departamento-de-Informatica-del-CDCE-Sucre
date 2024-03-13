<?php

require_once("../Model/peticion.php");

$option=$_REQUEST['option'];
switch($option){

    case 'crear_peticion':
        $peticion=new peticion();
        $nombre_usuario=$_REQUEST['nombre_usuario'];
        $nombre_peticion=$_REQUEST['nombre_peticion'];
        $departamento_peticion=$_REQUEST['departamento_peticion'];
        $detalles_peticion=$_REQUEST['detalles_peticion'];
        $peticion->setNombre_peticion($nombre_usuario);
        $peticion->setNombre_usuario($nombre_peticion);
        $peticion->setDepartamento_peticion($departamento_peticion);
        $peticion->setDetalles_peticion($detalles_peticion);
        $resultado=$peticion->guardar();
        exit();
    break;
        

}

?>