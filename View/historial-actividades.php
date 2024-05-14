    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8"><link rel="icon" href="../favicon.ico" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../Framework/bootstrap-5.3.0/css/bootstrap.css" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="CSS/EstiloCabecera.css" type="text/css">
        <link rel="stylesheet" href="CSS/MenuDelizante.css" type="text/css">
        <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">

        <script src="../Framework/jquery-3.6.3.min.js"></script>
        <script src="Plantillas/menu_desplegable-administrador.js"></script>
        <script src="JS/js.actividades/ajax.historial_actividades.js"></script>
        <script src="../Framework/bootstrap-5.3.0/js/bootstrap.bundle.min.js"></script>
        <title>Historial Actividades</title>
    </head>
    <?php
        session_start();

        if((isset($_SESSION["tipo_usuario"]))){
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
            <div class="contenedorPrincipal">
                <h2 class="titleh2">Historial de Actividades</h2>
                <section class="secciones">

                    <!--Área de Busqueda-->
                    <nav class="navbar navbar-light container" id="mostrarSolo">

                        <div class="row gy-4 col-md-12">
                            <!--Nombre de Actividad y boton para abrir los filtros-->
                            <div class="col-md-6">
                                <div>
                                    <label class="form-label">Nombre de Actividad:</label>
                                </div>

                                <div>
                                    <input class="form-control" type="search" placeholder="Buscar por Nombre..." aria-label="Search" id="data_busq_nombre" name="data_busq_nombre">

                                    <button class="btn btn-primary"  data-bs-toggle="collapse" data-bs-target="#collapse_filtros_busq" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
                                            <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                    
                            <!--Numero de Resultados de las actividades-->
                            <div class=col-md-4>
                                <label class="form-label">Numero de Resultados:</label>
                                <select class="form-select" id="num_resultados">
                                        <option value="5">5</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                </select>
                            </div>

                            <!--Filtros de Busqueda-->
                            <div class="gy-4 col-md-12 collapse bg-light row" style="margin-left: 15px;" id="collapse_filtros_busq">
                                <h3>Filtros de Búsqueda</h3>

                                <div class="col-md-3">
                                    <label class="form-label">Fecha de Actividad:</label>
                                    <input style="width: 100%;" class="form-control" type="date" placeholder="Buscar por Fecha..." aria-label="Search" id="data_busq_fecha" name="data_busq_fecha">
                                </div>

                                <div class="col-md-3">
                                    <label class="form-label">Filtrar Por estado:</label>
                                    <select class="form-select" id="estado_actividad">
                                            <option value="">Todas</option>
                                            <option value="INICIADA">Iniciadas</option>
                                            <option value="PROCESO">En Proceso</option>
                                            <option value="COMPLETADA">Completadas</option>
                                            <option value="SUSPENDIDA">Suspendidas</option>
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <button class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#collapse_filtros_busq" aria-expanded="false" id="buscar_aplicar_filtros_busq">Aplicar
                                    </button>
                                </div>
                            
                            </div>
                        </div>
                    </nav>


                    <!--Tabla del Historial-->
                    <div class="table-responsive">
                        <table id="tabla_historial_actividades" class="table text-nowrap table_default">
                            <!--Tabla del Historial-->
                        </table>
                    </div>
                    
                    <!--Botones de Paginacion-->
                    <nav style="margin-top: 20px;">
                        <ul class="pagination" id="num_paginas">
                        </ul>
                    </nav>


                    <!--Boton para Generar Reportes de las Actividades Registradas-->
                    <div class="center-element dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <label>Exportar Tabla</label>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-table" viewBox="0 2 16 16">
                                <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm15 2h-4v3h4V4zm0 4h-4v3h4V8zm0 4h-4v3h3a1 1 0 0 0 1-1v-2zm-5 3v-3H6v3h4zm-5 0v-3H1v2a1 1 0 0 0 1 1h3zm-4-4h4V8H1v3zm0-4h4V4H1v3zm5-3v3h4V4H6zm4 4H6v3h4V8z"/>
                            </svg>
                        </button>
                        <ul class="dropdown-menu">

                            <li>
                                <form method="post" action="./actividades-exportar.php">
                                    <input type="hidden" name='todas' id="todas" value="true">
                                    <input type="hidden" name="option" value="exportarPDF">
                                    <button class="dropdown-item">
                                        <span class="d-inline-block bg-danger rounded-circle" style="width: .5em; height: .5em;"></span> Exportar a PDF
                                    </button>
                                </form>
                            </li>

                            <li>
                                <form action="./actividades-exportar.php">
                                    <input type="hidden" name="todas" id="todas" value="true">
                                    <input type="hidden" name="option" value="exportarExcel">
                                    <button class="dropdown-item">
                                        <span class="d-inline-block bg-success rounded-circle" style="width: .5em; height: .5em;"></span> Exportar a Excel
                                    </button>
                                </form>
                            </li>
                        </ul>
                    <div>
                <section>
            </div>
        </main>
    </body>
</html>