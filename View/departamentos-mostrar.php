<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><link rel="icon" href="../favicon.ico" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departamentos</title>
        <link rel="stylesheet" href="../Framework/bootstrap-5.3.0/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="CSS/EstiloCabecera.css" type="text/css">
    <link rel="stylesheet" href="CSS/MenuDelizante.css" type="text/css">
    <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">
    <script src="../Framework/jquery-3.6.3.min.js"></script>
    <script src="../Framework/jquery-ui-1.13.2.custom/jquery-ui.js"></script> 
    <script src="./JS/js.departamentos/ajax.departamentos.js"></script> 
    <script src="Plantillas/menu_desplegable-administrador.js"></script>
    

</head>
<?php
    session_start();
    
    if(isset($_SESSION["tipo_usuario"])){
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
        <h1 class="titleh1">Departamentos</h1>
        <div class="contenedorPrincipal">
        <h2 style="background-color: rgb(0, 180, 10);" class="titleh2">Lista de Departamentos</h2>
            <section class="secciones">
                
                <div>

                    <!--Boton Para ingresar al formulario para crear una nueva actividad predefinida-->
                    <a class="btn btn-primary" href="departamentos-agregar.php" role="button">Agregar Departamento</a>

                    <!--Barra de Busqueda-->
                    <nav style="margin-top: 20px; margin-left: 20px;" class="navbar navbar-expand-lg navbar-light barra_navegacion container">
                        <form class="form col row">
                            <label class="form-label col-12">Buscar Por Nombre:</label>
                            <input class="form-control col-8" type="search" placeholder="Buscar Departamento Por Nombre..." id="data_busq_nombre" name="data_busq_nombre">
                        </form>
                        
                        <form class="form col row">
                            <label class="form-label col-12">Buscar Por Id:</label>
                            <input class="form-control col-10" type="search" placeholder="Buscar Por ID..." id="data_busq_id" name="data_busq_id">
                        </form>
                    
                        <div class="col-md-3">
                                <label class="form-label">Numero de Resultados:</label>
                                <select class="form-select" id="num_resultados">
                                        <option value="5">5</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                </select>
                        </div>
                        <div class="col-md-3">
                            <button style="margin-top: 30px;" class="btn btn-primary" id="buscar_nombre_boton">Buscar</button>
                        </div>
                    </nav>

                    <!--Tabla que muestra los tipos de actividad que existen-->
                    <div class="table-responsive">
                        <table id="tabla_departamentos" class="table table-hover text-nowrap table_default">
                            <!--Datos que mostrara la tabla actividades gracias a ajax.departamentos.js-->
                        </table>
                    </div>
                    <div>
                        <nav>
                            <ul class="pagination" id="num_paginas">
                            </ul>
                        </nav>
                    </div>
                </div>
            </section>
    </main>
</body>

</html>