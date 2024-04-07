<?php

require_once("../Model/departamentos.php");

$option=$_REQUEST['option'];
switch($option){


    case 'obtener':
        $departamento=new departamento();
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
        

}

?>