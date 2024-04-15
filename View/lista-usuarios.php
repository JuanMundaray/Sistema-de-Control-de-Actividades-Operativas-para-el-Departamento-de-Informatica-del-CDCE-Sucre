    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="../favicon.ico" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Lista de Usuarios</title>

        <link rel="stylesheet" href="../Framework/bootstrap-5.3.0/css/bootstrap.css" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="CSS/EstiloCabecera.css" type="text/css">
        <link rel="stylesheet" href="CSS/MenuDelizante.css" type="text/css">
        <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">

        <script src="../Framework/bootstrap-5.3.0/js/bootstrap.bundle.js"></script>
        <script src="../Framework/jquery-3.6.3.min.js"></script>
        <script src="./JS/js.usuarios/ajax.usuarios.js"></script>
        <script src="./Plantillas/menu_desplegable-administrador.js"></script>
        <title>Document</title>
    </head>
    <?php
        session_start();
        
        if(isset($_SESSION["tipo_usuario"])){
            if(($_SESSION["tipo_usuario"]!="administrador")){
                header("Location:./Dashboard.php");
                exit();
            }
        }else{
            header("Location:../index");
            exit();
        }

        require_once("Plantillas/Plantilla_cabecera.php");
    ?>
    <body>
        
        
        <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->

        <main>
            <h1 class="titleh1">Usuarios</h1>
            <div class="contenedorPrincipal">
                <h2 class="titleh2">Lista de Usuarios</h2>
                <section class="secciones">
                    <!--Barra de Busqueda-->
                    <nav class='container'>
                        <div class="row gx-5">
                            <!--Barras de Busqueda-->
                            <div class="col-md-4">
                                <form class="row">
                                    <label class="form-label">Buscar Por Nombre de Usuario:</label>
                                    <input class="form-control col" type="search" placeholder="Buscar Usuario..." aria-label="Search" name="nombre_usuario" id="nombre_usuario">
                                    <input type="button" class="btn btn-primary col-3" id="buscar_nombre_usuario" value="Buscar">
                                </form>
                            </div>
                            <div class="col">

                            </div>

                            <!--Numero de Resultados de las Usuarios-->
                            <div class="col-md-3">
                                <label class="form-label">Numero de Resultados:</label>
                                <select class="form-select" id="num_resultados">
                                        <option onclick="getUsuarios()" value="5">5</option>
                                        <option onclick="getUsuarios()" value="20">20</option>
                                        <option onclick="getUsuarios()" value="50">50</option>
                                        <option onclick="getUsuarios()" value="100">100</option>
                                </select>
                            </div>
                        </div>
                    </nav>
                    
                    <div class="scroll">
                        <table id="tabla_usuarios" class="table table-bordered table-responsive text-nowrap table_default">
                            <!--Tabla que sera rellenada por medio de js-->
                        </table>
                    </div>

                    <div>
                        <nav>
                            <ul class="pagination" id="num_paginas">
                            </ul>
                        </nav>
                    </div>

                    <div style="text-align: center;">
                        <form action="../Controller/controllerUsuario.php">
                            <input type="hidden" class="btn btn-success" name="option" value="exportarExcel">
                            <input type="submit" class="btn btn-success" value="Exportar a EXCEL">
                        </form>
                    </div>

                <section>
            </div>
        </main>
    </body>
</html>