<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <link rel="stylesheet" href="../Framework/bootstrap-5.3.0/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="CSS/EstiloCabecera.css" type="text/css">
    <link rel="stylesheet" href="CSS/MenuDelizante.css" type="text/css">
    <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">
    <script src="../Framework/jquery-3.6.3.min.js"></script>
    <script src="../Framework/jquery-ui-1.13.2.custom/jquery-ui.js"></script>
    <script src="JS/ajax.tipo_actividad.js"></script>
    <script src="Plantillas/menu_desplegable-administrador.js"></script>
    

</head>
<?php
    require_once("Plantillas/Plantilla_cabecera.php");
?>
<body>
    <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->
    <main>
        <h1 class="titleh1">Tipo de Actividad</h1>
        <div class="contenedorPrincipal">
        <h2 class="titleh2">Tipos de Actividad</h2>
            <section class="secciones">
                
                <div>

<!--Boton Para ingresar al formulario para crear una nueva actividad predefinida-->
                    <a class="btn btn-primary" href="tipo-actividad-crear" role="button">Crear Tipo de Actividad</a>

                    <!--Barra de Busqueda-->
                    <nav class="navbar navbar-expand-lg navbar-light barra_navegacion">
                        <form method="post" class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2" type="search" placeholder="Buscar Tipo de  Actividad..." aria-label="Buscar" id="data_busq" name="data_busq">
                            <button class="btn btn-primary my-2 my-sm-0" id="buscar_tipo_act">Buscar</button>
                        </form>
                    </nav>

                    
                    <div class="col-md-3">
                            <label class="form-label">Numero de Resultados:</label>
                            <select class="form-select" id="num_resultados">
                                    <option onclick="getTipoActividad()" value="5">5</option>
                                    <option onclick="getTipoActividad()" value="20">20</option>
                                    <option onclick="getTipoActividad()" value="50">50</option>
                                    <option onclick="getTipoActividad()" value="100">100</option>
                            </select>
                    </div>

<!--Tabla que muestra los tipos de actividad que existen-->
                <div class="scroll">
                    <table id="tabla_tipo_actividad" class="table table-bordered table-responsive text-nowrap table_default">
                        <!--Datos que mostrara la tabla actividades gracias a ajax.tipo_actividad.js-->
                    </table>
                </div>
                    <nav>
                        <ul class="pagination" id="num_paginas">
                        </ul>
                    </nav>
                </div>
            </section>
        </div>
    </main>
</body>

</html>