<?php
require("../Model/usuario.php");

$option=$_REQUEST['option'];

switch($option){

    case 'crear':
        date_default_timezone_set('America/Lima');
        $usuario=new usuario();
        $nombre_usuario=$_REQUEST['username'];
        $contrasena=$_REQUEST['password'];
        $nombre=$_REQUEST['nombre'];
        $apellido=$_REQUEST['apellido'];
        $cedula=$_REQUEST['cedula'];
        $departamento_usuario=$_REQUEST['departamento'];
        $tipo_usuario=$_REQUEST['tipo_usuario'];
        $usuario->set_nombre_usuario($nombre_usuario);
        $usuario->set_contrasena($contrasena);
        $usuario->set_tipoUsuario($tipo_usuario);
        $usuario->set_departamento_usuario($departamento_usuario);
        $usuario->set_nombre_personal(strtoupper($nombre));
        $usuario->setApellido_personal(strtoupper($apellido));
        $usuario->set_cedula($cedula);
        $usuario->set_fecha_creacion(date("Y-m-d"));
        $resultado=$usuario->guardar_usuario();
        if($resultado){
            header('location:../View/lista-usuarios.php');
            exit();
        }
    break;


    case 'obtener':
        $usuario=new usuario();
        //-----------------paginacion
        $pagina=$_REQUEST['pagina'];//Pagina actual en la paginacion
        $num_resultados=$_REQUEST['num_resultados'];
        //-----------------paginacion
        $resultado=$usuario->get_usuario($pagina,$num_resultados);
        if($resultado){
            $resultado=json_encode($resultado);
            echo $resultado;
        }
    break;

    case 'eliminar':
        $id_usuario=$_REQUEST['id_usuario'];
        $usuario=new usuario();
        $usuario->set_id_usuario($id_usuario);
        $resultado=$usuario->eliminar_usuario();
        if($resultado){
            $resultado=json_encode($resultado);
            echo $resultado;
        }
    break;

    case 'modificar':
        $usuario=new usuario();
        $contrasena=$_REQUEST['password'];
        $id_usuario=$_REQUEST['id_usuario'];
        $nombre=$_REQUEST['nombre'];
        $apellido=$_REQUEST['apellido'];
        $cedula=$_REQUEST['cedula'];
        $departamento_usuario=$_REQUEST['departamento'];
        $tipo_usuario=$_REQUEST['tipo_usuario'];
        $usuario->set_contrasena($contrasena);
        $usuario->set_tipoUsuario($tipo_usuario);
        $usuario->set_id_usuario($id_usuario);
        $usuario->set_departamento_usuario($departamento_usuario);
        $usuario->set_nombre_personal(strtoupper($nombre));
        $usuario->setApellido_personal(strtoupper($apellido));
        $usuario->set_cedula($cedula);
        $resultado=$usuario->modificar_usuario();
        if($resultado){
            header('location:../View/lista-usuarios.php');
            exit();
        }
        break;

    case 'buscar':
        $usuario=new usuario();
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
        }else{
            $pagina=false;
            $num_resultados=false;
        }
        //-----------------paginacion
        
        $resultado=$usuario->buscar_usuario($columna,$data_busq,$useLIKE,$pagina,$num_resultados);
        if($resultado){
            $resultado=json_encode($resultado);
            echo $resultado;
        }
    break;

    case 'login':
        $usuario=new usuario();
        $nombre_usuario=$_REQUEST['username'];
        $contrasena=$_REQUEST['password'];
        $resultado=$usuario->login($nombre_usuario,$contrasena);
    break;

    case 'contarRegistros':

        $usuario=new usuario();
        
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
            $resultado=$usuario->getNumRegistros($columna,$data_busq,$useLIKE);
        }
        else{//resultado sera todos los registros de la tabla
            $resultado=$usuario->getNumRegistros();
        }
        echo $resultado;
    break;

    case 'contarRegistrosHistorial':

        $usuario=new usuario();
        
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
            $resultado=$usuario->getNumRegistrosHistorial($columna,$data_busq,$useLIKE);
        }
        else{//resultado sera todos los registros de la tabla
            $resultado=$usuario->getNumRegistrosHistorial();
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

        $export->query("SELECT * FROM actividades.usuario
        LEFT JOIN actividades.departamentos
        ON usuario.id_departamento=departamentos.id_departamento");

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