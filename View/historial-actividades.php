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
            header("Location:../Index.php");
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

                    <!--Barra de Busqueda-->
                    <nav class="navbar navbar-light container" id="mostrarSolo">
                        <div method="post" class="form-inline row">
                            <div class="col-md-12 row">
                                <div class="col-4">
                                    <input class="form-control" type="search" placeholder="Buscar por Nombre..." aria-label="Search" id="data_busq_nombre" name="data_busq_nombre">
                                </div>
                                <div class="col-4">
                                    <input style="width: 100%;" class="form-control" type="date" placeholder="Buscar por Fecha..." aria-label="Search" id="data_busq_fecha" name="data_busq_fecha">
                                </div>
                                <div class="col-3">
                                    <input class="form-control" type="search" placeholder="Buscar por Codigo..." aria-label="Search" id="data_busq_codigo" name="data_busq_codigo">
                                </div>
                                <div class="col-md-1 col-xm-1">
                                    <button class="btn btn-primary" id="buscar_actividad_boton">Buscar</button>
                                </div>
                            </div>

                            <div class="col row gy-3">
                                <div class="col-4">
                                    <label class="form-label">Filtrar Por estado:</label>
                                    <select class="form-select" id="estado_actividad">
                                            <option onclick="getHistorialActividades()" value="">Todas</option>
                                            <option onclick="getHistorialActividades()" value="INICIADA">Iniciadas</option>
                                            <option onclick="getHistorialActividades()" value="PROCESO">En Proceso</option>
                                            <option onclick="getHistorialActividades()" value="COMPLETADA">Completadas</option>
                                            <option onclick="getHistorialActividades()" value="SUSPENDIDA">Suspendidas</option>
                                            <option onclick="getHistorialActividades()" value="ELIMINADA">Eliminadas</option>
                                    </select>
                                </div>
                                <!--Numero de Resultados de las actividades-->
                                <div class=col-4>
                                    <label class="form-label">Numero de Resultados:</label>
                                    <select class="form-select" id="num_resultados">
                                            <option onclick="getHistorialActividades()" value="5">5</option>
                                            <option onclick="getHistorialActividades()" value="20">20</option>
                                            <option onclick="getHistorialActividades()" value="50">50</option>
                                            <option onclick="getHistorialActividades()" value="100">100</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </nav>

                    <!--Tabla del Historial-->
                    <div class="table-responsive">
                        <table id="tabla_historial_actividades" class="table table-bordered text-nowrap table_default">
                            <!--Tabla del Historial-->
                        </table>
                    </div>
                    <!--Fin Tabla del Historial-->

                    <nav style="margin-top: 20px;">
                        <ul class="pagination" id="num_paginas">
                        </ul>
                    </nav>

                    <div class="row center-element">
                        <div class="col center-element">
                            <form method="post" action="../Controller/controllerActividad.php">
                                        <input type="hidden" value="1" name='historial' id="historial">
                                        <input type="hidden" class="btn btn-success" name="option" value="exportarPDF">
                                        <input type="submit" class="btn btn-danger" value="Exportar a PDF">
                            </form>
                            <form action="../Controller/controllerHistorialActividades.php">
                                <input type="hidden" class="btn btn-success" name="option" value="exportarExcel">
                                <input type="submit" class="btn btn-success" value="Exportar a EXCEL">
                            </form>
                        </div>
                    </div>

                <section>
            </div>
        </main>
    </body>
</html>