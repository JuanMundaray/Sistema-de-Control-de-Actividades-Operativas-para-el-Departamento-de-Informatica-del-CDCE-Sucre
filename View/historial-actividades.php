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
        <script src="JS/ajax.actividades/ajax.historial_actividades.js"></script>
        <title>Document</title>
    </head>
    <?php
        session_start();

        if((isset($_SESSION["tipo_usuario"]))){
            if(($_SESSION["tipo_usuario"]!="administrador")){
                header("Location:./Dashboard.php");
                exit();
            }
        }else{
            header("Location:../Index");
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

                    <div class="col-md-3">
                            <label class="form-label">Numero de Resultados:</label>
                            <select class="form-select" id="num_resultados">
                                    <option onclick="getHistorialActividades()" value="5">5</option>
                                    <option onclick="getHistorialActividades()" value="20">20</option>
                                    <option onclick="getHistorialActividades()" value="50">50</option>
                                    <option onclick="getHistorialActividades()" value="100">100</option>
                            </select>
                        </div>
                    <!--Tabla del Historial-->
                    <div class="scroll">
                        <table id="tabla_historial_actividades" class="table table-bordered table-responsive text-nowrap table_default">
                            
                            
                        </table>
                        
                    </div>

                    <nav>
                        <ul class="pagination" id="num_paginas">
                        </ul>
                    </nav>

                    <div style="text-align: center;">
                        <form action="../Controller/controllerHistorialActividades.php">
                            <input type="hidden" class="btn btn-success" name="option" value="exportarExcel">
                            <input type="submit" class="btn btn-success" value="Exportar a EXCEL">
                        </form>
                    </div>

                <section>
            </div>
        </main>
    </body>
</html>