<?php
require("../Model/usuario.php");

$option=$_REQUEST['option'];

switch($option){

    case 'crear':
          date_default_timezone_set('America/Caracas');
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
            header('location:../View/usuarios-administrar.php');
            exit();
        }
    break;


    case 'obtener':
        $usuario=new usuario();

        if(isset($_REQUEST['nombre_usuario'])){
            $usuario->set_nombre_usuario($_REQUEST['nombre_usuario']);
        }
        if(isset($_REQUEST['id_usuario'])){
            $usuario->set_id_usuario(($_REQUEST['id_usuario']));
        }

        if(isset($_REQUEST['extraer_todos'])){
            if($_REQUEST['extraer_todos']=='true'){
               $todos=true; 
            }
            else{
               $todos=false;
            }
        }else{
            $todos=false;
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

        $resultado=$usuario->getUsuarios($pagina,$num_resultados,$todos);
        $resultado=json_encode($resultado);
        echo $resultado;
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
        $nombre_personal=$_REQUEST['nombre_personal'];
        $apellido_personal=$_REQUEST['apellido_personal'];
        $cedula=$_REQUEST['cedula'];
        $departamento_usuario=$_REQUEST['departamento'];
        $tipo_usuario=$_REQUEST['tipo_usuario'];
        $usuario->set_contrasena($contrasena);
        $usuario->set_tipoUsuario($tipo_usuario);
        $usuario->set_id_usuario($id_usuario);
        $usuario->set_departamento_usuario($departamento_usuario);
        $usuario->set_nombre_personal(strtoupper($nombre_personal));
        $usuario->setApellido_personal(strtoupper($apellido_personal));
        $usuario->set_cedula($cedula);
        $resultado=$usuario->modificar_usuario();
        if($resultado){
            header('location:../View/usuarios-administrar.php');
            exit();
        }
    break;

    case 'contarRegistros':

        $usuario=new usuario();

        if(isset($_REQUEST['nombre_usuario'])){
            $usuario->set_nombre_usuario($_REQUEST['nombre_usuario']);
        }
        if(isset($_REQUEST['id_usuario'])){
            $usuario->set_id_usuario(($_REQUEST['id_usuario']));
        }

        if(isset($_REQUEST['extraer_todos'])){
            if($_REQUEST['extraer_todos']=='true'){
               $todos=true; 
            }
            else{
               $todos=false;
            }
        }
        else{
            $todos=false;
        }
        
        $resultado=$usuario->contarNumRegistros($todos);

        if($resultado){
            $resultado=json_encode($resultado);
            echo $resultado;
        }else{
            echo $resultado;
        }

    break;
    
    case 'login':
        $usuario=new usuario();
        $nombre_usuario=$_REQUEST['username'];
        $contrasena=$_REQUEST['password'];
        $resultado=$usuario->login($nombre_usuario,$contrasena);
    break;
    
    case 'cerrarSesion':
        $usuario=new usuario();
        $resultado=$usuario->cerrarSesion($nombre_usuario,$contrasena);
    break;

    case 'exportarExcel':
        $usuario=new usuario();
        if(isset($_REQUEST['todos_registros'])){
            $usuario->exportarEXCEL(true);
        }else{
            $usuario->exportarEXCEL();
        }
    break;

}

?>