<?php

require_once("../Model/historial_actividad.php");

$option=$_REQUEST['option'];

switch($option){

    case 'obtener':
        $historial_actividad=new historial_actividad();
        //-----------------paginacion
        $pagina=$_REQUEST['pagina'];//Pagina actual en la paginacion
        $num_resultados=$_REQUEST['num_resultados'];
        //-----------------paginacion
        $resultado=$historial_actividad->getHistorial_actividades($pagina,$num_resultados);
        if($resultado){
            $resultado=json_encode($resultado);
            echo $resultado;
        }
    break;

    case 'buscar':
        $data_busq=$_REQUEST['data_busq'];
        $parametro_busq=$_REQUEST['parametro_busq'];
        $actividad=new actividad();
        
        //-----------------paginacion
        $pagina=$_REQUEST['pagina'];//Pagina actual en la paginacion
        $num_resultados=$_REQUEST['num_resultados'];
        //-----------------paginacion

        if(($parametro_busq=='fecha') || ($parametro_busq=='fecha')){
            $resultado=$actividad->buscarExacta($parametro_busq,$data_busq,$pagina,$num_resultados);
        }

        else{
            $resultado=$actividad->buscar($parametro_busq,$data_busq,$pagina,$num_resultados);
        }

        if($resultado){
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

    case 'contarRegistros':
        $historial_actividad=new historial_actividad();

        if((isset($_REQUEST['data_busq']))&&(isset($_REQUEST['parametro_busq']))){
            //resultado sera todos los registros de la tabla segun la condicion en el where
            $data_busq=$_REQUEST['data_busq'];
            $parametro_busq=$_REQUEST['parametro_busq'];
            $resultado=$historial_actividad->getNumRegistros($parametro_busq,$data_busq);
        }
        else{//resultado sera todos los registros de la tabla
            $resultado=$historial_actividad->getNumRegistros();
        }
        
        if($resultado){
            $resultado=json_encode($resultado);
            echo $resultado;
        }
    break;

    case 'exportarExcel':
        require '../Plugins/yunho-dbexport-master/src/YunhoDBExport.php';
        require_once("../Model/configurarBD.php");

        date_default_timezone_set('America/Lima');
        $export=new YunhoDBExport(SERVIDOR,BD,USUARIO,CLAVE);
        
        $export->connect();

        $campos=array(
            'id'=>'ID',
            'codigo'=>'codigo',
            'nombre'=>'nombre',
            'fecha'=>'fecha',
            'nombre_tipo'=>'tipo_actividad',
            'dep_emisor'=>'Departamento Emisor',
            'dep_receptor'=>'Departamento Receptor',
            'nom_atendido'=>'Nombre del Funcionario Atendido',
            'ape_atendido'=>'Apellido del Funcionario Atendido',
            'ced_atendido'=>'Cedula del Funcionario Atendido',
            'nom_responsable'=>'Nombre del Responsable de la Actividad',
            'ape_responsable'=>'Apellido del Responsable de la Actividad',
            'ced_responsable'=>'Cedula del Responsable de la Actividad',
            'estado'=>'Estado'
        );

        $export->query("SELECT * FROM actividades.historial_actividades
        INNER JOIN actividades.tipo_actividad
        ON historial_actividades.id_tipo=tipo_actividad.id_tipo");

        // Formato MS Excel
        $export->to_excel();

        // Construir tabla de datos
        $tabla=$export->build_table($campos);
        
        // Descargar archivo .xls
        $export->download();

        if ($dbhex = $export->get_error()) {
            die($dbhex->getMessage());
          }
    break;
}

?>