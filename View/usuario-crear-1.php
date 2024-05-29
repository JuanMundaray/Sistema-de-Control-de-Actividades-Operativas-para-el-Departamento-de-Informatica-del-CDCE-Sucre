<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><link rel="icon" href="../favicon.ico" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Framework/bootstrap-5.3.0/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="../Framework/bootstrap-icons-1.11.1/bootstrap-icons.min.css" type="text/css">
    <link rel="stylesheet" href="CSS/EstiloCabecera.css" type="text/css">
    <link rel="stylesheet" href="CSS/MenuDelizante.css" type="text/css">
    <link rel="stylesheet" href="CSs/formulario.css" type="text/css">
    <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">
    <script src="../Framework/jquery-3.6.3.min.js"></script>
    <script src="./JS/js.usuarios/js.registrar_usuario.js"></script>
    <script src="./Plantillas/menu_desplegable-administrador.js"></script>
    <title>Crear Usuario</title>
</head>
    <script>
    </script>
<?php
    
    ini_set('session.cache_limiter','public');
    session_cache_limiter(false);
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
        <h1 class="titleh1">Crear Usuario</h1>
        <div class="contenedorPrincipal">
            <h2 class="titleh2">Datos Personales del Usuario</h2>

            <form class="formulario needs-validation" method="post" action="./usuario-crear-2.php" novalidate>
                    <section id="secciones" class="secciones row">
                        <div class="col-md-10 div_input_form">
                            <label class="col-md-12 form-label">Nombre:</label>
                            <input type="text"class=" input_form col-md-12 form-control" name="nombre" id="nombre" placeholder="Nombre" maxlength="50" required>

                            <div class="invalid-feedback">
                                *Este Campo no Puede Estar Vacío
                            </div>
                        </div>

                        <div class="col-md-10 div_input_form">
                            <label class="col-md-12 form-label">Apellido:</label>
                            <input type="text"class=" input_form col-md-12 form-control" name="apellido" id="apellido" placeholder="Apellido" maxlength="50" required>

                            <div class="invalid-feedback">
                                *Este Campo no Puede Estar Vacío
                            </div>

                        </div>

                        <div class="col-md-10 div_input_form">
                            <label class=" form-label" >Cedula de Identidad:</label>
                            <input type="text" class=" input_form col-md-12 form-control" name="cedula" id="cedula" placeholder="Cédula de Identidad" maxlength=8 pattern="[0-9]{7,}" required>

                            <div class="invalid-feedback">
                                *La Cédula debe tener como mínimo 7 dígitos
                            </div>
                        </div>

                        <div class="col-md-12 form_button">
                            <input type="submit" class=" btn btn-primary col-md-3" value="Siguiente" name="crear_usuario" id="create_user">
                        </div>
                        
                    </section>
                    <script src="./JS/validar.formularios.js"></script>
            </form>
        </div>
    </main>
    
</body>
</html>