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
        $cedula=$_REQUEST['cedula'];
        $departamento=$_REQUEST['departamento'];
        $apellido=$_REQUEST['apellido'];
        $tipo_usuario=$_REQUEST['tipo_usuario'];
        $usuario->set_nombre_usuario($nombre_usuario);
        $usuario->set_contrasena($contrasena);
        $usuario->set_tipoUsuario($tipo_usuario);
        $usuario->set_departamento($departamento);
        $usuario->set_nombre(strtoupper($nombre." ".$apellido));
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
            header('location:../View/lista-usuarios.php');
            exit();
        }
    break;

    case 'modificar':
        $usuario=new usuario();
        $nombre_usu=$_REQUEST['username'];
        $contrasena=$_REQUEST['password'];
        $id_usuario=$_REQUEST['id_usuario'];
        $nombre=$_REQUEST['nombre'];
        $cedula=$_REQUEST['cedula'];
        $departamento=$_REQUEST['departamento'];
        $apellido=$_REQUEST['apellido'];
        $tipo_usuario=$_REQUEST['profile'];
        $usuario->set_nombre_usuario($nombre_usu);
        $usuario->set_contrasena($contrasena);
        $usuario->set_tipoUsuario($tipo_usuario);
        $usuario->set_id_usuario($id_usuario);
        $usuario->set_departamento($departamento);
        $usuario->set_nombre(strtoupper($nombre));
        $usuario->set_cedula($cedula);
        $usuario->set_fecha_creacion(date("Y-m-d"));
        $resultado=$usuario->modificar_usuario();
        if($resultado){
            header('location:../View/listar-usuarios.php');
            exit();
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

        if((isset($_REQUEST['data_busq']))&&(isset($_REQUEST['parametro_busq']))){
            //resultado sera todos los registros de la tabla segun la condicion en el where
            $data_busq=$_REQUEST['data_busq'];
            $parametro_busq=$_REQUEST['parametro_busq'];
            $resultado=$usuario->getNumRegistros($parametro_busq,$data_busq);
        }
        else{//resultado sera todos los registros de la tabla
            $resultado=$usuario->getNumRegistros();
        }
        
        if($resultado){
            $resultado=json_encode($resultado);
            echo $resultado;
        }
    break;

}

?>