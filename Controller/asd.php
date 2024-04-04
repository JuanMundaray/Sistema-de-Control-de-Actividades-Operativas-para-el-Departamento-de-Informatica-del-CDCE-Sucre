<?php
require_once("../Model/historial_actividad.php");
$historial_actividad=new historial_actividad();
        //-----------------paginacion
        $pagina=1;//Pagina actual en la paginacion
        $num_resultados=5;
        //-----------------paginacion
        $resultado=$historial_actividad->getHistorial_actividades($pagina,$num_resultados);
        $resultado=json_encode($resultado);
        echo $resultado;
        ?>