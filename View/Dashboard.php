<!DOCTYPE html>
<html lang="es">
<head>
    
    <?php
        session_start();
        if(isset($_SESSION["tipo_usuario"])){
            if($_SESSION["tipo_usuario"]=="invitado"){
                echo '<script src="Plantillas/menu_desplegable-invitado.js"></script>';
            }
            if($_SESSION["tipo_usuario"]=="estandar"){
                echo '<script src="Plantillas/menu_desplegable-estandar.js"></script>';
            }
            if($_SESSION["tipo_usuario"]=="administrador"){
                echo '<script src="Plantillas/menu_desplegable-administrador.js"></script>';
            }
        }
        else{
            header("Location:../index.php");
            exit();
        }
        require_once("Plantillas/Plantilla_cabecera.php");
    ?>
    <meta charset="UTF-8"><link rel="icon" href="../favicon.ico" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../Framework/bootstrap-5.3.0/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="CSS/EstiloCabecera.css" type="text/css">
    <link rel="stylesheet" href="CSS/MenuDelizante.css" type="text/css">
    <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">
    <link rel="stylesheet" href="CSS/dashboard.css" type="text/css">
    

</head>
<body>
    <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->
    <main>
        <h1 class="titleh1" style="margin-left: 12vw;">Dashboard</h1>
        <section class="seccionDashboard">
            <div style="margin-left: 11vw;" class="container">

                <h2>Area de Trabajo</h2>

                <?php 
                    if($_SESSION["tipo_usuario"]!="invitado"){
                        require_once('./Plantillas/dashboard/parte_actividades.php');
                    } 
                ?>
                <?php 
                    if($_SESSION["tipo_usuario"]=="administrador"){
                        require_once('./Plantillas/dashboard/parte_usuario.php');
                    }
                ?>
                <?php require_once('./Plantillas/dashboard/parte_peticiones.php') ?>
                
            </div>  
              
        </section>
</main>
    <script src="../Framework/bootstrap-5.3.0/js/bootstrap.min.js"></script>
    <script src="../Framework/Chart.js"></script>
    <script src="../Framework/jquery-3.6.3.min.js"></script>
    <script src="JS/js.dashboard/index.js" type="module"></script>
</body>
</html>