<!DOCTYPE html>
<html lang="en">
<head>
    <title>Detalles de Actividadad</title>
    <meta charset="UTF-8">
    <link rel="icon" href="../favicon.ico" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../Framework/bootstrap-5.3.0/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="CSS/EstiloCabecera.css" type="text/css">
    <link rel="stylesheet" href="CSS/MenuDelizante.css" type="text/css">
    <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">
    <link rel="stylesheet" href="CSS/formulario.css" type="text/css">
    <script src="../Framework/jquery-3.6.3.min.js"></script>
    <script src="JS/ajax.actividades.verDetalles.js"></script>
    <script src="Plantillas/menu_desplegable-administrador.js"></script>
</head>
<?php
            require_once("Plantillas/Plantilla_cabecera.php");
            if(!isset($_REQUEST['id'])){
                header("location:actividades-registradas.php");
            }
?>
<body>
    <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->
    <main>
        <h1 class="titleh1">Actividad</h1>
        <div class="contenedorPrincipal">

            <h2 class="titleh2">Detalles de la Actividad</h2>
            <section class="secciones row">
                <input class="col-md-12 form-control" type="hidden" readonly name="id" id="id" value="<?php echo $_REQUEST['id'];?>">
                <div class="col-md-6 div_input_form">
                    <label class="col-md-12 form-label"><strong >Codigo de Registro:</strong></label>
                    <p id="codigo"></p>
                </div>
                <div class="col-md-6 div_input_form">
                    <label class="col-md-12 form-label"><strong >Nombre de Actividad:</strong></label>
                    <p id="nombre"></p>
                </div>

                <div class="col-md-6 div_input_form">
                    <label class="col-md-12 form-label"><strong >Departamento Emisor:</strong></label>
                    <p id="dep_emisor"></p>
                </div>

                <div class="col-md-6 div_input_form">
                    <label class="col-md-12 form-label"><strong >Departamento Receptor:</strong></label>
                    <p id="dep_receptor"></p>
                </div>

                <div class="col-md-6 div_input_form">
                    <label class="col-md-12 form-label"><strong >Estado:</strong></label>
                    <p id="estado"></p>
                </div>
                <div class="col-md-6 div_input_form">
                    <label class="col-md-12 form-label"><strong >Tipo de Actividad:</strong></label>
                    <p id="tipo"></p>
                </div>

                <div class="col-md-12 div_input_form">
                        <label class="col-md-12 form-label"><strong >Observacion:</strong></label>
                        <p id="observacion"></p>
                </div>
                <div class="col-md-12 div_input_form" id="div_informe">
                    <label class="col-md-12 form-label"><strong >Informe:</strong></label>
                        <p id="informe"></p>
                </div>
                <div class="col-md-12 div_input_form">
                    <label class="col-md-12 form-label"><strong >Evidencia:</strong></label>
                        <p id="evidencia"></p>
                </div>

                <div class="col-md-6 div_input_form">
                    <label class="col-md-12 form-label"><strong >Nombre del responsable:</strong></label>
                    <p id="nom_responsable"></p>
                </div>

                <div class="col-md-6 div_input_form">
                    <label class="col-md-12 form-label"><strong >Cedula del Responsable:</strong></label>
                    <p id="ced_responsable"></p>
                </div>

                <div class="col-md-6 div_input_form">
                    <label class="col-md-12 form-label"><strong >Nombre del Funcionario Atendido:</strong></label>
                    <p id="nom_atendido"></p>
                </div>

                <div class="col-md-6 div_input_form">
                    <label class="col-md-12 form-label"><strong >Cedula del Funcionario Atendido:</strong></label>
                    <p id="ced_atendido"></p>
                </div>
                <input type="hidden" value="modificar" name="option" id="option">

            </section>
        </div>
    </main>
    
</body>
</html>