<?php

require_once("../Model/departamentos.php");

$option=$_REQUEST['option'];
switch($option){



    case 'crear':
        $departamento=new departamento();
        $nombre_departamento=$_REQUEST['nombre_departamento'];
        $departamento->setNombreDepartamento(strtoupper($nombre_departamento));
        $resultado=$departamento->crear();
        if($resultado){
            header("location:../View/departamentos-administrar.php");
            exit();
        }
    break;

    case 'obtener':
        $departamento=new departamento();

        if(isset($_REQUEST['nombre_departamento'])){
            $departamento->setNombreDepartamento($_REQUEST['nombre_departamento']);
        }
        if(isset($_REQUEST['id_departamento'])){
            $departamento->setIdDepartamento($_REQUEST['id_departamento']);
        }
        
        if(isset($_REQUEST['pagina'])){
            //-----------------paginacion
            $pagina=$_REQUEST['pagina'];//Pagina actual en la paginacion
            $num_resultados=$_REQUEST['num_resultados'];
            //-----------------paginacion
            $resultado=$departamento->obtener($pagina,$num_resultados);
        }
        else{
            $resultado=$departamento->obtener();
        }
        if($resultado){
            $resultado=json_encode($resultado);
            echo $resultado;
        }
    break;

    case 'contarRegistros':

        $departamento=new departamento();

        if(isset($_REQUEST['nombre_departamento'])){
            $departamento->setNombreDepartamento($_REQUEST['nombre_departamento']);
        }
        if(isset($_REQUEST['id_usuario'])){
            $departamento->setIdDepartamento(($_REQUEST['id_departamento']));
        }

        $resultado=$departamento->contarNumRegistros();

        if($resultado){
            $resultado=json_encode($resultado);
            echo $resultado;
        }else{
            echo $resultado;
        }
           
    break;

    case 'eliminar':
        $id_departamento=$_REQUEST['id_departamento'];
        $departamento=new departamento();
        $departamento->setIdDepartamento($id_departamento);
        $resultado=$departamento->eliminar();
        echo $resultado;
        json_encode($resultado);
    break;

}

?>