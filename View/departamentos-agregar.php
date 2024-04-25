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
        <h2 style="background-color: rgb(0, 180, 10);" class="titleh2">+ Agregar Nuevo Departamento</h2>
            <section class="secciones">
                <form class="needs-validation formulario row gy-3" method="post" action="../Controller/controllerDepartamentos.php" novalidate>

                    <div class="col-md-7">
                        <label class="col-md-7 form-label">Nombre de Departamento a Registrar:</label>
                        <input class="col-md-7 form-control" type="text" name="nombre_departamento" id="nombre_departamento" required minlength="4" maxlength="50">
                        <div class="invalid-feedback">
                            *Este Campo Debe Tener Como Mínimo 4 Caracteres
                        </div>
                    </div>

                    <input class="col-md-7" type="hidden" value="crear" name="option" id="option">
                    
                    <div class="col-md-12">
                        <input type="submit" class="btn btn-primary col-md-3" value="Agregar Departamento" id="boton_agregar_departamento">
                    </div>

                    <script src="JS/validar.formularios.js"></script>
                </form>
            </section>
    </main>
</body>

</html>