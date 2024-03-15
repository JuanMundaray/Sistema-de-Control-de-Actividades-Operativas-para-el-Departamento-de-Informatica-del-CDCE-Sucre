    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../Framework/bootstrap-5.3.0/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="CSS/EstiloCabecera.css" type="text/css">
        <link rel="stylesheet" href="CSS/MenuDelizante.css" type="text/css">
        <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">
        <link rel="stylesheet" href="CSS/formulario.css" type="text/css">
        <script src="../Framework/jquery-3.6.3.min.js"></script>
        <script src="JS/menu_desplegable-login.js"></script>
        <title>Actividades Registradas</title>
    </head>
    <?php
            require_once("Plantillas/Plantilla_cabecera.php");
        ?>
    <body>
        
        
        <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->

        <main class="center-edit">
            <section class="secciones">
                    <form class="form_login row" method="post">
                        <h1 class="titleh1">Ingresar al Sistema</h1>
                        <div class="col-md-12">
                            <label class="form-label">Nombre de Usuario:</label>
                            <input class="col-md-12 form-control input_form" type="text" name="username" id="username">
                        </div>
                        <div class="col-md-12">
                            <label class="form">Contraseña:</label>
                            <input class="col-md-12 form-control input_form" type="text" name="password" id="password">
                        </div>
                        <div class="col-md-12 form_button">
                            <input class="col-md-4 btn btn-primary" type="submit" name="login" id="login" value="Login">
                        </div>
                        
                    </form>
            <section>
        </main>
        <!-- <footer class="main-footer">
         To the right
        <div class="pull-right hidden-xs">
          <?php echo $dptoweb;?>
        </div>
        <strong>Copyright &copy; <!?php echo copyrigth3_app; ?> <a href="<!?php echo copyrigth2_app; ?>" target='_blank'><!?php echo copyrigth1_app; ?></a>.</strong> Todos los Derechos Reservados.
      </footer>-->
    </body>
</html>