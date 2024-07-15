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
        <title>Mis Actividades Registradas</title>

    </head>

    <?php
        require_once("Plantillas/Plantilla_cabecera.php");
    ?>
    <body>  
        
        <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->

        <main>
            <input type="hidden" value="<?php echo $_SESSION['tipo_usuario'] ?>" id="tipo_usuario">
            <h1 class="titleh1">Actividades Operativas Registradas del Usuario</h1>
            <div class="contenedorPrincipal">
                <h2 class="titleh2">Mis Actividades Registradas</h2>
                <section class="secciones">

                    <!--Link a la Pagina de Registrar Actividades-->
                    <a href="actividades-registrar-actividad-1.php"><button class="btn btn-primary" >Registrar Actividad</button></a>   
                    
                    <!--Filtros de Busqueda-->
                    <nav class="navbar navbar-light container"  style="margin-top: 20px;" id="mostrarSolo">

                        <!--Nombre de Actividad y boton para abrir los filtros-->
                        <div class='collapse p-3 mb-2 bg-light bg-gradient rounded' id="collapseFiltros">
                            <h5>Filtros de Busqueda:</h5>
                            <div class="d-flex align-items-end ">
                                <div class="overflow-auto">
                                    <div class="d-flex" style="width:40v;">
                                        <div class="p-2">
                                            <label class="label-sm form-label  text-nowrap">Nombre de Actividad:</label>
                                            <input style="width: 100%;" class="form-control form-control-sm" type="search" placeholder="Buscar por Nombre..." aria-label="Search" id="data_busq_nombre" name="data_busq_nombre">
                                        </div>
                                        
                                        <div class="p-2 no-wrap">
                                            <label class="label-sm form-label text-nowrap">Día de Registro:</label>
                                            <select class="form-select" id="day">
                                                <option value="">Cuaquiera</option>
                                            </select>
                                        </div>

                                        <div class="p-2 no-wrap">
                                            <label class="label-sm form-label text-nowrap">Mes de Registro:</label>
                                            <select class="form-select" id="month">
                                                <option value="">Cuaquiera</option>
                                                <option value="1">Enero</option>
                                                <option value="2">Febrero</option>
                                                <option value="3">Marzo</option>
                                                <option value="4">Abril</option>
                                                <option value="5">Mayo</option>
                                                <option value="6">Junio</option>
                                                <option value="7">Julio</option>
                                                <option value="8">Agosto</option>
                                                <option value="9">Septiembre</option>
                                                <option value="10">Octubre</option>
                                                <option value="11">Noviembre</option>
                                                <option value="12">Diciembre</option>
                                            </select>
                                        </div>

                                        <div class="p-2 no-wrap">
                                            <label class="label-sm form-label text-nowrap">Año de Registro:</label>
                                            <select class="form-select" id="year">
                                                <option value="">Cuaquiera</option>
                                            </select>
                                        </div>

                                        <div class="p-2 text-nowrap">
                                            <label class="label-sm form-label">Filtrar Por estado:</label>
                                            <select class="form-select form-select-sm" id="estado_actividad">
                                                    <option value="">Todas</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="p-2">
                                    <button class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#collapseFiltros" aria-expanded="false" aria-controls="collapseFiltros" id="aplicar_filtro">Aplicar
                                    </button>
                                </div>
                                
                            </div>
                        </div>

                        <!--Numero de Resultados de las actividades y boton de filtro de busqueda-->
                        <div style="width: 100%;" class='d-flex flex-row align-items-end mb-2'>
                            <div class="me-auto">
                                <label class="label-sm form-label">Numero de Resultados:</label>
                                <select class="form-select" id="num_resultados">
                                        <option value="5">5</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                </select>
                            </div>

                            <div>
                                <button class="btn btn-primary rounded-3" data-bs-toggle="collapse" data-bs-target="#collapseFiltros" aria-expanded="false" aria-controls="collapseFiltros">
                                    Filtrar Resultados
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel-fill" viewBox="0 0 16 16">
                                        <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </nav>
                    

                    <!--La tabla de Actividades-->
                    <?php require_once("./Plantillas/administrarActividades/tabla_actividades/tabla.php") ?>
                    
                    <!--Botones de Paginacion-->
                    <div>
                        <nav style="margin-top: 20px;">
                            <ul class="pagination" id="num_paginas">
                            </ul>
                        </nav>
                    </div>

                    <!--Boton para Generar Reportes de las Actividades Registradas-->
                    <div class="center-element dropdown">
                        <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <label>Generar Reporte </label>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                                <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                                <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                            </svg>
                        </button>
                        <ul class="dropdown-menu">

                            <li>
                                <form method="post" action="./actividades-exportar.php">
                                    <input type="hidden" value="<?PHP echo $_SESSION['id_usuario']?>" name='id_usuario_sesion' id="id_usuario_sesion">
                                    <input type="hidden" name="option" value="exportarPDF">
                                    <button class="dropdown-item">
                                        <span class="d-inline-block bg-danger rounded-circle" style="width: .5em; height: .5em;"></span> Exportar a PDF
                                    </button>
                                </form>
                            </li>

                            <li>
                                <form method="post" action="./actividades-exportar.php">
                                    <input type="hidden" value="<?PHP echo $_SESSION['id_usuario']?>" name='id_usuario_sesion' id="id_usuario_sesion">
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

        <!--Requerir los Modales para las acciones que el usuario puede hacer con la actividad-->
            <?php require_once("./Plantillas/administrarActividades/modals/modal_VerSeguimientoActividad.php") ?>
            <?php require_once("./Plantillas/administrarActividades/modals/modal_EditarActividad.php") ?>
            <?php require_once("./Plantillas/administrarActividades/modals/modal_VerDetalles.php") ?>
            <?php require_once("./Plantillas/administrarActividades/modals/modal_Eliminar.php") ?>
            <?php require_once("./Plantillas/administrarActividades/toast/toast.php") ?>
            <?php require_once("./Plantillas/administrarActividades/toast/toastSinResultados.php") ?>
            
        <script src="../Framework/bootstrap-5.3.0/js/bootstrap.bundle.js "></script>
        <script src="../Framework/jquery-3.6.3.min.js"></script>
        <script src="../Framework/jquery-ui-1.13.2.custom/jquery-ui.js"></script>
        <script src="JS/js.actividades/VerActividades/ajax.mis_actividades.js" type="module"></script>
        <script src="JS/obtenerListaDay_Month_Year.js"></script>
                <script src="./JS/js.actividades/mensaje.js"></script>

        </main>
    </body>
</html>