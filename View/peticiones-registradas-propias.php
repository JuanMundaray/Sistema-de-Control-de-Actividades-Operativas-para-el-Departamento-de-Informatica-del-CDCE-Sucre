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
        ?>

        <meta charset="UTF-8"><link rel="icon" href="../favicon.ico" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../Framework/bootstrap-5.3.0/css/bootstrap.css" type="text/css">
        <link rel="stylesheet" href="CSS/EstiloCabecera.css" type="text/css">
        <link rel="stylesheet" href="CSS/MenuDelizante.css" type="text/css">
        <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">
        <link rel="stylesheet" href="../Framework/jquery-ui-1.13.2.custom/jquery-ui.css" type="text/css">
        <title>Mis Peticiones</title>
        
    </head>
    <?php
            require_once("Plantillas/Plantilla_cabecera.php");
        ?>
    <body>
        
        
        <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->

        <main>

            <h1 class="titleh1">Mis Peticiones</h1>
            <div class="contenedorPrincipal">
                <h2 class="titleh2">Lista de Peticiones</h2>
                <section class="secciones">
                    <!--Area de Busqueda-->
                    <nav class="navbar navbar-light row gy-4">
                        <div class="d-flex">
                            
                            <div>
                                <input class="form-control" type="search" placeholder="Buscar por Nombre..." aria-label="Search" aria-autocomplete="" id="data_busq_nombre" name="data_busq_nombre">
                                
                                <button class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#collapse_filtros_busq" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
                                        <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                                    </svg>
                                </button>
                            </div>

                        </div>
                        
                        <nav class="col-md-12 col-sm-12 collapse row gy-4 navbar navbar-light bg-light" id="collapse_filtros_busq" style="margin-left: 15px;">

                            <input type="hidden" value="<?php echo $_SESSION['id_usuario'] ?>" id="id_usuario_sesion">

                            <div class="col-md-3">
                                <label class="form-label">Fecha de Peticion:</label>
                                <input class="form-control" type="date" placeholder="Buscar por Fecha..." id="data_busq_fecha" name="data_busq_fecha">
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Estados de Peticion:</label>
                                <select class="form-select" id="data_busq_estado">
                                    <option value="">Todas</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Numero de Resultados:</label>
                                <select class="form-select" id="num_resultados">
                                        <option value="5">5</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <button class="btn btn-primary" id='boton_aplicar_filtros_busq'  data-bs-toggle="collapse" data-bs-target="#collapse_filtros_busq" aria-expanded="false">Aplicar</button>
                            </div>

                        </nav>
                    </nav>
                    
                    <!--Tabla de Peticiones dibujada por medio de js-->
                    <div class="table-responsive">
                        <table id="tabla_peticiones" class="table  align-middle text-nowrap table_default">
                        <tr>
                            <th><label>Nombre de Peticion</label></th>
                            <th><label>Usuario que registro la peticion</label></th>
                            <th><label>Departamento de la Peticion</label></th>
                            <th><label>Fecha de la Peticion</label></th>
                            <th><label>Estado de Peticion</label></th>
                        </tr>
                        </table>
                    </div>

                    <!--Botones de Paginacion-->
                    <nav style="margin-top: 20px;">
                        <ul class="pagination" id="num_paginas">
                        </ul>
                    </nav>
                <section>
            </div>
        </main>
        
        <script src="../Framework/jquery-3.6.3.min.js"></script>
        <script src="../Framework/jquery-ui-1.13.2.custom/jquery-ui.js"></script>
        <script src="../Framework/bootstrap-5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="JS/js.peticiones/ajax.misPeticiones.js">import './funciones_modulares/ajax.obtener_estado_peticion';</script>
    </body>
</html>