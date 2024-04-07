<?php

require_once("../Model/historial_usuario.php");

$option=$_REQUEST['option'];

switch($option){

    case 'obtener':
        $historial_usuario=new historial_usuario();
        //-----------------paginacion
        $pagina=$_REQUEST['pagina'];//Pagina actual en la paginacion
        $num_resultados=$_REQUEST['num_resultados'];
        //-----------------paginacion
        $resultado=$historial_usuario->get_Historial_usuario($pagina,$num_resultados);
        if($resultado){
            $resultado=json_encode($resultado);
            echo $resultado;
        }
    break;

    case 'contarRegistros':
        $historial_usuario=new historial_usuario();

        if((isset($_REQUEST['data_busq']))&&(isset($_REQUEST['parametro_busq']))){
            //resultado sera todos los registros de la tabla segun la condicion en el where
            $data_busq=$_REQUEST['data_busq'];
            $parametro_busq=$_REQUEST['parametro_busq'];
            $resultado=$historial_usuario->getNumRegistros($parametro_busq,$data_busq);
        }
        else{//resultado sera todos los registros de la tabla
            $resultado=$historial_usuario->getNumRegistros();
        }
        
        if($resultado){
            $resultado=json_encode($resultado);
            echo $resultado;
        }
    break;
}

?>