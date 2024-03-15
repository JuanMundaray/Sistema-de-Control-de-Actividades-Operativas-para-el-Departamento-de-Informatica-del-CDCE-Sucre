<?php

require_once("../Model/peticion.php");

$option=$_REQUEST['option'];
switch($option){

    case 'crear_peticion':
        $peticion=new peticion();
        $usuario=$_REQUEST['usuario'];
        $nombre_peticion=$_REQUEST['nombre_peticion'];
        $departamento_peticion=$_REQUEST['departamento_peticion'];
        $detalles_peticion=$_REQUEST['detalles_peticion'];
        $peticion->setNombre_peticion($nombre_peticion);
        $peticion->setUsuario($usuario);
        $peticion->setDepartamento_peticion($departamento_peticion);
        $peticion->setDetalles_peticion($detalles_peticion);
        $resultado=$peticion->guardar();
        if($resultado){
            header("location:../View/peticiones-registradas.php");
            exit();
        }else{
            echo "Error";
        }
    break;

    case 'obtener':
        $peticion=new peticion();
        $resultado=$peticion->obtener();
            $resultado=json_encode($resultado);
            echo $resultado;
    break;

    case 'eliminar':
        $id_peticion=$_REQUEST['id_peticion'];
        $peticion=new peticion();
        $peticion->setId_peticion($id_peticion);
        $resultado=$peticion->eliminar();
    break;
        

}

?>