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
</head>
<body>
    <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->
    <main>
        <input type="hidden" value="<?PHP echo $_SESSION['id_usuario'] ?>" id="id_usuario_sesion">
        <h1 class="titleh1">Registrar Actividad  2/2</h1>
        <div class="contenedorPrincipal">
            <form class="form_registrar_actividad needs-validation" id="form_registrar_actividad" method="post" novalidate>
                <!--Parte 2 del formulario de Registro de Actividades(Para datos del responsable del registro)-->
                <h2 class="titleh2">Datos del Reponsable</h2>
                <?php 
                    echo '<input type="hidden" name="codigo_actividad" value="'.$_REQUEST['codigo_actividad'].'">';
                    echo '<input type="hidden" name="nombre_actividad" value="'.$_REQUEST['nombre_actividad'].'">';
                    echo '<input type="hidden" name="id_tipo_actividad" value="'.$_REQUEST['id_tipo_actividad'].'">';
                    echo '<input type="hidden" name="dep_emisor" value="'.$_REQUEST['dep_emisor'].'">';
                    echo '<input type="hidden" name="dep_receptor" value="'.$_REQUEST['dep_receptor'].'">';
                    echo '<input type="hidden" name="observacion" value="'.$_REQUEST['observacion'].'">';
                    echo '<input type="hidden" name="fecha_inicio" value="'.$_REQUEST['fecha_inicio'].'">';
                ?>
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
                            <label class="col-md-12 form-label">Cédula del Responsable:</label>
                            <input class="col-md-12 form-control" disabled type="text" id="ced_responsable" minlength="10" maxlength="11">
                        </div>
                    </div>
                    
                    <div class="col-md-6 div_input_form">
                        <div class="col-md-12 div_input_form">
                            <label class="col-md-12 form-label">Nombre del Funcionario Atendido:</label>
                            <input class="col-md-12 form-control" required type="text" name="nom_atendido" id="nom_atendido">
                            <div class="invalid-feedback">
                                Este Campo no puede esta vacío
                            </div>
                        </div>

                        <div class="col-md-12 div_input_form">
                            <label class="col-md-12 form-label">Apellido del Funcionario Atendido:</label>
                            <input class="col-md-12 form-control" required type="text" name="ape_atendido" id="ape_atendido">
                            <div class="invalid-feedback">
                                Este Campo no puede esta vacío
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="col-md-12 form-label">Cédula del Funcionario Atendido:</label>
                            <input class="col-md-12 form-control" type="text" minlength="7" maxlength="8" name="ced_atendido" id="ced_atendido" pattern="[0-9]{7,}" required>
                            <div class="invalid-feedback">
                                Este Campo Debe Tener Como Mínimo 7 Caracteres
                            </div>
                        </div>

                    </div>

                    <input type="hidden" value="guardar" name="option" id="option">
                    <input type="hidden" value="<?PHP echo $_SESSION['id_usuario'] ?>" name="id_usuario_responsable" id="id_usuario_responsable">

                    <div class="form_button">
                        <div class="form_button btn-group" role="group">

                            <button class="btn btn-primary">
                                Registrar
                            </button>
                        </div>
                    </div>
                </section>
            </form>

            <!-- Modal -->

            <div class="modal fade" id="confirmarRegistro" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="confirmarRegistro" aria-hidden="true">

                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white ">
                            <h1 class="modal-title fs-5" id="confirmarRegistro">¿Seguro que desea Registrar Esta Actividad?</h1>

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row justify-content-between gx-3">
                                    <div class="row col-md-4 pb-4">
                                        <div class="col-md-12 text-nowrap">Nombre de Actividad:</div>
                                        <div class="col-md-12"><?php echo strtoupper($_REQUEST['nombre_actividad']); ?></div>
                                    </div>

                                    <div class="row col-md-4 pb-4">
                                        <div class="col-md-12 text-nowrap">Tipo de Actividad:</div>
                                        <div class="col-md-12" id="label_tipo_actividad"></div>
                                    </div>

                                    <div class="row col-md-4 pb-4">
                                        <div class="col-md-12 text-nowrap">Fecha de Inicio:</div>
                                        <div class="col-md-12"><?php echo $_REQUEST['fecha_inicio']; ?></div>
                                    </div>

                                    <div class="row  col-md-6 pb-4">
                                        <div class="col-md-12 text-nowrap">Departamento Emisor:</div>
                                        <div class="col-md-12"><?php echo $_REQUEST['dep_emisor']; ?></div>
                                    </div>

                                    <div class="row col-md-6 pb-4">
                                        <div class="col-md-12 text-nowrap">Departamento Receptor:</div>
                                        <div class="col-md-12"><?php echo $_REQUEST['dep_receptor']; ?></div>
                                    </div>

                                    <div class="row col-md-6 pb-4">
                                        <div class="col-md-12 text-nowrap">Nombre del Funcionario Atendido:</div>
                                        <div class="col-md-12" id="label_nom_atend"></div>
                                    </div>
                                    <div class="row  col-md-6 pb-4">
                                        <div class="col-md-12 text-nowrap">Cédula del Funcionario Atendido:</div>
                                        <div class="col-md-12" id="label_ced_atendido"></div>
                                    </div>

                                    <div class="row  col-md-6 pb-4">
                                        <div class="col-md-12 text-nowrap">Nombre del Responsable de la Actividad:</div>
                                        <div class="col-md-12" id="label_nom_responsable"></div>
                                    </div>
                                    <div class="row  col-md-6 pb-4">
                                        <div class="col-md-12 text-nowrap">Cédula del Responsable de la Actividad:</div>
                                        <div class="col-md-12" id="label_ced_responsable"></div>
                                    </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" id="submitActividad" class="btn btn-primary">Confirmar</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    <script src="JS/validar.formularios.js"></script>
    <script src="../Framework/jquery-3.6.3.min.js"></script>
    <script src="../Framework/bootstrap-5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="JS/js.actividades/RegistrarActividad/submit.form_actividad.js"></script>
    <script src="JS/js.actividades/RegistrarActividad/js.registrar_actividad-2.js"></script>

    </main>
    
</body>
</html>