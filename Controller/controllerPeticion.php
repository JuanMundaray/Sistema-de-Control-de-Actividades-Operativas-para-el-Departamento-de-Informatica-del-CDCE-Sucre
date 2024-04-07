<?php

require_once("../Model/peticion.php");

$option=$_REQUEST['option'];
switch($option){

    case 'crear_peticion':
        date_default_timezone_set('America/Lima');
        $peticion=new peticion();
        $usuario=$_REQUEST['usuario'];
        $nombre_peticion=$_REQUEST['nombre_peticion'];
        $departamento_peticion=$_REQUEST['departamento_peticion'];
        $detalles_peticion=$_REQUEST['detalles_peticion'];
        $peticion->setNombre_peticion(strtoupper($nombre_peticion));
        $peticion->setId_Usuario($usuario);
        $peticion->setDepartamento_peticion($departamento_peticion);
        $peticion->setDetalles_peticion($detalles_peticion);
        $resultado=$peticion->guardar();
        if($resultado){
            header("location:../View/peticiones-registradas.php");
            exit();
        }
    break;

    case 'obtener':
        $peticion=new peticion();
        //-----------------paginacion
        $pagina=$_REQUEST['pagina'];//Pagina actual en la paginacion
        $num_resultados=$_REQUEST['num_resultados'];
        //-----------------paginacion
        $resultado=$peticion->getPeticiones($pagina,$num_resultados);
        $resultado=json_encode($resultado);
        echo $resultado;
    break;

    case 'eliminar':
        $id_peticion=$_REQUEST['id_peticion'];
        $peticion=new peticion();
        $peticion->setId_peticion($id_peticion);
        $resultado=$peticion->eliminar();
    break;

    case 'contarRegistros':
        $peticion=new peticion();

        if((isset($_REQUEST['data_busq']))&&(isset($_REQUEST['parametro_busq']))){
            //resultado sera todos los registros de la tabla segun la condicion en el where
            $data_busq=$_REQUEST['data_busq'];
            $parametro_busq=$_REQUEST['parametro_busq'];
            $resultado=$peticion->getNumRegistros($parametro_busq,$data_busq);
        }
        else{//resultado sera todos los registros de la tabla
            $resultado=$peticion->getNumRegistros();
        }

        if($resultado){
            $resultado=json_encode($resultado);
            echo $resultado;
        }
    break;

    case 'buscar':
        $data_busq=$_REQUEST['data_busq'];
        $parametro_busq=$_REQUEST['parametro_busq'];
        $peticion=new peticion();
        
        //-----------------paginacion
        $pagina=$_REQUEST['pagina'];//Pagina actual en la paginacion
        $num_resultados=$_REQUEST['num_resultados'];
        //-----------------paginacion

        if($parametro_busq=='fecha'){
        }

        else{
            $resultado=$peticion->buscar($parametro_busq,$data_busq,$pagina,$num_resultados);
        }
        
        $resultado=json_encode($resultado);
        echo $resultado;
    break;

}

?>