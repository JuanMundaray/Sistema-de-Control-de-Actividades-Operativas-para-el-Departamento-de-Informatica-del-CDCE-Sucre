<?php
    session_start();
    if(isset($_SESSION['nombre_usuario'])){  
        header('location:View/Dashboard.php');
        exit();
    }else{
        header('location:View/Inicio.php');
        exit();
    }

?>