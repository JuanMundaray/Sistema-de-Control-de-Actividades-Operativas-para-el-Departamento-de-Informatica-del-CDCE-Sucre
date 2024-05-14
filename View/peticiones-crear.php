<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        session_start();
        if(isset($_SESSION["tipo_usuario"])){
            if($_SESSION["tipo_usuario"]=="invitado"){
                echo '<script src="Plantillas/menu_desplegable-invitado.js"></script>';
            }
            else{
                header("Location:./Dashboard.php");
                exit();
            }
        }
        else{
            header("Location:../index.php");
            exit();
        }
    ?>
    <meta charset="UTF-8"><link rel="icon" href="../favicon.ico" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Framework/bootstrap-5.3.0/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="CSS/EstiloCabecera.css" type="text/css">
    <link rel="stylesheet" href="CSS/MenuDelizante.css" type="text/css">
    <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">
    <link rel="stylesheet" href="CSS/formulario.css" type="text/css">
    <script src="../Framework/jquery-3.6.3.min.js"></script>
    <script src="./JS/js.peticiones/ajax.crear_peticion.js"></script>
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
            <!--id del usuario con sesion activa-->
            <input type="hidden" value="<?PHP echo $_SESSION['id_usuario']; ?>" id="id_usuario_sesion">
            <!--id del usuario con sesion activa-->

            <form class="formulario needs-validation" method="post" action="../Controller/controllerPeticion.php" novalidate>
                    <h2 class="titleh2">Realizar Petición de Actividad</h2>
                    <section class="secciones row">

                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Nombre de La Peticion:</label>
                            <input class="form-control" type="text" id="nombre_peticion" name="nombre_peticion" required>

                            <div class="invalid-feedback">
                                *Este Campo Debe Tener 4 Carácteres Como Mínimo
                            </div>
                        </div>

                        <div class="col-md-6 div_input_form">
                            <label class="form-label">Deparatamento que Realiza la Petición:</label>
                            <input class="form-control" id="visualizar_departamento_peticion" type="text" disabled>

                            <input type="hidden" value="" name="departamento_peticion" id="departamento_peticion">

                            <div class="invalid-feedback">
                                *Seleccione un Departamento Válido
                            </div>
                        </div>

                        <div class="col-md-6 div_input_form">
                            <label class="form-label">Tipo de Actividad:</label>
                            <select class="form-select" type="text" name="tipo_actividad" id="tipo_actividad" required>
                                <option selected disabled value="">Seleccione...</option>
                            </select>

                            <div class="invalid-feedback">
                                *Seleccione un Departamento Válido
                            </div>
                        </div>

                        <div class="col-md-12 div_input_form">
                            <label class="form-label">Emisor de la Peticion:</label>
                            <input class="form-control" type="text" id="emisor_peticion" disabled>
                        </div>

                        <div class="col-md-12 div_input_form">
                            <label class="form-label">Detalles de la Petición:</label>
                            <textarea class=" form-control" minlength="15" name="detalles_peticion" id="detalles_peticion" placeholder="Se especifica con detalle como desea que se realice alguna actividad..." style="min-height: 200px;" required></textarea>

                            <div class="invalid-feedback">
                                *Este Campo Debe Tener 15 Carácteres Como Mínimo
                            </div>
                        </div>

                        <input type="hidden" value="<?PHP echo $_SESSION['id_usuario']; ?>" name="id_usuario">

                        <input type="hidden" value="crear_peticion" name="option" id="option">

                        <div class="col-12 form_button">
                            <input type="submit" class="btn btn-primary" value="Crear Petición" name="crear_peticion" id="crear_peticion">
                        </div>>
                    </section>

                    <script src="JS/validar.formularios.js"></script>
            </form>
        </div>
    </main>
    
</body>
</html>