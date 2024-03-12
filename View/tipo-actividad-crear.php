<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Framework/bootstrap-5.3.0/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="CSS/EstiloCabecera.css" type="text/css">
    <link rel="stylesheet" href="CSS/formulario.css" type="text/css">
    <link rel="stylesheet" href="CSS/MenuDelizante.css" type="text/css">
    <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">
    <script src="../Framework/jquery-3.6.3.min.js"></script>
    <script src="JS/menu_desplegable.js"></script>
    <script src="../Controller/controller_js/ajax.tipo_actividad.js"></script>
    <script>
            $(document).ready(function(){
                var timestamp=new Date().getTime();
                var codigoRandom=timestamp.toString(36);
                codigoRandom+=Math.floor(Math.random()*10000000000000000);
                $("#codigo").val(codigoRandom);
            })
    </script>
</head>
<?php
    require_once("Plantillas/Plantilla_cabecera.php");
?>
<body>
    <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->
    <main>
        <h1 class="titleh1">Crear Tipo de Actividad</h1>
        <div class="contenedorPrincipal">    
            <h2 class="titleh2">Crear Tipo de Actividad</h2>
            <section class="secciones row">
                <form class="formulario row" method="post">    
                    <div class="col-md-6">
                        <label class="col-md-7 form-label">Tipo de Actividad a Registrar:</label>
                        <input class="col-md-7 form-control" type="text" name="nombre_tipo" id="nombre_tipo" require maxlength="100">
                    </div>

                    <div class="col-md-6 div_input_form">
                        <label class="col-md-7 form-label">Código de Tipo de Actividad:</label>
                        <input class="col-md-7 form-control" type="text" readonly name="codigo" id="codigo">
                    </div>
                    <input class="col-md-7" type="hidden" value="crear" name="option" id="option">
                    <div class="col-md-12 form_button">
                        <input type="button" class="btn btn-primary col-md-3" value="Crear Tipo de Actividad" id="crear_tipo_act">
                    </div>
                </form>
            </section>
        </div>
    </main>
    
</body>
</html>