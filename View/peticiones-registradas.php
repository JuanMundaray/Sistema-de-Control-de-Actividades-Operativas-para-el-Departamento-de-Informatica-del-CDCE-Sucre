    <!DOCTYPE html>
    <html lang="es">
    <head>
        <?php
            session_start();
            if(isset($_SESSION["tipo_usuario"])){
                if($_SESSION['tipo_usuario']!='invitado'){
                    if($_SESSION["tipo_usuario"]=="estandar"){
                        echo '<script src="Plantillas/menu_desplegable-estandar.js"></script>';
                    }
                    if($_SESSION["tipo_usuario"]=="administrador"){
                        echo '<script src="Plantillas/menu_desplegable-administrador.js"></script>';
                    }
                }
                else{
                    header("Location:./peticiones-registradas-propias.php");
                    exit();
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
        
        <title>Actividades Registradas</title>
    </head>
    <?php
            require_once("Plantillas/Plantilla_cabecera.php");
    ?>

    <body>
        <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->

        <main>
            <h1 class="titleh1">Peticiones</h1>

            <div class="contenedorPrincipal">
                <h2 class="titleh2">Lista de Peticiones</h2>
                <section class="secciones">

                    <!--Área de Busqueda-->
                    <nav class="navbar navbar-light row gy-4">
                        <div class="collapse p-3 mb-2 bg-light bg-gradient rounded" id="collapseFiltros">
                            <h4 class="py-2">Filtros de Busqueda</h4>
                            <div class="d-flex align-items-end gap-4">
                                <div>
                                    <label class="label-sm form-label">Nombre de Peticion:</label>
                                    <input class="form-control label-sm " type="search" placeholder="Buscar por Nombre..." aria-label="Search" aria-autocomplete="" id="data_busq_nombre" name="data_busq_nombre">
                                </div>
                                
                                <div>
                                    <label class="label-sm form-label text-nowrap">Día de Registro:</label>
                                    <select class="form-select" id="day">
                                        <option value="">Cuaquiera</option>
                                    </select>
                                </div>

                                <div>
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

                                <div>
                                    <label class="label-sm form-label text-nowrap">Año de Registro:</label>
                                    <select class="form-select" id="year">
                                        <option value="">Cuaquiera</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="label-sm col-md-12 form-label">Departamento Receptor:</label>
                                    <select class="col-md-12 form-select" name="departamento_peticion" id="departamento_peticion">
                                        <option selected disabled value="">Seleccione...</option>
                                    </select>
                                </div>
                                <div>
                                    <button class="btn btn-primary" id="aplicar_filtro" data-bs-toggle="collapse" data-bs-target="#collapseFiltros" aria-expanded="false" >Aplicar</button>
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
                    <!--Tabla de Peticiones dibujada por medio de js-->
                    <div class="table-responsive">
                        <table id="tabla_peticiones" class="table align-middle text-nowrap table_default">
                        <!--Tabla de Peticiones dibujada por medio de js-->
                        <input type="hidden" value="<?php echo $_SESSION['tipo_usuario'] ?>" id="tipo_usuario">
                            
                        </table>
                    </div>
                    
                    <!--Botones de Paginacion-->
                    <nav style="margin-top: 20px;">
                        <ul class="pagination" id="num_paginas">
                        </ul>
                    </nav>

                </section>
            </div>
        </main>

        <script src="../Framework/jquery-3.6.3.min.js"></script>
        <script src="../Framework/jquery-ui-1.13.2.custom/jquery-ui.js"></script>
        <script src="../Framework/bootstrap-5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="JS/js.peticiones/ajax.peticiones.js"></script>
        <script src="JS/obtenerListaDay_Month_Year.js"></script>
    </body>
</html>