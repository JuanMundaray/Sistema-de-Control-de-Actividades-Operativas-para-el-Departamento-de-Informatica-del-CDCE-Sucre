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
        <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">
        <link rel="stylesheet" href="CSS/formulario.css" type="text/css">
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
        <main class="contenedor_principal_login">
            
            <div class="contenedor_login form-signin">
                <form class="form_login needs-validation" method="post" action="../Controller/controllerUsuario.php" novalidate>
                <div class="text-center">
                    <img src="./Resources/Imagenes/CDCE-logo-ministerio-de-educacion.webp" width="50"/>   

                </div> 
                <h1>Ingresar al Sistema</h1>
                    <div class="row gy-4">
                        <div class="col-md-12">
                            <input class="form-control" type="text" name="username" id="username" placeholder="Nombre de Usuario" required data-bs-toggle="tooltip" data-bs-placement="top" title="Nombre de Usuario">
                            <div class="invalid-feedback">
                                *Este Campo no puede esta vacío
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-8">
                            <input class="form-control" type="password" name="password" id="password" placeholder="Contraseña" minlength="4" required data-bs-toggle="tooltip" data-bs-placement="top" title="Contraseña">
                            <div class="invalid-feedback">
                                *Contraseña Incorrecta. Debe ingresar minimo 4 digitos
                            </div>
                            <?php
                                if(isset($_GET["ERR_PASSWORD"])){
                                    echo '<span style="color: red; font-size:14px">*Esta contraseña no corresponde con el usuario ingresado</span>';
                                }

                                if(isset($_GET['ERR_INEXISTENCIA'])){
                                    echo '<span style="color: red; font-size:14px">*Este usuario no Existe'.$_GET['ERR_INEXISTENCIA'].'</span>';
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
        <script src="../Framework/jquery-3.6.3.min.js"></script>
    </body>
</html>