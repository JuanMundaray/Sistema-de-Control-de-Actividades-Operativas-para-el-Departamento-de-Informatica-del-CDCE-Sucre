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
        
        <script src="../Framework/jquery-3.6.3.min.js"></script>
        <script src="../Framework/jquery-ui-1.13.2.custom/jquery-ui.js"></script>
        <script src="../Framework/bootstrap-5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="JS/js.peticiones/ajax.misPeticiones.js"></script>
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
                        <form class="col-md-12 col-sm-12 gy-2 row">
                            <div class="col">
                                <label class="form-label">Buscar Por Nombre:</label>
                                <input class="form-control" type="search" placeholder="Buscar por Nombre..." aria-label="Search" aria-autocomplete="" id="data_busq_nombre" name="data_busq_nombre">
                            </div>

                            <input type="hidden" value="<?php echo $_SESSION['id_usuario'] ?>" id="id_usuario_sesion">

                            <div class="col">
                                <label class="form-label">Buscar Por Fecha:</label>
                                <input class="form-control" type="date" placeholder="Buscar por Fecha..." aria-label="Search" aria-autocomplete="" id="data_busq_fecha" name="data_busq_fecha">
                            </div>
                        </form>

                        <div class="col-md-6">
                            <label class="form-label">Buscar Por Estado:</label>
                            <select class="form-select" id="data_busq_estado">
                                <option value="">Todas</option>
                                <option value="ACEPTADA">Aceptadas</option>
                                <option value="ESPERA">En Espera</option>
                            </select>
                        </div>

                        <div class="col col-md-6">
                            <label class="form-label">Numero de Resultados:</label>
                            <select class="form-select" id="num_resultados">
                                    <option value="5">5</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                            </select>
                        </div>
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

                    <!--Botones para Generar Reportes de la tabla-->
                    <div class="row center-element">
                        <div class="col-md-6 center-element">

                            <form action="../Controller/controllerPeticion.php">
                                <input type="hidden" name="id_usuario" value=<?php echo $_SESSION['id_usuario'] ?>>
                                <input type="hidden" name="option" value="exportarExcel">
                                <input type="submit" class="btn btn-success" value="Exportar a EXCEL">
                            </form>
                        <div>
                    </div>
                    </div>
                <section>
            </div>
        </main>
    </body>
</html>