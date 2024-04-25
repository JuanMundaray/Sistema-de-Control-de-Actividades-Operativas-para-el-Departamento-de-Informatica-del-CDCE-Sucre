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
    <script src="JS/js.actividades/ajax.actividades.verDetalles.js"></script>
    <script src="Plantillas/menu_desplegable-administrador.js"></script>
</head>
<?php
            session_start();

            if(isset($_SESSION["tipo_usuario"])){
                if(($_SESSION["tipo_usuario"]=="invitado")){
                    header("Location:./Dashboard.php");
                    exit();
                }
            }else{
                header("Location:../index.php");
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
        <h1 class="titleh1">Actividad</h1>
        <div class="contenedorPrincipal">

            <h2 class="titleh2">Detalles de la Actividad</h2>
            <section class="secciones row">
                <input class="col-md-12 form-control" type="hidden" readonly name="codigo_actividad" id="codigo_actividad" value="<?php echo $_REQUEST['codigo_actividad'];?>">
                <div class="col-md-6 div_input_form">
                    <label class="col-md-12 form-label"><strong >Codigo de Registro:</strong></label>
                    <p id="codigo_actividad"><?php echo $_REQUEST['codigo_actividad'];?></p>
                </div>
                <div class="col-md-6 div_input_form">
                    <label class="col-md-12 form-label"><strong >Nombre de Actividad:</strong></label>
                    <p id="nombre_actividad"></p>
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
                    <p id="estado_actividad"></p>
                </div>
                <div class="col-md-6 div_input_form">
                    <label class="col-md-12 form-label"><strong >Tipo de Actividad:</strong></label>
                    <p id="tipo"></p>
                </div>

                <div class="col-md-12 div_input_form" id="div_observacion">
                    <!--Lo agrega js en caso de que este campo tenga informacion-->
                </div>

                <div class="col-md-12 div_input_form" id="div_informe">
                    <!--Lo agrega js en caso de que este campo tenga informacion-->
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

                <div class="col-md-12 div_input_form" id=evidencia>
                    <!--Lo agrega js en caso de que este campo tenga informacion-->
                </div>
                <form style="text-align: center; margin-bottom: 20px;" action="../Controller/controllerActividad.php" method="post">
                    <input type="hidden" value="exportarDetalles" name="option" id="option">
                    <input type="hidden" value="<?PHP echo $_REQUEST['codigo_actividad'] ?>" name="codigo_actividad">
                    <input class="btn btn-danger" type="submit" value="Exportar a PDF">
                </form>
            </section>
        </div>
    </main>
    
</body>
</html>