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
        <script src="JS/js.usuarios/ajax.historial_usuarios.js"></script>
        <title>Historial de Usuarios</title>
    </head>
    <?php
        session_start();

        if((isset($_SESSION["tipo_usuario"]))){
            if(($_SESSION["tipo_usuario"]!="administrador")){
                header("Location:./Dashboard.php");
                exit();
            }
        }else{
            header("Location:../index.php");
            exit();
        }

        require_once("Plantillas/Plantilla_cabecera.php");
    ?>
    <body>
        
        
        <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->

        <main>
            <div class="contenedorPrincipal">
                <h2 class="titleh2">Historial de Usuarios</h2>
                <section class="secciones">
                    <!--Barra de Busqueda-->
                    <nav class="container">
                        <div class="row">
                            <div class="col-md-4">
                                <form>
                                    <label class="form-label">Buscar Por Nombre de Usuario:</label>
                                    <input class="form-control" type="text" id="buscar_nombre_usuario">
                                </form>
                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label">Numero de Resultados:</label>
                                <select class="form-select" id="num_resultados">
                                        <option value="5">5</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                </select>
                            </div>

                        </div>
                    </nav>
                    
                    <!--Tabla del Historial-->
                    <div class="table-responsive">
                        <table id="tabla_historial_usuarios" class="table align-middle text-nowrap table_default">
                        <tr>
                            <th><label>Nombre de Usuario</label></th>
                            <th><label>Nombre y Apellido</label></th>
                            <th><label>Cedula</label></th>
                            <th><label>Departamento</label></th>
                            <th><label>Tipo de Usuario</label></th>
                            <th><label>Fecha de Creacion</label></th>
                        </tr>
                        </table>
                        
                    </div>

                    <!--Botones de Paginacion-->
                    <nav style="margin-top: 20px;">
                        <ul class="pagination" id="num_paginas">
                        </ul>
                    </nav>
                <section>
            </div>
        </main>
    </body>
</html>