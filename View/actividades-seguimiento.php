<!DOCTYPE html>
<html lang="en">
<head>
    <title>Seguimiento de Actividadad</title>
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
        <h1 class="titleh1">Actividades Registradas</h1>
        <div class="contenedorPrincipal">

            <h2 class="titleh2">Seguimiento de Actividad</h2>
            <section class="secciones row">
                    <input type="hidden" value=<?php echo $_REQUEST['codigo_actividad']?> name="codigo_actividad" id="codigo_actividad">
                    <!--La tabla de Actividades Registradas-->

                    <h5 class="pb-4">Tabla de Linea de Tiempo de Actividad</h5>
                    
                    <div class="table-responsive">
                        <table id="tabla_actividades_registro_modificacion" class="table text-nowrap table_default">
                            <thead>
                                <tr>
                                    <th scope='col'><label>Nombre de Actividad</label></th>
                                    <th scope='col'><label>Estado al cual fue modificada</label></th>
                                    <th scope='col'><label>Estado de Actual de Actividad</label></th>
                                    <th scope='col'><label>Fecha de Modificacion</label></th>
                                    <th scope='col'><label>Hora de Modificacion</label></th>
                                    <th scope='col'><label>Tipo de Actividad</label></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        <!--La tabla se rellena por medio de el archivo ajax.actividades.js-->
                        </table>
                    </div>
            </section>
        </div>
    </main>
    <script src="../Framework/jquery-3.6.3.min.js"></script>
    <script src="Plantillas/menu_desplegable-administrador.js"></script>
    <script src="./JS/js.actividades/ajax.seguimiento_actividad.js"></script>
</body>
</html>