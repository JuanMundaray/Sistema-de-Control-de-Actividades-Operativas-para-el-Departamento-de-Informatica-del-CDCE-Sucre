<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><link rel="icon" href="../favicon.ico" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Actividad</title>
    <?php
        ini_set('session.cache_limiter','public');
        session_cache_limiter(false);
        session_start();
        if(isset($_SESSION["tipo_usuario"])){
            if($_SESSION["tipo_usuario"]=="estandar"){
                echo '<script src="Plantillas/menu_desplegable-estandar.js"></script>';
            }
            if($_SESSION["tipo_usuario"]=="administrador"){
                echo '<script src="Plantillas/menu_desplegable-administrador.js"></script>';
            }
            if(($_SESSION["tipo_usuario"]=="invitado")){
                header("Location:./Dashboard.php");
                exit();
            }
        }
        else{
            header("Location:../index.php");
            exit();
        }

        require_once("Plantillas/Plantilla_cabecera.php");
        ?>
    <link rel="stylesheet" href="../Framework/bootstrap-5.3.0/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="CSS/EstiloCabecera.css" type="text/css">
    <link rel="stylesheet" href="CSS/MenuDelizante.css" type="text/css">
    <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">
    <link rel="stylesheet" href="CSS/formulario.css" type="text/css">
    <link rel="stylesheet" href="CSS/formulario.css" type="text/css">
    <script src="../Framework/jquery-3.6.3.min.js"></script>
    <script src="JS/js.actividades/js.registrar_actividad.js"></script>
</head>
<?php
        ?>
<body>
    <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->
    <main>
        <input type="hidden" value="<?PHP echo $_SESSION['id_usuario'] ?>" id="id_usuario_sesion">
        <h1 class="titleh1">Registrar Actividad</h1>
        <div class="contenedorPrincipal">
            <form class="form_registrar_actividad needs-validation" id="form_registrar_actividad" method="post" action="./registrar-actividad-2.php" novalidate>
                <h2 class="titleh2">Datos de Actividad</h2>
                <section class="secciones row gy-3">
                    
                    <!--INPUT codigo de actividad-->
                    <div class="col-md-6">
                        <label class="col-md-12 form-label">Codigo de Registro:</label>
                        <input class="col-md-12 form-control is-disabled" readonly type="text" name="codigo_actividad" id="codigo_actividad">
                    </div>

                    <!--INPUT nombre de actividad-->
                    <div class="col-md-6">
                        <label class="col-md-12 form-label">Nombre de Actividad:</label>
                        <input class="col-md-12 form-control" type="text" name="nombre_actividad" minlength="4" maxlength="50" id="nombre_actividad" title="Solo se permiten letras" required>
                        <div class="invalid-feedback">
                            Este Campo Debe Tener Como Mínimo 4 Carácteres
                        </div>
                    </div>

                    <!--SELECT tipo de actividad-->
                    <div class="col-md-6">
                        <label class="col-md-12 form-label">Tipo de Actividad:</label>
                            <select class="col-md-12 input_form form-select" required name="id_tipo_actividad" id="id_tipo_actividad">
                            <option selected disabled value="">Seleccione...</option>
                            <option id="agregar_tipo_actividad">+ Agregar Tipo de Actividad</option>
                        </select>
                        <div class="invalid-feedback">
                            Seleccione un Tipo de Actividad Válido
                        </div>
                    </div>

                    <!--INPUT fecha de registro-->
                    <div class="col-md-6"> 
                        <label class="col-md-12 form-label">Fecha de Registro:</label>
                        <input class="col-md-12 form-control" type="date" name="fecha_registro" id="fecha_registro" placeholder="Fecha de Registro">
                    </div>

                    <!--SELECT departamento emisor-->
                    <div class="col-md-6">
                        <label class="col-md-12 form-label">Departamento Emisor:</label>
                        <select class="col-md-12 form-select" name="dep_emisor" id="dep_emisor" required>
                            <option selected disabled value="">Seleccione...</option>
                            <option id="agregar_departamento">+ Agregar Departamento</option>
                        </select>
                        <div class="invalid-feedback">
                            Elija un Departamento Valido
                        </div>
                    </div>

                    <!--SELECT departamento receptor-->
                    <div class="col-md-6">
                        <label class="col-md-12 form-label">Departamento Receptor:</label>
                        <select class="col-md-12 form-select is-disabled" name="dep_receptor" id="dep_receptor" required>
                            <option selected disabled value="">Seleccione...</option>
                        </select>
                        <div class="invalid-feedback">
                            Elija un Departamento Valido
                        </div>
                    </div>

                    <!--TEXTAREA observacion-->
                    <div class="col-md-12">
                            <label class="col-md-12 form-label">Observacion:</label>
                            <textarea class="col-md-12 form-control" name="observacion" id="observacion"></textarea>
                            <div class="form-text">*Este Campo es Opcional</div>
                    </div>
                    
                    <div class="col-md-12 form_button">
                        <button class="btn btn-primary" type="submit">Siguiente</button>
                    </div>

                </section>
            </form>
        </div>
    </main>
    <script src="JS/validar.formularios.js"></script>
    
</body>
</html>