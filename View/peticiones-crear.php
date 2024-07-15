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

            <form class="formulario needs-validation" method="post" novalidate id="formularioRegistrarPeticion">
                    <h2 class="titleh2">Crear Petición de Actividad</h2>
                    <section class="secciones row">
                            <!--id del usuario con sesion activa-->
                            <input type="hidden" value="<?PHP echo $_SESSION['id_usuario']; ?>" id="id_usuario">
                            <!--id del usuario con sesion activa-->
                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Nombre:</label>
                            <input class="form-control" type="text" id="nombre_peticion" name="nombre_peticion" maxlength="50" required>

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
                            <label class="form-label">Tipo:</label>
                            <select class="form-select" type="text" name="tipo_actividad" id="tipo_actividad" required>
                                <option selected disabled value="">Seleccione...</option>
                            </select>

                            <div class="invalid-feedback">
                                *Seleccione un Tipo Válido
                            </div>
                        </div>

                        <div class="col-md-12 div_input_form">
                            <label class="form-label">Emisor:</label>
                            <input class="form-control" type="text" id="emisor_peticion" disabled>
                        </div>

                        <div class="col-md-12 div_input_form">
                            <label class="form-label">Detalles:</label>
                            <textarea class=" form-control" minlength="15" name="detalles_peticion" id="detalles_peticion" placeholder="Se especifica con detalle como desea que se realice alguna actividad..." style="min-height: 200px;" required></textarea>

                            <div class="invalid-feedback">
                                *Este Campo Debe Tener 15 Carácteres Como Mínimo
                            </div>
                        </div>

                        <input type="hidden" value="<?PHP echo $_SESSION['id_usuario']; ?>" name="id_usuario">

                        <input type="hidden" value="crear_peticion" name="option" id="option">

                        <div class="col-12 form_button">
                            <input type="submit" class="btn btn-primary" value="Crear Petición" name="crear_peticion" id="crear_peticion">
                        </div>
                    </section>

                    <script src="JS/validar.formularios.js"></script>
            </form>
        </div>
    </main>
            <!-- Modal -->

            <div class="modal fade" id="ModalConfirmarRegistroPeticion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="confirmarRegistro" aria-hidden="true">

                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white ">
                            <h1 class="modal-title fs-5">¿Seguro que desea Registrar Esta Petición?</h1>

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row justify-content-between gx-3">
                                    <div class="row col-md-12 pb-4">
                                        <div class="col-md-12 text-nowrap">Nombre de Petición:</div>
                                        <div class="col-md-12" id="label_nombre"></div>
                                    </div>

                                    <div class="row col-md-6 pb-4">
                                        <div class="col-md-12 text-nowrap">Departamento de Petición:</div>
                                        <div class="col-md-12" id="label_departamento"></div>
                                    </div>

                                    <div class="row col-md-6 pb-4">
                                        <div class="col-md-12 text-nowrap">Tipo de Actividad Esperada:</div>
                                        <div class="col-md-12" id="label_tipo_actividad"></div>
                                    </div>

                                    <div class="row col-md-6 pb-4">
                                        <div class="col-md-12 text-nowrap">Emisor de la Petición:</div>
                                        <div class="col-md-12" id="label_emisor"></div>
                                    </div>

                                    <div class="row col-md-6 pb-4">
                                        <div class="col-md-12 text-nowrap">Detalles de la Petición:</div>
                                        <div class="col-md-12" id="label_detalles"></div>
                                    </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" id="ConfirmarRegistrarPeticion" class="btn btn-primary">Confirmar</button>
                        </div>
                    </div>
                </div>
            </div>
    <script src="../Framework/jquery-3.6.3.min.js"></script>
    <script src="./JS/js.peticiones/RegistrarPeticion/index.js" type="module"></script>
    <script src="../Framework/bootstrap-5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="../Framework/bootstrap-5.3.0/js/bootstrap.min.js"></script>
</body>
</html>