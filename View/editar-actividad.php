<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Framework/bootstrap-5.3.0/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="CSS/EstiloCabecera.css" type="text/css">
    <link rel="stylesheet" href="CSS/MenuDelizante.css" type="text/css">
    <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">
    <link rel="stylesheet" href="CSS/formulario.css" type="text/css">
    <script src="../Framework/jquery-3.6.3.min.js"></script>
    <script src="../Controller/list_option.js"></script>
    <script src="JS/menu_desplegable-administrador.js"></script>
    <script src="../Controller/funciones.actividad.js"></script>
    <script src="../Controller/ajax.editarActividad.js"></script>
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
        <h1 class="titleh1">Editar Actividad</h1>
        <div class="contenedorPrincipal">

            <form class="formulario" method="get">
                    <h2 class="titleh2">Datos de la Actividad</h2>
                    <section class="secciones row">
                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">ID:</label>
                            <input class="col-md-12 form-control" type="text" readonly name="id" id="id" value="<?php echo $_REQUEST['id'];?>">
                        </div>
                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Codigo de Registro:</label>
                            <input class="col-md-12 form-control" type="text" readonly name="codigo" id="codigo">
                        </div>
                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Nombre de Actividad:</label>
                            <input class="col-md-12 form-control" type="text" name="nombre" id="nombre">
                        </div>

                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Departamento Emisor:</label>
                            <input class="col-md-12 form-control" type="text" name="dep_emisor" id="dep_emisor">
                        </div>
                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Departamento Receptor:</label>
                            <select class="col-md-12 form-control" name="dep_receptor" id="dep_receptor">
                                <option value="DEPARTAMENTO DE INFORMATICA">Departamento de Informatica</option>
                            </select>
                        </div>
                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Tipo de Actividad:</label>
                            <select class="col-md-12 form-control" name="tipo" id="tipo">
                            </select>
                        </div>

                        <div class="col-md-12 div_input_form">
                                <label class="col-md-12 form-label">Observacion:</label>
                                <textarea class="col-md-12 form-control" name="observacion" id="observacion"></textarea>
                        </div>
                        <div class="col-md-6 ">
                            <div class="col-md-12 div_input_form">
                                <label class="col-md-12 form-label">Nombre del responsable:</label>
                                <input class="col-md-12 form-control" type="text" name="nom_responsable" id="nom_responsable">
                            </div>
                            
                            <div class="col-md-12 div_input_form">
                                <label class="col-md-12 form-label">Apellido del responsable:</label>
                                <input class="col-md-12 form-control" type="text" name="ape_responsable" id="ape_responsable">
                            </div>

                            <div class="col-md-12 div_input_form">
                                <label class="col-md-12 form-label">Cedula del Responsable:</label>
                                <input class="col-md-12 form-control" type="text" name="ced_responsable" id="ced_responsable" maxlength="9">
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="col-md-12 div_input_form">
                                <label class="col-md-12 form-label">Nombre del Funcionario Atendido:</label>
                                <input class="col-md-12 form-control" type="text" name="nom_atendido" id="nom_atendido">
                            </div>
                            <div class="col-md-12 div_input_form">
                                <label class="col-md-12 form-label">Apellido del Funcionario Atendido:</label>
                                <input class="col-md-12 form-control" type="text" name="ape_atendido" id="ape_atendido">
                            </div>
                            <div class="col-md-12 div_input_form">
                                <label class="col-md-12 form-label">Cedula del Funcionario Atendido:</label>
                                <input class="col-md-12 form-control" type="text" name="ced_atendido" id="ced_atendido">
                            </div>
                        </div>
                        <input type="hidden" value="modificar" name="option" id="option">
                        <div class="col-md-12 ">
                            <center><input type="button" class=" input_submit btn btn-primary col-md-4" value="Modificar Actividad" name="modificar_actividad" id="modificar_actividad"></center>
                        </div>

                    </section>
            </form>
        </div>
    </main>
    
</body>
</html>