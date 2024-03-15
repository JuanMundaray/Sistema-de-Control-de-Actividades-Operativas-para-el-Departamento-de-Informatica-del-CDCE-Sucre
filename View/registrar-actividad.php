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
    <script src="JS/funciones.actividad.js"></script>
    <script src="JS/validar_form.js"></script>
    <script src="JS/menu_desplegable-administrador.js"></script>
    <script>
            $(document).ready(function(){
                var timestamp=new Date().getTime();
                var codigo=timestamp.toString(36);
                codigo+=Math.floor(Math.random()*10000000000000000);
                $("#codigo").val(codigo);
            })
    </script>
</head>
<?php
            require_once("Plantillas/Plantilla_cabecera.php");
        ?>
<body>
    <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->
    <main>
        <h1 class="titleh1">Registrar Actividad</h1>
        <div class="contenedorPrincipal">

            <form class="form_registrar_actividad" id="form_registrar_actividad" method="post" action="../Controller/controllerActividad.php">
                    <h2 class="titleh2">Datos de Registro</h2>
                    <section class="secciones row">
                        
                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Codigo de Registro:</label>
                            <input class="col-md-12 form-control" readonly type="text" name="codigo" id="codigo">
                        </div>
                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Nombre de Actividad:</label>
                            <input class="col-md-12 form-control" type="text" name="nombre" id="nombre" required>
                        </div>
                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Tipo de Actividad:</label>
                            <select class="col-md-12 input_form form-select" required name="tipo" id="tipo">
                            </select>
                        </div>

                        <div class="col-md-6 div_input_form"> 
                            <label class="col-md-12 form-label">Fecha de Registro:</label>
                            <input class="col-md-12 form-control" required type="date" name="fecha" id="fecha" placeholder="Fecha de Registro">
                        </div>

                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Departamento Emisor:</label>
                            <input class="col-md-12 form-control" required type="text" name="dep_emisor" id="dep_emisor">
                        </div>

                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Departamento Receptor:</label>
                            <select class="col-md-12 form-select" name="dep_receptor" id="dep_receptor">
                                <option value="DEPARTAMENTO DE INFORMATICA">Departamento de Informatica</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                                <label class="col-md-12 form-label">Observacion:</label>
                                <textarea class="col-md-12 form-control" name="observacion" id="observacion"></textarea>
                        </div>
                        

                    </section>

                    <!--Parte 2 del formulario de Registro de Actividades(Para datos del responsable del registro)-->
                    <h2 class="titleh2">Responsable del Registro</h2>
                    <section class="secciones row">
                        <div class="col-md-6 div_input_form">
                            <div class="col-md-12 div_input_form">
                                <label class="col-md-12 form-label">Nombre del responsable:</label>
                                <input class="col-md-12 form-control" required type="text" name="nom_responsable" id="nom_responsable">
                            </div>
                            
                            <div class="col-md-12 div_input_form">
                                <label class="col-md-12 form-label">Apellido del responsable:</label>
                                <input class="col-md-12 form-control" required type="text" name="ape_responsable" id="ape_responsable">
                            </div>

                            <div class="col-md-12 div_input_form">
                                <label class="col-md-12 form-label">Cedula del Responsable:</label>
                                <input class="col-md-12 form-control" required type="text" name="ced_responsable" id="ced_responsable" minlength="8" maxlength="11">
                            </div>
                        </div>
                        
                        <div class="col-md-6 div_input_form">
                            <div class="col-md-12 div_input_form">
                                <label class="col-md-12 form-label">Nombre del Funcionario Atendido:</label>
                                <input class="col-md-12 form-control" required type="text" name="nom_atendido" id="nom_atendido">
                            </div>
                            <div class="col-md-12 div_input_form">
                                <label class="col-md-12 form-label">Apellido del Funcionario Atendido:</label>
                                <input class="col-md-12 form-control" required type="text" name="ape_atendido" id="ape_atendido">
                            </div>
                            <div class="col-md-12 div_input_form">
                                <label class="col-md-12 form-label">Cedula del Funcionario Atendido:</label>
                                <input class="col-md-12 form-control" type="text" minlength="8" maxlength="11" name="ced_atendido" id="ced_atendido" required>
                            </div>
                        </div>
                        <input type="hidden" value="guardar" name="option" id="option">
                        <div class="col-md-12 ">
                            <center><input type="submit" class="btn btn-primary col-md-4" value="Registrar Actividad" name="guardar_actividad" id="guardar_actividad"></center>
                        </div>

                    </section>
            </form>
        </div>
    </main>
    
</body>
</html>