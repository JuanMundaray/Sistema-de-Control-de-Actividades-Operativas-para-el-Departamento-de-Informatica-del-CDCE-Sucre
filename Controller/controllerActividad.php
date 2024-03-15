<?php

require_once("../Model/actividad.php");

$option=$_REQUEST['option'];
switch($option){

    case 'guardar':
        $actividad=new actividad();
        $codigo=$_REQUEST['codigo'];
        $nombre=$_REQUEST['nombre'];
        $tipo=$_REQUEST['tipo'];
        $dep_receptor=$_REQUEST['dep_receptor'];
        $dep_emisor=$_REQUEST['dep_emisor'];
        $fecha=$_REQUEST['fecha'];
        $observacion=$_REQUEST['observacion'];
        $nom_responsable=$_REQUEST['nom_responsable'];
        $ape_responsable=$_REQUEST['ape_responsable'];
        $ced_responsable=$_REQUEST['ced_responsable'];
        $nom_atendido=$_REQUEST['nom_atendido'];
        $ape_atendido=$_REQUEST['ape_atendido'];
        $ced_atendido=$_REQUEST['ced_atendido'];
        $actividad->setCodigo($codigo);
        $actividad->setNombre(strtoupper($nombre));
        $actividad->setTipo($tipo);
        $actividad->setDep_receptor($dep_receptor);
        $actividad->setDep_emisor($dep_emisor);
        $actividad->setfecha($fecha);
        $actividad->setObservacion($observacion);
        $actividad->setNom_responsable(strtoupper($nom_responsable));
        $actividad->setApe_responsable(strtoupper($ape_responsable));
        $actividad->setCed_responsable($ced_responsable);
        $actividad->setNom_atendido(strtoupper($nom_atendido));
        $actividad->setApe_atendido(strtoupper($ape_atendido));
        $actividad->setCed_atendido($ced_atendido);
        $resultado=$actividad->guardar();
        header("location:../View/actividades-registradas.php");
        exit();
    break;


    case 'obtener':
        $actividad=new actividad();
        $resultado=$actividad->obtener();
        if($resultado){
            $resultado=json_encode($resultado);
            echo $resultado;
        }
    break;

    case 'eliminar':
        $id=$_REQUEST['id'];
        $actividad=new actividad();
        $actividad->setID($id);
        $resultado=$actividad->eliminar();
    break;

    case 'buscar':
        $data_busq=$_REQUEST['data_busq'];
        $parametro_busq=$_REQUEST['parametro_busq'];
        $actividad=new actividad();
        $actividad->setNombre(strtoupper($data_busq));
        $resultado=$actividad->buscar($parametro_busq);
        if($resultado){
            $resultado=json_encode($resultado);
            echo $resultado;
        }else{
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

    case 'modificar':
        $actividad=new actividad();
        $observacion=$_REQUEST['observacion'];
        $id=$_REQUEST['id'];
        $informe=$_REQUEST['informe'];
        $estado=$_REQUEST['estado'];
        $actividad->setEstado(strtoupper($estado));
        $actividad->setObservacion($observacion);
        $actividad->setInforme($informe);
        $actividad->setID($id);
        $resultado=$actividad->modificar();
        break;

        

}

?>