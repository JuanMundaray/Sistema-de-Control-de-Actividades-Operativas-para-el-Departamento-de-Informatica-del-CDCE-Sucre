<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../favicon.ico" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Framework/bootstrap-5.3.0/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="CSS/EstiloCabecera.css" type="text/css">
    <link rel="stylesheet" href="CSS/MenuDelizante.css" type="text/css">
    <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">
    <script src="Plantillas/menu_desplegable-administrador.js"></script>
    <title>Control del Sistema</title>
</head>
<?php
        session_start();
        
        if(isset($_SESSION["tipo_usuario"])){
            if(($_SESSION["tipo_usuario"]!="administrador")){
                header("Location:./Dashboard.php");
                exit();
            }
        }else{
            header("Location:../index.php");
            exit();
        }

        require_once("Plantillas/Plantilla_cabecera.php");
        ?>
<body>
    
    <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->
    <main>
        <h1 class="titleh1">Control del Sistema</h1>
        <div class="contenedorPrincipal">
            <h2 style="background-color: rgb(50, 100, 236);" class="titleh2">Opciones de Administrador</h2>
            <section>
                <table class="table tabla-control-sistema">
                    <tr>
                        <td><a href="usuarios-administrar.php">Administrar Usuarios</a></td>
                    </tr>
                    <tr>
                        <td><a href="usuario-crear-1.php">Crear Usuarios</a></td>
                    </tr>
                    <tr>
                        <td><a href="usuarios-historial.php">Historial de Usuarios</a></td>
                    </tr>
                    <tr>
                        <td><a href="historial-actividades.php">Historial de Actividades</a></td>
                    </tr>
                    <tr>
                        <td><a href="departamentos-mostrar.php">Administrar Departamentos Registrados</a></td>
                    </tr>
                    <tr>
                        <td><a href="tipo-actividad.php">Administrar Tipos de Actividad</a></td>
                    </tr>
                    <tr>
                        <td><a href="generar_reporte_actividad.php">Generar Reportes de Actividad</a></td>
                    </tr>
                    <tr>
                        <td><a href="generar_reporte_peticiones.php">Generar Reportes de Peticiones</a></td>
                    </tr>
                    <!--<tr>
                        <td><a href="Generar Reportes de Usuarios.php">Generar Reportes de Usuarios</a></td>
                    </tr>-->
                </table>
            </section>
        </div>
    </main>
    
</body>
</html>