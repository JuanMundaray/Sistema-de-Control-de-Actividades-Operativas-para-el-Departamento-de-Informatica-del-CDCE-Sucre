<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Framework/bootstrap-5.3.0/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="CSS/EstiloCabecera.css" type="text/css">
    <link rel="stylesheet" href="CSS/MenuDelizante.css" type="text/css">
    <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">
    <link rel="stylesheet" href="CSS/formulario.css" type="text/css">
    <script src="../Framework/jquery-3.6.3.min.js"></script>
    <script src="JS/menu_desplegable-administrador.js"></script>
</head>
<?php
            require_once("Plantillas/Plantilla_cabecera.php");
        ?>
<body>
    <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->
    <main>
        <h1 class="titleh1">Petición de Actividad</h1>
        <div class="contenedorPrincipal">

            <form class="formulario" method="post">
                    <h2 class="titleh2">Realizar Petición de Actividad</h2>
                    <section class="secciones row">
                        
                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Nombre de Petición:</label>
                            <input class="col-md-12 form-control" type="text" name="nom_peticion" id="nom_peticion" placeholder="Nombre identificativo" required>
                        </div>
                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Deparatamento que realiza la Petición:</label>
                            <select class="col-md-12 form-select" type="text" name="dep_peticion" id="dep_peticion" required>
                                <option value="DEPARTAMENTO DE SALUD">Departamento de Salud</option>

                            </select>
                        </div>
                        <div class="col-md-12 div_input_form">
                            <label class="col-md-12 form-label">Detalles de la Petición:</label>
                            <textarea class="col-md-12 form-control" name="detalles" id="detalles" placeholder="Se especifica con detalle como desea que se realice alguna actividad..." style="min-height: 200px;" required></textarea>
                        </div>
                        <div class="col-md-12 form_button">
                            <input type="submit" class="btn btn-primary col-md-2" value="Crear Petición" name="crear_peticion" id="crear_peticion">
                        </div>
                    </section>
            </form>
        </div>
    </main>
    
</body>
</html>