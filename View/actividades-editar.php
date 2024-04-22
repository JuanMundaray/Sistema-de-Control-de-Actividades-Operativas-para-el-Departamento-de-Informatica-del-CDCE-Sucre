<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../favicon.ico" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Actividad</title>

    <link rel="stylesheet" href="../Framework/bootstrap-5.3.0/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="CSS/EstiloCabecera.css" type="text/css">
    <link rel="stylesheet" href="CSS/MenuDelizante.css" type="text/css">
    <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">
    <link rel="stylesheet" href="CSS/formulario.css" type="text/css">
    <script src="../Framework/jquery-3.6.3.min.js"></script>
    <script src="Plantillas/menu_desplegable-administrador.js"></script>
    <script src="JS/js.actividades/ajax.editarActividad.js"></script>
</head>
<?php
            session_start();
            
            if(isset($_SESSION["tipo_usuario"])){
                if(($_SESSION["tipo_usuario"]!="administrador")&&($_SESSION["tipo_usuario"]!="estandar")){
                    header("Location:./Dashboard.php");
                    exit();
                }
            }else{
                header("Location:../Index.php");
                exit();
            }

            require_once("Plantillas/Plantilla_cabecera.php");
            if(!isset($_REQUEST['codigo_actividad'])){
                header("location:actividades-registradas.php");
            }
?>
<body>
    <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->
    <main>
        <h1 class="titleh1">Editar Actividad</h1>
        <div class="contenedorPrincipal">

            <form class="formulario needs-validation" method="post" action="../Controller/controllerActividad.php" enctype="multipart/form-data" novalidate>
                    <h2 class="titleh2">Datos de la Actividad</h2>
                    <section class="secciones row">
                        <input type="hidden" value="modificar" name="option">
                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Codigo de Registro:</label>
                            <input class="col-md-12 form-control" value="<?php echo $_REQUEST['codigo_actividad'];?>" type="text" readonly name="codigo_actividad" id="codigo_actividad">
                        </div>
                        <div class="col-md-12 div_input_form">
                                <label class="col-md-12 form-label">Observacion:</label>
                                <textarea class="col-md-12 form-control"  maxlength="512" name="observacion" id="observacion"></textarea>
                        </div>
                        <div class="col-md-12 div_input_form">
                                <label class="col-md-12 form-label">Informe:</label>
                                <textarea class="col-md-12 form-control" maxlength="512" name="informe" id="informe" placeholder="Informe sobre la realizacion de esta Actividad" required></textarea>

                                <div class="invalid-feedback">
                                    *Este Campo es Obligatorio
                                </div>
                        </div>
                        
                        <div class="col-md-12 div_input_form" id="div_estado">
                                <label class="col-md-12 form-label">Estado:</label>
                                <select class="form-select" id="estado" name="estado" required>
                                    <option selected disabled value="">Seleccione...</option>
                                    <option value="PROCESO" id="select_proceso">PROCESO (60%)</option>
                                    <option value="COMPLETADA" id="select_completada">COMPLETADA (100%)</option>
                                    <option value="SUSPENDIDA" id="select_suspendida">SUSPENDIDA</option>
                                </select>

                                <div class="invalid-feedback">
                                    *Seleccione un Estado de Actividad Válido
                                </div>
                        </div>
                        
                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Nombre de Actividad:</label>
                            <input class="col-md-12 form-control" type="text" readonly disabled name="nombre" id="nombre">
                        </div>

                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Departamento Emisor:</label>
                            <input class="col-md-12 form-control" type="text" readonly disabled name="dep_emisor" id="dep_emisor">
                        </div>

                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Departamento Receptor:</label>
                            <input type="text" class="col-md-12 form-control" disabled name="dep_receptor" id="dep_receptor" readonly>
                        </div>

                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Tipo de Actividad:</label>
                            <input type="text" class="col-md-12 form-control" disabled name="tipo" id="tipo" readonly>
                        </div>
                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Nombre del responsable:</label>
                            <input class="col-md-12 form-control" disabled type="text" name="nom_responsable" id="nom_responsable" readonly>
                        </div>

                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Nombre del Funcionario Atendido:</label>
                            <input class="col-md-12 form-control" type="text" name="nom_atendido" id="nom_atendido" readonly disabled>
                        </div>
                        
                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Apellido del responsable:</label>
                            <input class="col-md-12 form-control" type="text" name="ape_responsable" id="ape_responsable" readonly disabled>
                        </div>

                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Apellido del Funcionario Atendido:</label>
                            <input class="col-md-12 form-control" type="text" name="ape_atendido" id="ape_atendido" readonly disabled>
                        </div>

                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Cedula del Responsable:</label>
                            <input class="col-md-12 form-control" type="text" name="ced_responsable" id="ced_responsable" maxlength="9" readonly disabled>
                        </div>
                        
                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Cedula del Funcionario Atendido:</label>
                            <input class="col-md-12 form-control" type="text" name="ced_atendido" id="ced_atendido" readonly disabled>
                        </div>

                        <input type="hidden" value="modificar" name="option" id="option">
                        <div class="col-md-12 form_button">
                            <input type="submit" class=" input_submit btn btn-primary col-md-4" value="Modificar Actividad" name="modificar_actividad" id="modificar_actividad">
                        </div>

                    </section>
                    
                    <script src="JS/validar.formularios.js"></script>
            </form>
        </div>
    </main>
    
</body>
</html>