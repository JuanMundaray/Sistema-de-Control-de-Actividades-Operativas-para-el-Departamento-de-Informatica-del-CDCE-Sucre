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
        <script src="../Framework/jquery-ui-1.13.2.custom/jquery-ui.js"></script>
        <script src="JS/ajax.peticiones.js"></script>
        <script src="JS/ajax.peticiones.funciones.js"></script>
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
                            <form class="form-inline">
                                    <input class="form-control" type="search" placeholder="Buscar por Nombre..." aria-label="Search" aria-autocomplete="dasa" id="data_busq_peticion" name="data_busq_peticion">
                                    
                                    <input type="button" class="btn btn-outline-primary" id="buscar_peticion" value="Buscar">
                            </form>
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
                <section>
            </div>
        </main>
    </body>
</html>