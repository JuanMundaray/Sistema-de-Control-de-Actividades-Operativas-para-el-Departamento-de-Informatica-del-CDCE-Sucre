<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><link rel="icon" href="../favicon.ico" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Framework/bootstrap-5.3.0/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="CSS/EstiloCabecera.css" type="text/css">
    <link rel="stylesheet" href="CSS/formulario.css" type="text/css">
    <link rel="stylesheet" href="CSS/MenuDelizante.css" type="text/css">
    <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">
    <script src="../Framework/jquery-3.6.3.min.js"></script>
    
    <script src="Plantillas/menu_desplegable-administrador.js"></script>
</head>
<?php
        session_start();
        
        if(isset($_SESSION["tipo_usuario"])){
            if(($_SESSION["tipo_usuario"]=="invitado")){
                header("Location:./Dashboard.php");
                exit();
            }
        }else{
            header("Location:../Index");
            exit();
        }

    require_once("Plantillas/Plantilla_cabecera.php");
?>
<body>
    <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->
    <main>
        <h1 class="titleh1">Crear Tipo de Actividad</h1>
        <div class="contenedorPrincipal">    
            <h2 class="titleh2">Crear Tipo de Actividad</h2>
            <section class="secciones row">
                <form class="needs-validation formulario row" method="post" action="../Controller/controllerTipo_actividad.php" novalidate>    
                    <div class="col-md-7 div_input_form">
                        <label class="col-md-7 form-label">Tipo de Actividad a Registrar:</label>
                        <input class="col-md-7 form-control" type="text" name="nombre_tipo" id="nombre_tipo" required maxlength="100">
                        <div class="invalid-feedback">
                            *Este Campo no puede esta vacío
                        </div>
                    </div>

                    <input class="col-md-7" type="hidden" value="crear" name="option" id="option">
                    
                    <div class="col-md-12 form_button">
                        <input type="submit" class="btn btn-primary col-md-3" value="Crear Tipo de Actividad" id="crear_tipo_act">
                    </div>

                    <script src="JS/validar.formularios.js"></script>
                </form>
            </section>
        </div>
    </main>
    
</body>
</html>