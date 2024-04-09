<?php

require_once("../Model/actividad.php");

$option=$_REQUEST['option'];
switch($option){

    case 'guardar':
        date_default_timezone_set('America/Lima');
        $actividad=new actividad();
        $codigo=$_REQUEST['codigo'];
        $nombre=$_REQUEST['nombre'];
        $id_tipo=$_REQUEST['tipo'];
        $dep_receptor=$_REQUEST['dep_receptor'];
        $dep_emisor=$_REQUEST['dep_emisor'];
        $observacion=$_REQUEST['observacion'];
        $nom_responsable=$_REQUEST['nom_responsable'];
        $ape_responsable=$_REQUEST['ape_responsable'];
        $ced_responsable=$_REQUEST['ced_responsable'];
        $nom_atendido=$_REQUEST['nom_atendido'];
        $ape_atendido=$_REQUEST['ape_atendido'];
        $ced_atendido=$_REQUEST['ced_atendido'];
        $id_usuario=$_REQUEST['id_usuario'];
        $actividad->setCodigo($codigo);
        $actividad->setNombre(strtoupper($nombre));
        $actividad->setId_tipo($id_tipo);
        $actividad->setDep_receptor($dep_receptor);
        $actividad->setDep_emisor($dep_emisor);
        $actividad->setfecha(date("Y-m-d"));
        $actividad->setObservacion($observacion);
        $actividad->setNom_responsable(strtoupper($nom_responsable));
        $actividad->setApe_responsable(strtoupper($ape_responsable));
        $actividad->setCed_responsable($ced_responsable);
        $actividad->setNom_atendido(strtoupper($nom_atendido));
        $actividad->setApe_atendido(strtoupper($ape_atendido));
        $actividad->setCed_atendido($ced_atendido);
        $actividad->setId_usuario($id_usuario);
        $resultado=$actividad->guardar();
        if($resultado){
            header("location:../View/actividades-registradas.php");
            exit();
        }
    break;


    case 'obtener':
        $actividad=new actividad();
        //-----------------paginacion
        $pagina=$_REQUEST['pagina'];//Pagina actual en la paginacion
        $num_resultados=$_REQUEST['num_resultados'];
        //-----------------paginacion
        $resultado=$actividad->getActividades($pagina,$num_resultados);
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
        $columna=$_REQUEST['columna'];
        $actividad=new actividad();
        
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

        $resultado=$actividad->buscar($columna,$data_busq,$useLIKE,$pagina,$num_resultados);

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

    case 'modificar':
        $actividad=new actividad();
        $observacion=$_REQUEST['observacion'];
        $id=$_REQUEST['id'];
        $informe=$_REQUEST['informe'];
        $estado=$_REQUEST['estado'];
        if(isset($_FILES['evidencia'])){
            $nombre_file=$_FILES["evidencia"]['name'];
            $tipo_file=$_FILES["evidencia"]["type"];
            $file_size=$_FILES["evidencia"]["size"];
            //Ruta de destino donde se guardara el archivo en el servidor
            $ruta_destino=$_SERVER['DOCUMENT_ROOT'].'/intranet/uploads_sca_cdce/';
            //mover la imagen a la carpeta de destino
            move_uploaded_file($_FILES['evidencia']['tmp_name'],$ruta_destino.$nombre_file);
            $actividad->setEvidencia(($nombre_file));
        }
        $actividad->setEstado(strtoupper($estado));
        $actividad->setObservacion($observacion);
        $actividad->setInforme($informe);
        $actividad->setID($id);
        $resultado=$actividad->modificar();
        break;

        case 'contarRegistros':
            $actividad=new actividad();
        
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
                $resultado=$actividad->getNumRegistros($columna,$data_busq,$useLIKE);
            }
            else{//resultado sera todos los registros de la tabla
                $resultado=$actividad->getNumRegistros();
            }

            if($resultado){
                $resultado=json_encode($resultado);
                echo $resultado;
            }else{
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

            $export->query("SELECT * FROM actividades.actividad
            INNER JOIN actividades.tipo_actividad
            ON actividad.id_tipo=tipo_actividad.id_tipo");

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