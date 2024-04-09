<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><link rel="icon" href="../favicon.ico" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipos de Actividad</title>
        <link rel="stylesheet" href="../Framework/bootstrap-5.3.0/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="CSS/EstiloCabecera.css" type="text/css">
    <link rel="stylesheet" href="CSS/MenuDelizante.css" type="text/css">
    <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">
    
    <script src="../Framework/jquery-3.6.3.min.js"></script>
    <script src="../Framework/jquery-ui-1.13.2.custom/jquery-ui.js"></script>
    <script src="JS/JS.tipo_actividad/ajax.tipo_actividad.js"></script>
    <script src="Plantillas/menu_desplegable-administrador.js"></script>
    

</head>
<?php
    session_start();
    
    if(isset($_SESSION["tipo_usuario"])){
        if(($_SESSION["tipo_usuario"]!="administrador")){
            header("Location:./Dashboard.php");
            exit();
        }
    }else{
        header("Location:../Index");
        exit();
    }

    require_once("Plantillas/Plantilla_cabecera.php");
?>
<body>
    <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->
    <main>
        <h1 class="titleh1">Tipo de Actividad</h1>
        <div class="contenedorPrincipal">
        <h2 class="titleh2">Tipos de Actividad</h2>
            <section class="secciones">
                
                <div>

<!--Boton Para ingresar al formulario para crear una nueva actividad predefinida-->
                    <a class="btn btn-primary" href="tipo-actividad-crear" role="button">Crear Tipo de Actividad</a>

                    <!--Barra de Busqueda-->
                    <nav class="navbar navbar-expand-lg navbar-light barra_navegacion row">
                        <form class="form col row">
                            <label class="form-label col-12">Buscar Por Nombre:</label>
                            <input class="form-control col-8" type="search" placeholder="Buscar Tipo de  Actividad..." id="data_busq" name="data_busq">
                            <input type="button" class="btn btn-primary col-3" id="buscar_tipo_act" value="Buscar">
                        </form>
                        
                        <form class="form col row">
                            <label class="form-label col-12">Buscar Por Id:</label>
                            <input class="form-control col-10" type="search" placeholder="Buscar Por ID..." id="data_busq_id" name="data_busq_id">
                            <input type="button" class="btn btn-primary col-3" id="buscar_id" value="Buscar">
                        </form>

                    
                        <div class="col-md-3">
                                <label class="form-label">Numero de Resultados:</label>
                                <select class="form-select" id="num_resultados">
                                        <option onclick="getTipoActividad()" value="5">5</option>
                                        <option onclick="getTipoActividad()" value="20">20</option>
                                        <option onclick="getTipoActividad()" value="50">50</option>
                                        <option onclick="getTipoActividad()" value="100">100</option>
                                </select>
                        </div>
                    </nav>

<!--Tabla que muestra los tipos de actividad que existen-->
                <div class="scroll">
                    <table id="tabla_tipo_actividad" class="table table-bordered table-responsive text-nowrap table_default">
                        <!--Datos que mostrara la tabla actividades gracias a ajax.tipo_actividad.js-->
                    </table>
                </div>
                <div>
                    <nav>
                        <ul class="pagination" id="num_paginas">
                        </ul>
                    </nav>
                </div>
            </section>
        </div>
    </main>
</body>

</html>