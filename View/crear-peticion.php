<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><link rel="icon" href="../favicon.ico" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Framework/bootstrap-5.3.0/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="CSS/EstiloCabecera.css" type="text/css">
    <link rel="stylesheet" href="CSS/MenuDelizante.css" type="text/css">
    <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">
    <link rel="stylesheet" href="CSS/formulario.css" type="text/css">
    <script src="../Framework/jquery-3.6.3.min.js"></script>
    <script src="Plantillas/menu_desplegable-administrador.js"></script>
    <title>Hacer Peticion</title>
</head>
<?php
            require_once("Plantillas/Plantilla_cabecera.php");
        ?>
<body>
    <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->
    <main>
        <h1 class="titleh1">Petición de Actividad</h1>
        <div class="contenedorPrincipal">

            <form class="formulario needs-validation" method="post" action="../Controller/controllerPeticion.php" novalidate>
                    <h2 class="titleh2">Realizar Petición de Actividad</h2>
                    <section class="secciones row">
                        
                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Nombre de Petición:</label>
                            <input class="col-md-12 form-control" type="text" name="nombre_peticion" id="nombre_peticion" placeholder="Nombre identificativo" required>

                            <div class="invalid-feedback">
                                *Este Campo es Obligatorio
                            </div>
                        </div>

                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Deparatamento que realiza la Petición:</label>
                            <select class="col-md-12 form-select" type="text" name="departamento_peticion" id="departamento_peticion" required>
                                <option selected disabled value="">Seleccione...</option>
                                <option value="DEPARTAMENTO DE SALUD">Departamento de Salud</option>
                            </select>

                            <div class="invalid-feedback">
                                *Seleccione un Departamento Válido
                            </div>
                        </div>

                        <div class="col-md-12 div_input_form">
                            <label class="col-md-12 form-label">Detalles de la Petición:</label>
                            <textarea class="col-md-12 form-control" name="detalles_peticion" id="detalles_peticion" placeholder="Se especifica con detalle como desea que se realice alguna actividad..." style="min-height: 200px;" required></textarea>

                            <div class="invalid-feedback">
                                *Este Campo es Obligatorio
                            </div>
                        </div>

                        <input type="hidden" value=1 name="usuario" id="usuario">
                        <input type="hidden" value="crear_peticion" name="option" id="option">

                        <div class="col-md-12 form_button">
                            <input type="submit" class="btn btn-primary col-md-2" value="Crear Petición" name="crear_peticion" id="crear_peticion">
                        </div>
                    </section>

                    <script src="JS/validar.formularios.js"></script>
            </form>
        </div>
    </main>
    
</body>
</html>