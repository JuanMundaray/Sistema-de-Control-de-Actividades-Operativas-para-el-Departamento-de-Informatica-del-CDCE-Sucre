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
                header("Location:../Index");
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
        <script src="../Framework/bootstrap-5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="../Framework/jquery-ui-1.13.2.custom/jquery-ui.js"></script>
        <script src="JS/js.peticiones/ajax.peticiones.js"></script>
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
                    <!--Barra de Busqueda-->
                    <nav class="navbar navbar-light ">
                    </nav>

                    <nav class="row">
                        <div class="col-md-3">
                            <label class="form-label">Numero de Resultados:</label>
                            <select class="form-select" id="num_resultados">
                                    <option onclick="getPeticiones()" value="5">5</option>
                                    <option onclick="getPeticiones()" value="20">20</option>
                                    <option onclick="getPeticiones()" value="50">50</option>
                                    <option onclick="getPeticiones()" value="100">100</option>
                            </select>
                        </div>
                        
                        <form class="form-inline col">
                            <label class="form-label">Buscar Por Nombre:</label>
                            <input class="form-control" type="search" placeholder="Buscar por Nombre..." aria-label="Search" aria-autocomplete="" id="data_busq_nombre" name="data_busq_nombre">
                        </form>
                        
                        <form class="form-inline col">
                            <label class="form-label">Buscar Por Estado:</label>
                            <select class="form-select" id="data_busq_estado" name="data_busq_estado">
                                <option value="">Todas</option>
                                <option value="ACEPTADA">Aceptadas</option>
                                <option value="ESPERA">En Espera</option>
                            </select>
                        </form>
                        
                        <form class="form-inline col">
                            <label class="form-label">Buscar Por Fecha:</label>
                            <input class="form-control" type="date" placeholder="Buscar por Fecha..." aria-label="Search" aria-autocomplete="" id="data_busq_fecha" name="data_busq_fecha">
                        </form>

                        <button class="btn btn-primary col" id="boton_buscar">Buscar</button>

                    </nav>
                    <div class="scroll">
                        <table id="tabla_peticiones" class="table table-bordered table-responsive text-nowrap table_default">
                        <!--Tabla de Peticiones dibujada por medio de js-->
                        <input type="hidden" value="<?php echo $_SESSION['tipo_usuario'] ?>" id="tipo_usuario">
                            
                        </table>
                    </div>
                    <nav>
                        <ul class="pagination" id="num_paginas">
                        </ul>
                    </nav>

                    <div class="row center-element">
                        <div class="col-md-6 center-element">
                            
                            <button class="btn btn-danger">Exportar a PDF</button>

                            <form action="../Controller/controllerPeticion.php">
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