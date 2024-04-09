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
        $tipo_actividad=new tipo_actividad();
        $columna=$_REQUEST['columna'];
        $data_busq=$_REQUEST['data_busq'];
        
        //Comprueba si useLIKE existe
        if(isset($_REQUEST['useLIKE'])){
            //Combierte el string false al valor booleano false
            //esta variable es para decidir si usar o no ILIKE en la consulta
            if($_REQUEST['useLIKE']=='false'){
                $useLIKE=false;
            }
            else{
                $useLIKE=true;
            }
        }

        //-----------------paginacion
        if((isset($_REQUEST['pagina']))&&(isset($_REQUEST['num_resultados']))){
            $pagina=$_REQUEST['pagina'];//Pagina actual en la paginacion
            $num_resultados=$_REQUEST['num_resultados'];
        }
        //-----------------paginacion

        $resultado=$tipo_actividad->buscar($columna,$data_busq,$useLIKE,$pagina,$num_resultados);
        $resultado=json_encode($resultado);
        echo $resultado;

    break;

    case 'contarRegistros':
        $tipo_actividad=new tipo_actividad();
        
        if(isset($_REQUEST['useLIKE'])){
            if($_REQUEST['useLIKE']=='false'){
                $useLIKE=false;
            }
            else{
                $useLIKE=true;
            }
        }

        if((isset($_REQUEST['data_busq']))&&(isset($_REQUEST['columna']))){
            //resultado sera todos los registros de la tabla segun la condicion en el where
            $data_busq=$_REQUEST['data_busq'];
            $columna=$_REQUEST['columna'];
            $resultado=$tipo_actividad->getNumRegistros($columna,$data_busq,$useLIKE);
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