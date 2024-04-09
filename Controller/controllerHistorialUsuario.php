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

    case 'exportarExcel':
        require '../Plugins/yunho-dbexport-master/src/YunhoDBExport.php';
        require_once("../Model/configurarBD.php");

        date_default_timezone_set('America/Lima');
        $export=new YunhoDBExport(SERVIDOR,BD,USUARIO,CLAVE);
        
        $export->connect();

        $campos=array(
            'id_usuario'=>'ID',
            'nombre_usuario'=>'Nombre de Usuario',
            'nombre'=>'Nombre y Apellido',
            'cedula'=>'Cedula del Usuario',
            'fecha_creacion'=>'Fecha de Creacion',
            'tipo_usuario'=>'Tipo de Usuario',
            'id_departamento'=>'Departamento del Usuario'
        );

        $export->query("SELECT * FROM actividades.historial_usuario
        LEFT JOIN actividades.departamentos
        ON historial_usuario.id_departamento=departamentos.id_departamento");

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