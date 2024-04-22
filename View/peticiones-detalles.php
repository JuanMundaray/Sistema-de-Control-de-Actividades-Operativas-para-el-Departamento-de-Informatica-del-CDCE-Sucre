<!DOCTYPE html>
<html lang="en">
<head>
    <title>Detalles de Peticion</title>
    <meta charset="UTF-8">
    <link rel="icon" href="../favicon.ico" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../Framework/bootstrap-5.3.0/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="CSS/EstiloCabecera.css" type="text/css">
    <link rel="stylesheet" href="CSS/MenuDelizante.css" type="text/css">
    <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">
    <link rel="stylesheet" href="CSS/formulario.css" type="text/css">
</head>
<?php
            session_start();
            require_once("Plantillas/Plantilla_cabecera.php");

            if(!isset($_REQUEST['id_peticion'])){
                header("location:peticiones-registradas.php");
            }
?>
<body>
    <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->
    <main>
        <h1 class="titleh1">Peticion</h1>
        <div class="contenedorPrincipal">

            <h2 class="titleh2">Detalles de La peticion</h2>
            <section class="secciones row gy-4">
                <input class="col-md-12 form-control" type="hidden" readonly name="id_peticion" id="id_peticion" value="<?php echo $_REQUEST['id_peticion'];?>">

                <div class="col-md-6">
                    <label class="col-md-12 form-label"><strong >Id de Peticion:</strong></label>
                    <p id="id_peticion"><?php echo $_REQUEST['id_peticion'];?></p>
                </div>
                <div class="col-md-6">
                    <label class="col-md-12 form-label"><strong >Nombre de Peticion:</strong></label>
                    <p id="nombre_peticion"></p>
                </div>

                <div class="col-md-6">
                    <label class="col-md-12 form-label"><strong >Departamento Peticion:</strong></label>
                    <p id="departamento_peticion"></p>
                </div>

                <div class="col-md-6">
                    <label class="col-md-12 form-label"><strong >Estado de la Peticion:</strong></label>
                    <p id="estado_peticion"></p>
                </div>

                <div class="col-md-6">
                    <label class="col-md-12 form-label"><strong >Tipo de Actividad:</strong></label>
                    <p id="tipo"></p>
                </div>

                <div class="col-md-6 ">
                    <label class="col-md-12 form-label"><strong >Nombre del Solicitante:</strong></label>
                    <p id="nombre_solicitante"></p>
                </div>

                <div class="col-md-6">
                    <label class="col-md-12 form-label"><strong >Cedula del Solicitante:</strong></label>
                    <p id="cedula_solicitante"></p>
                </div>

                <div class="col-md-12 ">
                    <label class="col-md-12 form-label"><strong >Detalles de la Peticion:</strong></label>
                    <p id="detalles_peticion"></p>
                </div>
            </section>
        </div>
    </main>

    <script src="../Framework/jquery-3.6.3.min.js"></script>
    <script src="JS/js.peticiones/ajax.peticiones.verDetalles.js"></script>
    <script src="Plantillas/menu_desplegable-administrador.js"></script>
    
</body>
</html>