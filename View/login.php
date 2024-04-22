    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="../favicon.ico" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>

        <link rel="stylesheet" href="../Framework/bootstrap-5.3.0/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="CSS/EstiloCabecera.css" type="text/css">
        <link rel="stylesheet" href="CSS/MenuDelizante.css" type="text/css">
        <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">
        <link rel="stylesheet" href="CSS/formulario.css" type="text/css">
        <script src="../Framework/jquery-3.6.3.min.js"></script>
        <script src="./Plantillas/menu_desplegable-login.js"></script>
        <title>Actividades Registradas</title>
    </head>
    <?php
        session_start();
        if(isset($_SESSION['nombre_usuario'])){  
            header('location:./Dashboard.php');
            exit();
        }
            require_once("Plantillas/Plantilla_cabecera.php");
            
        ?>
    <body>
        <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->
        <main>
            <div class="contenedor_login">
                <form class="form_login needs-validation" method="post" action="../Controller/controllerUsuario.php" novalidate>
                    <h1>Ingresar al Sistema</h1>
                    <div class="row gy-4">
                        <div class="col-md-12">
                            <label class="form-label">Nombre de Usuario:</label>
                            <input class="form-control" type="text" name="username" id="username" placeholder="Nombre de Usuario" required>
                            <div class="invalid-feedback">
                                *Este Campo no puede esta vacío
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-8">
                            <label class="form">Contraseña:</label>
                            <input class="form-control" type="password" name="password" id="password" placeholder="********" minlength="4" required>
                            <div class="invalid-feedback">
                                *Contraseña Incorrecta. Debe ingresar minimo 4 digitos
                            </div>
                            <?php
                                if(isset($_GET["incorrecto"])){
                                    echo '<span style="color: red; font-size:14px">*Este usuario no corresponde con la contraseña ingresada</span>';
                                }

                                if(isset($_GET['noExiste'])){
                                    echo '<span style="color: red; font-size:14px">*Este usuario no Existe</span>';
                                }
                            ?>
                        </div>
                        
                        <input type="hidden" value="login" name="option">

                        <div class="col-md-12 form_button">
                            <input class="col-md-4 btn btn-primary" type="submit" name="login" id="login" value="Login">
                        </div>
                    </div>
                    <script src="JS/validar.formularios.js"></script>
                </form>
            </div>
        </main>
    </body>
</html>