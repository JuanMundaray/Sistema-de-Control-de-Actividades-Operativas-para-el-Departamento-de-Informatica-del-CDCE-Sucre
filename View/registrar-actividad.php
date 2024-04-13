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
            header("Location:../Index");
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
    <script src="js/ajax.actividades/js.registrar_actividad.js"></script>
    <script src="JS/validar.registrar_actividad.js"></script>
</head>
<?php
        ?>
<body>
    <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->
    <main>
        <input type="hidden" value="<?PHP echo $_SESSION['id_usuario'] ?>" name="id_usuario_sesion" id="id_usuario_sesion">
        <h1 class="titleh1">Registrar Actividad</h1>
        <div class="contenedorPrincipal">

            <form class="form_registrar_actividad needs-validation" id="form_registrar_actividad" method="post" action="../Controller/controllerActividad.php" novalidate>
                    <h2 class="titleh2">Datos de Registro</h2>
                    <section class="secciones row">
                        
                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Codigo de Registro:</label>
                            <input class="col-md-12 form-control" readonly type="text" name="codigo_actividad" id="codigo_actividad">
                        </div>

                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Nombre de Actividad:</label>
                            <input class="col-md-12 form-control" type="text" name="nombre_actividad" id="nombre_actividad" required>
                            <div class="invalid-feedback">
                                Este Campo no puede esta vacío
                            </div>
                        </div>

                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Tipo de Actividad:</label>
                                <select class="col-md-12 input_form form-select" required name="id_tipo_actividad" id="id_tipo_actividad">
                            <option selected disabled value="">Seleccione...</option>
                            </select>
                            <div class="invalid-feedback">
                                Seleccione un Tipo de Actividad Válido
                            </div>
                        </div>

                        <div class="col-md-6 div_input_form"> 
                            <label class="col-md-12 form-label">Fecha de Registro:</label>
                            <input class="col-md-12 form-control" disabled type="date" name="fecha_registro" id="fecha_registro" placeholder="Fecha de Registro">
                        </div>

                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Departamento Emisor:</label>
                            <select class="col-md-12 form-select" name="dep_emisor" id="dep_emisor" required>
                                <option selected disabled value="">Seleccione...</option>
                            </select>
                            <div class="invalid-feedback">
                                Elija un Departamento Valido
                            </div>
                        </div>

                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Departamento Receptor:</label>
                            <select class="col-md-12 form-select" name="dep_receptor" id="dep_receptor" required>
                                <option selected disabled value="">Seleccione...</option>
                            </select>
                            <div class="invalid-feedback">
                                Elija un Departamento Valido
                            </div>
                        </div>

                        <div class="col-md-12 div_input_form">
                                <label class="col-md-12 form-label">Observacion:</label>
                                <textarea class="col-md-12 form-control" name="observacion" id="observacion"></textarea>
                                <div id="emailHelp" class="form-text">*Este Campo es Opcional</div>
                        </div>
                        

                    </section>

                    <!--Parte 2 del formulario de Registro de Actividades(Para datos del responsable del registro)-->
                    <h2 class="titleh2">Responsable del Registro</h2>
                    <section class="secciones row">
                        <div class="col-md-6 div_input_form">
                            <div class="col-md-12 div_input_form">
                                <label class="col-md-12 form-label">Nombre del responsable:</label>
                                <input class="col-md-12 form-control" disabled type="text"id="nom_responsable">
                                <div class="invalid-feedback">
                                    Este Campo no puede esta vacío
                                </div>
                            </div>
                            
                            <div class="col-md-12 div_input_form">
                                <label class="col-md-12 form-label">Apellido del responsable:</label>
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
                            <div class="col-md-12 div_input_form">
                                <label class="col-md-12 form-label">Cedula del Funcionario Atendido:</label>
                                <input class="col-md-12 form-control" type="text" maxlength="10" name="ced_atendido" id="ced_atendido" required>
                            </div>
                        </div>
                        <input type="hidden" value="guardar" name="option" id="option">
                        <input type="hidden" value="<?PHP echo $_SESSION['id_usuario'] ?>" name="id_usuario_responsable" id="id_usuario_responsable">

                        <div class="col-md-12 form_button">
                            <input type="submit" class="btn btn-primary col-md-4" value="Registrar Actividad" name="guardar_actividad" id="guardar_actividad">
                        </div>

                    </section>
                    
                    <script src="JS/validar.formularios.js"></script>
            </form>
        </div>
    </main>
    
</body>
</html>