<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Framework/bootstrap/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="CSS/EstiloCabecera.css" type="text/css">
    <link rel="stylesheet" href="CSS/MenuDelizante.css" type="text/css">
    <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">
    <script src="JS/menu_desplegable.js"></script>
</head>
<?php
            require_once("Plantillas/Plantilla_cabecera.php");
        ?>
<body>
    <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->
    <main>
        <div class="contenedorPrincipal">
            <h2 class="titleh2">Registrar Usuario</h2>

            <form class="formulario" method="post">
                    <section class="secciones row">

                        
                        
                        <div class="col-md-7">
                            <label class="col-md-12">Contraseña:</label>
                            <input type="password"class="col-md-12" name="password" id="password">
                        </div>
                        <div class="col-md-7">
                            <label class="col-md-12">Contraseña:</label>
                            <input type="password"class="col-md-12" name="password" id="password">
                        </div>

                        <div class="col-md-12">
                            <input type="submit" role="button" class="btn btn-primary col-md-4" value="Registrar Usuario" name="env_actividad">
                        </div>
                            </section>
            </form>
        </div>
    </main>
    
</body>
</html>