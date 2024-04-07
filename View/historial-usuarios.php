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
        <script src="JS/ajax.historial_usuarios.js"></script>
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
            header("Location:../Index");
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

                    <div class="col-md-3">
                            <label class="form-label">Numero de Resultados:</label>
                            <select class="form-select" id="num_resultados">
                                    <option onclick="getHistorialUsuarios()" value="5">5</option>
                                    <option onclick="getHistorialUsuarios()" value="20">20</option>
                                    <option onclick="getHistorialUsuarios()" value="50">50</option>
                                    <option onclick="getHistorialUsuarios()" value="100">100</option>
                            </select>
                        </div>
                    <!--Tabla del Historial-->
                    <div class="scroll">
                        <table id="tabla_historial_usuarios" class="table table-bordered table-responsive text-nowrap table_default">
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

                    <nav>
                        <ul class="pagination" id="num_paginas">
                        </ul>
                    </nav>

                    <div>
                        <div style="text-align: center;">
                            <button class="btn btn-danger">Exportar a PDF</button>
                            
                            <button class="btn btn-success">Exportar a EXEL</button>
                        </div>
                    </div>
                <section>
            </div>
        </main>
    </body>
</html>