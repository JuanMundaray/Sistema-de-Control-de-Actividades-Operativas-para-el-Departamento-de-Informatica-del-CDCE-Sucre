<?php

ini_set('session.cache_limiter','public');
session_cache_limiter(false);
require_once("../Model/actividad.php");

$option=$_REQUEST['option'];

echo $option;

header("Cache-Control:&nbsp;no-cache,&nbsp;must-revalidate");
header("Expires:&nbsp;Sat,&nbsp;26&nbsp;Jul&nbsp;1997&nbsp;05:00:00&nbsp;GMT");

switch($option)
{
    case 'cambiar_firma':

        // Verificar si el tipo de archivo es jpeg
        if(($_FILES["firma"]["type"] === 'image/jpeg')) {

            cambiar_imagen('firma',$_SERVER['DOCUMENT_ROOT'].'/sca_cdce/View/Resources/firmas/','firma_cdce.jpg');
            header("location:../View/modificar_firma.php");
            exit();

        }
        
        else {
            header("location:../View/error_subir_archivo.php?mensaje=1");
            exit();
        }
    break;
    
    case 'restaurar_firma':
        //Ruta de destino donde se guardara el archivo en el servidor
        $ruta_original=$_SERVER['DOCUMENT_ROOT'].'/sca_cdce/View/Resources/backup_img/firma_sello_zona.jpg';
        $ruta_destino=$_SERVER['DOCUMENT_ROOT'].'/sca_cdce/View/Resources/firmas/';
        //mover la imagen a la carpeta de destino
        copy($ruta_original,$ruta_destino.'firma_cdce.jpg');
        echo 1;
    break;

    case 'restaurar_logo':
        //Ruta de destino donde se guardara el archivo en el servidor
        $ruta_original=$_SERVER['DOCUMENT_ROOT'].'/sca_cdce/View/Resources/backup_img/CDCE-logo-ministerio-de-educacion.png';
        $ruta_destino=$_SERVER['DOCUMENT_ROOT'].'/sca_cdce/View/Resources/Imagenes/';
        //mover la imagen a la carpeta de destino
        copy($ruta_original,$ruta_destino.'CDCE-logo-ministerio-de-educacion.png');
        echo 1;
    break;

    case 'cambiar_logo':
        // Verificar si el tipo de archivo es png
        if(($_FILES["logo"]["type"] === 'image/png')) {
            cambiar_imagen('logo',$_SERVER['DOCUMENT_ROOT'].'/sca_cdce/View/Resources/Imagenes/','CDCE-logo-ministerio-de-educacion.png');
            header("location:../View/modificar_logos.php");
            exit();
        }
        
        else {
            header("location:../View/error_subir_archivo.php?mensaje=2");
            exit();
        }
    break;

    case 'restaurar_imagen_derecha':
        //Ruta de destino donde se guardara el archivo en el servidor
        $ruta_original=$_SERVER['DOCUMENT_ROOT'].'/sca_cdce/View/Resources/backup_img/logo-zamora-03.png';
        $ruta_destino=$_SERVER['DOCUMENT_ROOT'].'/sca_cdce/View/Resources/Imagenes/';
        //mover la imagen a la carpeta de destino
        copy($ruta_original,$ruta_destino.'logo-zamora-03.png');
        echo 1;
    break;

    case 'cambiar_imagen_derecha':
        // Verificar si el tipo de archivo es png
        if(($_FILES["imagen_derecha"]["type"] === 'image/png')) {
            cambiar_imagen('imagen_derecha',$_SERVER['DOCUMENT_ROOT'].'/sca_cdce/View/Resources/Imagenes/','logo-zamora-03.png');
            
            header("location:../View/modificar_logos.php");
            exit();
        }
        
        else {
            header("location:../View/error_subir_archivo.php?mensaje=2");
            exit();
        }
    break;

    case 'restaurar_imagen_izquierda':
        //Ruta de destino donde se guardara el archivo en el servidor
        $ruta_original=$_SERVER['DOCUMENT_ROOT'].'/sca_cdce/View/Resources/backup_img/logo_ministerio.png';
        $ruta_destino=$_SERVER['DOCUMENT_ROOT'].'/sca_cdce/View/Resources/Imagenes/';
        //mover la imagen a la carpeta de destino
        copy($ruta_original,$ruta_destino.'logo_ministerio.png');
    break;

    case 'cambiar_imagen_izquierda':
        // Verificar si el tipo de archivo es png
        if(($_FILES["imagen_izquierda"]["type"] === 'image/png')) {
            cambiar_imagen('imagen_izquierda',$_SERVER['DOCUMENT_ROOT'].'/sca_cdce/View/Resources/Imagenes/','logo_ministerio.png');
            header("location:../View/modificar_logos.php");
            exit();
        }

        else {
            header("location:../View/error_subir_archivo.php?mensaje=2");
            exit();
        }

    break;

    case 'cambiar_logo_nombre':
        // Verificar si el tipo de archivo es png
        if(($_FILES["logo_nombre"]["type"] === 'image/jpeg')) {
            cambiar_imagen('logo_nombre',$_SERVER['DOCUMENT_ROOT'].'/sca_cdce/View/Resources/Imagenes/','logo.jpg');
            header("location:../View/modificar_logos.php");
            exit();
        }

        else {
            header("location:../View/error_subir_archivo.php?mensaje=1");
            exit();
        }

    break;

    case 'restaurar_logo_nombre':
        //Ruta de destino donde se guardara el archivo en el servidor
        $ruta_original=$_SERVER['DOCUMENT_ROOT'].'/sca_cdce/View/Resources/backup_img/logo.jpg';
        $ruta_destino=$_SERVER['DOCUMENT_ROOT'].'/sca_cdce/View/Resources/Imagenes/';
        //mover la imagen a la carpeta de destino
        copy($ruta_original,$ruta_destino.'logo.jpg');
        echo 1;
    break;
}



    function cambiar_imagen($nombre_var,$ruta_destino,$nombre_archivo){
        $nombre_file=$_FILES[$nombre_var]['name'];
        $tipo_file=$_FILES[$nombre_var]["type"];
        $file_size=$_FILES[$nombre_var]["size"];
        //mover la imagen a la carpeta de destino
        move_uploaded_file($_FILES[$nombre_var]['tmp_name'],$ruta_destino.$nombre_archivo);
        
    }
?>