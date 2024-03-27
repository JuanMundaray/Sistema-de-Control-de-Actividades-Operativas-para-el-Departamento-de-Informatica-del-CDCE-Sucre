    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../Framework/bootstrap-5.3.0/css/bootstrap.css" type="text/css">
        <link rel="stylesheet" href="CSS/EstiloCabecera.css" type="text/css">
        <link rel="stylesheet" href="CSS/MenuDelizante.css" type="text/css">
        <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">
        <link rel="stylesheet" href="../Framework/jquery-ui-1.13.2.custom/jquery-ui.css" type="text/css">
        <script src="../Framework/bootstrap-5.3.0/js/bootstrap.bundle.js "></script>
        <script src="../Framework/jquery-3.6.3.min.js"></script>
        <script src="../Framework/jquery-ui-1.13.2.custom/jquery-ui.js"></script>
        <script src="JS/ajax.actividades.js"></script>
        <script src="JS/ajax.actividades.funciones.js"></script>
        <script src="JS/ajax.actividades.autocompletar.js"></script>
        <script src="JS/menu_desplegable-administrador.js"></script>
        <title>Actividades Registradas</title>

    </head>
    <?php
            require_once("Plantillas/Plantilla_cabecera.php");
    ?>
    <body>  
        
        <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->

        <main>
            <h1 class="titleh1">Actividades Registradas</h1>
            <div class="contenedorPrincipal">
                <h2 class="titleh2">Actividades Registradas</h2>
                <section class="secciones">
                    <a href="registrar-actividad.php"><button class="btn btn-primary" >Registrar Actividad</button></a>
                    <!--Barra de Busqueda-->
                    <nav class="navbar navbar-light row">
                            <form class="form-inline">
                                <input class="form-control" type="search" placeholder="Buscar por Nombre..." aria-label="Search" id="data_busq" name="data_busq">
                                
                                <input type="button" class="btn btn-outline-primary" id="buscar_act" value="Buscar">
                            </form>

                            <form class="form-inline">
                                <input class="form-control" type="date" placeholder="Buscar por Fecha..." aria-label="Search" id="data_busq_fecha" name="data_busq_fecha">
                                
                                <input type="button" class="btn btn-outline-primary" id="buscar_act_fecha" value="Buscar">
                            </form>
                            <form class="form-inline">
                                <input class="form-control" type="search" placeholder="Buscar por Codigo..." aria-label="Search" id="data_busq_codigo" name="data_busq_codigo">
                                
                                <input type="button" class="btn btn-outline-primary" id="buscar_act_codigo" value="Buscar">
                            </form>
                            
                    </nav>

                    <nav class="row">
                        <div class="col-md-2">
                            <label class="form-label">Ver solo las:</label>
                            <select class="form-select" id="estado_filt">
                                    <option id="filt_iniciada" value="INICIADA">Iniciadas</option>
                                    <option id="filt_proceso" value="PROCESO">En Proceso</option>
                                    <option id="filt_completada" value="COMPLETADA">Completadas</option>
                                    <option id="filt_suspendida" value="SUSPENDIDA">Suspendidas</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Numero de Resultados:</label>
                            <select class="form-select" id="num_resultados">
                                    <option onclick="getActividades()" value="5">5</option>
                                    <option onclick="getActividades()" value="20">20</option>
                                    <option onclick="getActividades()" value="50">50</option>
                                    <option onclick="getActividades()" value="100">100</option>
                            </select>
                        </div>

                    </nav>
                    <div class="scroll">
                        <table id="tabla_actividades" class="table table-bordered table-responsive text-nowrap table_default">
                            <tr>
                                <th><label>Codigo de Registro</label></th>
                                <th><label>Fecha de Registro</label></th>
                                <th><label>Actividad</label></th>
                                <th><label>Tipo de Actividad</label></th>
                                <th><label>Departamento Receptor</label></th>
                                <th><label>Departamento Emisor</label></th>
                                <th><label>Nombre del Responsable</label></th>
                                <th><label>Cedula del Responsable</label></th>
                                <th><label>Funcionario Atendido</label></th>
                                <th><label>Cedula del Funcionario Atendido</label></th>
                                <th><label>Estado</label></th>
                                <th colspan="3"><label>Accion</label></th>
                            </tr>
                            
                        </table>
                    </div>
                    
                    <nav>
                        <ul class="pagination" id="num_paginas">
                        </ul>
                    </nav>
                    <div class="row center_elem">
                        <div class="col-md-6 center_elem">
                            <button class="btn btn-danger">Exportar a PDF</button>
                            
                            <button class="btn btn-success">Exportar a EXCEL</button>
                        <div>
                    </div>
                <section>
            </div>
        </main>
    </body>
</html>