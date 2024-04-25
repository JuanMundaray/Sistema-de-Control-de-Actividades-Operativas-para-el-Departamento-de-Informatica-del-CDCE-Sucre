    <!DOCTYPE html>
    <html lang="es">
    <head>
        <?php
            session_start();
            if(isset($_SESSION["tipo_usuario"])){
                if($_SESSION["tipo_usuario"]=="estandar"){
                    echo '<script src="Plantillas/menu_desplegable-estandar.js"></script>';
                }
                if($_SESSION["tipo_usuario"]=="administrador"){
                    echo '<script src="Plantillas/menu_desplegable-administrador.js"></script>';
                }
                if($_SESSION["tipo_usuario"]=="invitado"){
                    header("Location:./Dashboard.php");
                    exit();
                }
            }
            else{
                header("Location:../index.php");
                exit();
            }
        ?>
        <link rel="icon" href="../favicon.ico" />
        <meta charset="UTF-8"><link rel="icon" href="../favicon.ico" />
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
        <script src="JS/js.actividades/ajax.actividades.js"></script>
        <script src="JS/js.actividades/ajax.actividades.autocompletar.js"></script>
        <title>Actividades Registradas</title>

    </head>

    <?php
        require_once("Plantillas/Plantilla_cabecera.php");
    ?>

    <body>  
        
        <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->

        <main>

            <!--id del usuario que tienen abierta la sesion-->
            <input type="hidden" value="<?PHP echo $_SESSION['tipo_usuario']?>" id="tipo_usuario">
            <!----------------------------------------------->
            <h1 class="titleh1">Actividades Registradas</h1>
            
            <div class="contenedorPrincipal">
                <h2 class="titleh2">Actividades Registradas</h2>
                <section class="secciones">

                    <!--Link a la Pagina de Registrar Actividades-->
                    <a href="registrar-actividad.php"><button class="btn btn-primary" >Registrar Actividad</button></a>
                    
                    <!--Barra de Busqueda-->
                    
                    <nav class="navbar navbar-light container" id="mostrarSolo">
                        <div class="form-inline row">
                            <div class="col-md-12 row">
                                <div class="col-md-3">
                                    <input class="form-control" type="search" placeholder="Buscar por Nombre..." aria-label="Search" id="data_busq_nombre" name="data_busq_nombre">
                                </div>
                                <div class="col-md-3">
                                    <input style="width: 100%;" class="form-control" type="date" placeholder="Buscar por Fecha..." aria-label="Search" id="data_busq_fecha" name="data_busq_fecha">
                                </div>
                                <div class="col-md-3">
                                    <input class="form-control" type="search" placeholder="Buscar por Codigo..." aria-label="Search" id="data_busq_codigo" name="data_busq_codigo">
                                </div>
                                <div class="col-md-1 ">
                                    <button class="btn btn-primary" id="buscar_actividad_boton">Buscar</button>
                                </div>
                            </div>

                            <div class="col row gy-3">
                                <div class="col-md-6">
                                    <label class="form-label">Filtrar Por estado:</label>
                                    <select class="form-select" id="estado_actividad">
                                            <option value="">Todas</option>
                                            <option value="INICIADA">Iniciadas</option>
                                            <option value="PROCESO">En Proceso</option>
                                            <option value="COMPLETADA">Completadas</option>
                                            <option value="SUSPENDIDA">Suspendidas</option>
                                    </select>
                                </div>
                                <!--Numero de Resultados de las actividades-->
                                <div class=col-md-6>
                                    <label class="form-label">Numero de Resultados:</label>
                                    <select class="form-select" id="num_resultados">
                                            <option value="5">5</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </nav>

                    <!--La tabla-->
                    <div class="table-responsive">
                        <table id="tabla_actividades" class="table text-nowrap table_default">
                        <tr>
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
                            <th><label>Accion</label></th>
                        </tr>
                        <!--La tabla se rellena por medio de el archivo ajax.actividades.js-->
                        </table>
                    </div>
                    <div>
                        <nav style="margin-top: 20px;">
                            <ul class="pagination" id="num_paginas">
                            </ul>
                        </nav>
                    </div>

                    <div class="row center-element">
                        <div class="col-md-6 center-element">
                            <form action="../Controller/controllerActividad.php">
                                <input type="hidden" class="btn btn-success" name="option" value="exportarPDF">
                                <input type="submit" class="btn btn-danger" value="Exportar a PDF">
                            </form>

                            <form action="../Controller/controllerActividad.php">
                                <input type="hidden" class="btn btn-success" name="option" value="exportarExcel">
                                <input type="submit" class="btn btn-success" value="Exportar a EXCEL">
                            </form>
                        <div>
                    </div>
                <section>
            </div>
        </main>
    </body>
</html>