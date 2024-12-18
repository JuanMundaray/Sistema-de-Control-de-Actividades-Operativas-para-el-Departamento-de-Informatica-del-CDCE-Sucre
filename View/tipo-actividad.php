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
        <link rel="stylesheet" href="CSS/formulario.css" type="text/css">
        <script src="../Framework/bootstrap-5.3.0/js/bootstrap.js"></script>
        <script src="../Framework/jquery-3.6.3.min.js"></script>
        <script src="../Framework/jquery-ui-1.13.2.custom/jquery-ui.js"></script>
        <script src="JS/js.tipo_actividad/ajax.tipo_actividad.js"></script>
        <script src="Plantillas/menu_desplegable-administrador.js"></script>
</head>
<?php
    session_start();
    
    if(isset($_SESSION["tipo_usuario"])){
        if(($_SESSION["tipo_usuario"]!="administrador")){
            header("Location:./actividades-registrar-actividad-1.php");
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
        <h1 class="titleh1">Tipos de Actividad</h1>
        <div class="contenedorPrincipal">
        <h2 style="background-color:rgb(255, 60, 0);" class="titleh2">Tipos de Actividad</h2>
            <section class="secciones">
                
                <div>

                    <!--Boton Para ingresar al formulario para crear una nueva actividad predefinida-->
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTipoActividad">Agregar Tipo de Actividad</button>


                    <!--Barra de Busqueda-->
                    <nav class="navbar navbar-light barra_navegacion container">
                        <div style="margin-top: 20px; margin-left: -10px;" class="row gy-3">
                            <form class="form col-md-12 row">
                                <div class="col-md-4">
                                    <label class="form-label">Buscar Por Nombre:</label>
                                    <input style="width: 100%;" class="form-control" type="search" placeholder="Buscar Tipo de  Actividad..." id="data_busq_nombre" name="data_busq_nombre">
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Buscar Por Id:</label>
                                    <input style="width: 100%;" class="form-control" type="search" placeholder="Buscar Por ID..." id="data_busq_id" name="data_busq_id"> 
                                </div>
                                
                            
                        
                            <div class="col-md-4">
                                    <label class="form-label">Numero de Resultados:</label>
                                    <select class="form-select" id="num_resultados">
                                            <option value="5">5</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                    </select>
                            </div>
                            </form>
                        </div>
                    </nav>

                    <!--Tabla que muestra los tipos de actividad que existen-->
                    <div class="table-responsive">
                        <table id="tabla_tipo_actividad" class="table table-hover text-nowrap table_default">
                            <thead>
                                <tr>
                                    <th><label>ID</label></th>
                                    <th><label>Tipo de Actividad</label></th>
                                    <th><label>Acción</label></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--Datos que mostrara la tabla actividades gracias a ajax.tipo_actividad.js-->
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <nav>
                            <ul class="pagination" id="num_paginas">
                            </ul>
                        </nav>
                    </div>
                </div>
            </section>
    </main>

    <?php require_once("./Plantillas/administrarTipoActividad/modalRegistrarTipoActividad.php") ?>
    <?php require_once("./Plantillas/administrarTipoActividad/notificacionRegistro.php") ?>
    <?php require_once("./Plantillas/administrarTipoActividad/modalEliminarTipoActividad.php") ?>

    <script src="JS/js.tipo_actividad/modalTipoActividad.js"></script>
    <script src="JS/js.tipo_actividad/modal_eliminarTipoActividad.js"></script>
    <script src="JS/validar.formularios.js"></script>
</body>

</html>