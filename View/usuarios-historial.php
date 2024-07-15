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
                                    <label class="form-label label-sm">Buscar Por Nombre de Usuario:</label>
                                    <input class="form-control form-control-sm" type="text" id="buscar_nombre_usuario">
                                </form>
                            </div>
                            <div class="col">

                            </div>
                            
                            <div class="col-md-3">
                                <label class="form-label  label-sm">Numero de Resultados:</label>
                                <select class="form-select form-select-sm" id="num_resultados">
                                        <option value="5">5</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                </select>
                            </div>

                        </div>
                    </nav>
                    
                    <!--Tabla de Contenido sobre Historial Usuarios-->
                    <div class="container mt-5">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs pb-2" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="tabla1-tab" data-bs-toggle="tab" data-bs-target="#tabla_datos_usuario" type="button" role="tab" aria-controls="tabla1" aria-selected="true">Datos de Usuario</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="tabla2-tab" data-bs-toggle="tab" data-bs-target="#tabla_datos_personales" type="button" role="tab" aria-controls="tabla2" aria-selected="false">Datos Personales del Usuario</button>
                            </li>
                        </ul>
                        
                        <!--La tabla de Historial de Usuarios-->
                        <div class="tab-content">
                            <div class="table-responsive tab-pane fade show active" id="tabla_datos_usuario" role="tabpanel">
                                <table id="tabla_usuario_1" class="table text-nowrap text-center">
                                    <thead>
                                        <tr>
                                            <th><label>ID</label></th>
                                            <th><label>Nombre</label></th>
                                            <th><label>Estado Actual</label></th>
                                            <th><label>Departamento</label></th>
                                            <th><label>Tipo</label></th>
                                            <th><label>Fecha de Creación</label></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    </tbody>

                                </table>
                            </div>
                        </div>

                        <div class="tab-content">
                            <div class="table-responsive tab-pane fade" id="tabla_datos_personales" role="tabpanel">
                                <table id="tabla_usuario_2" class="table text-nowrap text-center">
                                    <thead>
                                        <tr>
                                            <th><label>ID</label></th>
                                            <th scope='col'><label>Nombre Personal Completo</label></th>
                                            <th scope='col'><label>Cédula</label></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                    

                    <!--Botones de Paginacion-->
                    <nav style="margin-top: 20px;">
                        <ul class="pagination" id="num_paginas">
                        </ul>
                    </nav>
                <section>
            </div>

            <script src="../Framework/jquery-3.6.3.min.js"></script>
            <script src="../Framework/bootstrap-5.3.0/js/bootstrap.min.js"></script>
            <script src="../Framework/bootstrap-5.3.0/js/bootstrap.bundle.js"></script>
            <script src="Plantillas/menu_desplegable-administrador.js"></script>
            <script src="JS/js.usuarios/verUsuario/ajax.historial_usuarios.js"></script>
        </main>
    </body>
</html>