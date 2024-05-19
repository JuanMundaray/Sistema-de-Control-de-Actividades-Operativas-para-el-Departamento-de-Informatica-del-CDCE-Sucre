<!DOCTYPE html>
<html lang="en">
<head>
    
    <?php
        session_start();
        if(isset($_SESSION["tipo_usuario"])){
            if($_SESSION["tipo_usuario"]=="invitado"){
                echo '<script src="Plantillas/menu_desplegable-invitado.js"></script>';
            }
            if($_SESSION["tipo_usuario"]=="estandar"){
                echo '<script src="Plantillas/menu_desplegable-estandar.js"></script>';
            }
            if($_SESSION["tipo_usuario"]=="administrador"){
                echo '<script src="Plantillas/menu_desplegable-administrador.js"></script>';
            }
        }
        else{
            header("Location:../index.php");
            exit();
        }
        require_once("Plantillas/Plantilla_cabecera.php");
    ?>
    <meta charset="UTF-8"><link rel="icon" href="../favicon.ico" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../Framework/bootstrap-5.3.0/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="CSS/EstiloCabecera.css" type="text/css">
    <link rel="stylesheet" href="CSS/MenuDelizante.css" type="text/css">
    <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">
    <link rel="stylesheet" href="CSS/dashboard.css" type="text/css">
    <script src="../Framework/jquery-3.6.3.min.js"></script>
    <script src="JS/js.dashboard/ajax.dashboard.js"></script>

</head>
<body>
    <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->
    <main>
        <h1 class="titleh1">Dashboard</h1>
        <section class="seccionDashboard">

            <div style="margin-left: 11vw;" class="container">

                <div class="row row-cols-3">
                    <!--Cuadro que muestra el Actividades Registradas-->
                    <div class="CuadroActividadesRegistradas col bloque_dashboard">
                        <div class="cuadro_hijo01">

                            <div>
                                <h2 id="num_actividades">0</h2>
                                <p>Actividades Registradas</p>
                            </div>

                            <div>
                                <img src="../View/Resources/png/512/bag.png">
                            </div>

                        </div>

                        <div class="LineaFinal">
                            <a href="actividades-registradas.php">Más Información</a>
                        </div>

                    </div>

                    <!--Cuadro que muestra el Actividades Iniciadas-->
                    <div class="CuadroActividadesIniciadas col-md-3 bloque_dashboard" style="background-color:rgb(50, 199, 74);">

                        <div class="cuadro_hijo01">

                            <div>
                                <h2 id="num_actividades_iniciadas">0</h2>
                                <p>Actividades Iniciadas</p>
                            </div>

                            <div>
                                <img src="../View/Resources/png/512/podium.png">
                            </div>
                        </div>

                        <div class="LineaFinal"  style="background-color:rgb(37, 175, 78);">
                            <a href="actividades-registradas.php">Más Información</a>
                        </div>

                    </div>

                    <!--Cuadro que muestra el Actividades en Proceso-->
                    <div class="CuadroActividadesProceso col-md-3 bloque_dashboard">

                        <div class="cuadro_hijo01">

                            <div>
                                <h2 id="num_actividades_proceso">0</h2>
                                <p>Actividades en Proceso</p>
                            </div>

                            <div>
                                <img src="../View/Resources/png/512/clock.png">
                            </div>

                        </div>

                        <div class="LineaFinal">
                            <a href="actividades-registradas.php">Más Información</a>
                        </div>
                        
                    </div> 

                    <!--Cuadro que muestra el Actividades Suspendidas-->
                    <div class="CuadroActividadesSuspendidas col-md-5 bloque_dashboard">

                        <div class="cuadro_hijo01">

                            <div>
                                <h2 id="num_actividades_suspendidas">0</h2>
                                <p>Actividades Suspendidas</p>
                            </div>

                            <div>
                                <img src="../View/Resources/png/512/pie-graph.png">
                            </div>

                        </div>

                        <div class="LineaFinal">
                            <a href="actividades-registradas.php">Mas informacion</a>
                        </div>
                        
                    </div> 

                    <!--Cuadro de Actividades Completadas-->
                    <div class="CuadroUsuariosRegistrados col bloque_dashboard">

                        <div class="cuadro_hijo01">

                            <div>
                                <h2 id="num_actividades_completadas">0</h2>
                                <p>Actividades Completadas</p>
                            </div>
                            
                            <div>
                                <img src="../View/Resources/png/512/android-alarm.png">
                            </div>
                        </div>

                        <div class="LineaFinal">
                            <a href="actividades-registradas.php">Mas informacion</a>
                        </div>

                    </div>

                    <!--Cuadro de numero Usuarios Registrados-->
                    <div class="CuadroUsuariosRegistrados col bloque_dashboard">

                        <div class="cuadro_hijo01">

                            <div>
                                <h2 id="num_usuarios">0</h2>
                                <p>Usuarios Registrados</p>
                            </div>
                            
                            <div>
                                <img src="../View/Resources/png/512/person-add.png">
                            </div>
                        </div>

                        <div class="LineaFinal">
                            <a href="usuarios-administrar.php">Mas informacion</a>
                        </div>

                    </div>
                    
                </div>
            </div>

        </section>
        </div>
    </main>
    
</body>
</html>