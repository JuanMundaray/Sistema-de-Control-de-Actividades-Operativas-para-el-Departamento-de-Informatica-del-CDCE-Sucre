    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
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
        <script src="JS/menu_desplegable-administrador.js"></script>
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
                                    <input class="form-control" type="search" placeholder="Buscar por Nombre..." aria-label="Search" aria-autocomplete="dasa" id="data_busq" name="data_busq">
                                    
                                    <input type="button" class="btn btn-outline-primary" id="buscar_act" value="Buscar">
                            </form>
                    </nav>
                    <div class="scroll">
                        <table id="tabla_peticiones" class="table table-bordered table-responsive text-nowrap table_default">
                            <tr>
                                <th><label>Nombre de Peticion</label></th>
                                <th><label>Usuario que registro la peticion</label></th>
                                <th><label>Departamento de la Peticion</label></th>
                                <th><label>Fecha de la Peticion</label></th>
                                <th colspan="2"><label>Accion</label></th>
                            </tr>
                            
                        </table>
                    </div>
                <section>
            </div>
        </main>
    </body>
</html>