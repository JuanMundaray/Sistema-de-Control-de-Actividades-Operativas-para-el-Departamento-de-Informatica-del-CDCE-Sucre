<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><link rel="icon" href="../favicon.ico" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Actividad</title>
    <?php
            
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
        if(!isset($_REQUEST['id_peticion'])){
            header("Location:./Dashboard.php");
            exit();
        }

        require_once("Plantillas/Plantilla_cabecera.php");
        ?>
    <link rel="stylesheet" href="../Framework/bootstrap-5.3.0/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="CSS/EstiloCabecera.css" type="text/css">
    <link rel="stylesheet" href="CSS/MenuDelizante.css" type="text/css">
    <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">
    <link rel="stylesheet" href="CSS/formulario.css" type="text/css">
    <script src="../Framework/jquery-3.6.3.min.js"></script>
    <script src="JS/js.actividades/js.registrar_actividad.js"></script>
    <script src="JS/js.peticiones/aceptar-peticion.js"></script>
</head>
<body>
    <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->
    <main>
        <input type="hidden" value="<?PHP echo $_SESSION['id_usuario'] ?>" name="id_usuario_sesion" id="id_usuario_sesion">
        <h1 class="titleh1">Aceptar Peticion</h1>
        <div class="contenedorPrincipal">
            <!--Comienzo del Formulario-->
            <form class="needs-validation" id="crear_actividad_peticion" novalidate>

                    <!--Parte 2 del formulario de Registro de Actividades(Para datos del responsable del registro)-->
                    <h2 class="titleh2">Responsable del Registro</h2>

                    <!--Datos enviados de la primera parte del formulario-->
                    <?php
                        echo '<input type="hidden" name="codigo_actividad" id="codigo_actividad" value="'.$_REQUEST['codigo_actividad'].'">';
                        echo '<input type="hidden" name="nombre_actividad" id="nombre_actividad" value="'.$_REQUEST['nombre_actividad'].'">';
                        echo '<input type="hidden" name="id_tipo_actividad" id="id_tipo_actividad" value="'.$_REQUEST['id_tipo_actividad'].'">';
                        echo '<input type="hidden" name="dep_emisor" id="dep_emisor" value="'.$_REQUEST['dep_emisor'].'">';
                        echo '<input type="hidden" name="dep_receptor" id="dep_receptor" value="'.$_REQUEST['dep_receptor'].'">';
                        echo '<input type="hidden" name="observacion" id="observacion" value="'.$_REQUEST['observacion'].'">';
                    ?>

                    <!--cuerpo del formulario-->
                    <section class="secciones row">
                        <div class="col-md-6 div_input_form">
                            <div class="col-md-12 div_input_form">
                                <label class="col-md-12 form-label">Nombre del Responsable:</label>
                                <input class="col-md-12 form-control" disabled type="text" id="nom_responsable">
                                <div class="invalid-feedback">
                                    Este Campo no puede esta vacío
                                </div>
                            </div>
                            
                            <div class="col-md-12 div_input_form">
                                <label class="col-md-12 form-label">Apellido del Responsable:</label>
                                <input class="col-md-12 form-control" disabled type="text" id="ape_responsable">
                                <div class="invalid-feedback">
                                    Este Campo no puede esta vacío
                                </div>
                            </div>

                            <div class="col-md-12 div_input_form">
                                <label class="col-md-12 form-label">Cedula del Responsable:</label>
                                <input class="col-md-12 form-control" disabled type="text" id="ced_responsable" minlength="10" maxlength="11">
                            </div>
                        </div>
                        
                        <div class="col-md-6 div_input_form">
                            <div class="col-md-12 div_input_form">
                                <label class="col-md-12 form-label">Nombre del Solicitante:</label>
                                <input class="col-md-12 form-control is-disabled" required type="text" name="nom_atendido" id="nom_atendido" readonly>
                                <div class="invalid-feedback">
                                    Este Campo no puede esta vacío
                                </div>
                            </div>
                            <div class="col-md-12 div_input_form">
                                <label class="col-md-12 form-label">Apellido del Solicitante:</label>
                                <input class="col-md-12 form-control is-disabled" required type="text" name="ape_atendido" id="ape_atendido" readonly>
                                <div class="invalid-feedback">
                                    Este Campo no puede esta vacío
                                </div>
                            </div>
                            <div class="col-md-12 div_input_form">
                                <label class="col-md-12 form-label">Cedula del Solicitante:</label>
                                <input class="col-md-12 form-control is-disabled" type="text" maxlength="10" name="ced_atendido" id="ced_atendido" readonly required>
                            </div>
                        </div>

                        <!--Input type hiddens-->
                        <input type="hidden" value="aceptarPeticion" name="option" id="option">
                        <input type="hidden" value="<?PHP echo $_SESSION['id_usuario'] ?>" name="id_usuario_responsable" id="id_usuario_responsable">
                        <input type="hidden" value="<?PHP echo $_REQUEST['id_peticion'] ?>" id="id_peticion">
                        <!--Input type hiddens-->
                        <div class="col-md-12 form_button">
                            <input type="submit" class="btn btn-primary col-md-4" value="Convertir Peticion en Actividad" name="guardar_actividad" id="aceptar_peticion">
                        </div>

                    </section>
            </form>
            <!--Fin del Formulario-->

            <!-- Modal -->
            <div class="modal fade" id="modalDetallesPeticion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Detalles de la Peticion</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Comprendido</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                    
        <script src="JS/validar.formularios.js"></script>
        <script src="../Framework/bootstrap-5.3.0/js/bootstrap.bundle.js"></script>
    </main>
    
</body>
</html>