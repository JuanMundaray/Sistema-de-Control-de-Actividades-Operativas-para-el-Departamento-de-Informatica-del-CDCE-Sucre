    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8"><link rel="icon" href="../favicon.ico" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../Framework/bootstrap-5.3.0/css/bootstrap.css" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="CSS/EstiloCabecera.css" type="text/css">
        <link rel="stylesheet" href="CSS/MenuDelizante.css" type="text/css">
        <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">
        <title>Historial Actividades</title>
    </head>
    <?php
        session_start();

        if((isset($_SESSION["tipo_usuario"]))){}
        else{
            header("Location:../index.php");
            exit();
        }

        require_once("Plantillas/Plantilla_cabecera.php");
    ?>
    <body>
        
        
        <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->

        <main>
            <div class="contenedorPrincipal mt-5">
                <div class="p-4">

                    <div class="alert alert-danger" role="alert">
                        <?php
                        if(isset($_GET['mensaje'])){
                            if($_GET['mensaje']==1){
                                echo 'ERROR: Tipo de Archivo Incorrecto. Solo se pueden subir imagenes con el formato jpg y jpeg';
                            }
                            if($_GET['mensaje']==2){
                                echo 'ERROR: Tipo de Archivo Incorrecto. Solo se pueden subir imagenes con el formato png';
                            }
                        }
                        else{
                            echo 'ERROR: Tipo de Archivo Incorrecto. Solo se pueden subir imagenes con el formato jpg, jpeg y png';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </main>

        <script src="../Framework/jquery-3.6.3.min.js"></script>
        <script src="Plantillas/menu_desplegable-administrador.js"></script>
        <script src="JS/js.actividades/ajax.historial_actividades.js"></script>
        <script src="../Framework/bootstrap-5.3.0/js/bootstrap.bundle.min.js"></script>
        <script src="JS/obtenerListaDay_Month_Year.js"></script>
    </body>
</html>