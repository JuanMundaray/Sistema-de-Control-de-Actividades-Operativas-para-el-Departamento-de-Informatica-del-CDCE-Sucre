<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Framework/bootstrap-5.3.0/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="CSS/EstiloCabecera.css" type="text/css">
    <link rel="stylesheet" href="CSS/MenuDelizante.css" type="text/css">
    <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">

    <link rel="stylesheet" href="CSS/Dashboard/Cuadros.css" type="text/css">
    <script src="JS/menu_desplegable.js"></script>

</head>
<?php
    require_once("Plantillas/Plantilla_cabecera.php");
?>
<body>
    <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->
    <main>
        <h1 class="titleh1">Administrar - Dashboard</h1>
        <section class="seccionDashboard">
            <h2>Dashboard</h2>
            <div class="ContenedorCuadros">

                <!--Cuadro que coloca el numero de ordenes-->
                <div class="CuadroOrdenes">
                    <div class="cuadro_hijo01">
                        <div>
                            <h2>150</h2>
                            <p>New Order</p>
                        </div>
                        <div>
                            <img src="../View/Resources/png/512/bag.png">
                        </div>
                    </div>
                    <div class="cuadro_hijo02">
                        <label>More Info</label>
                    </div>
                </div>

                <!--Cuadro que coloca el numero de ordenes-->
                <div class="CuadroTasaRebote">
                    <div class="cuadro_hijo01">
                        <div>
                            <h2>53%</h2>
                            <p>Tasa de Rebote</p>
                        </div>
                        <div>
                            <img src="../View/Resources/png/512/podium.png">
                        </div>
                    </div>
                    <div class="cuadro_hijo02">
                        More Info
                    </div>
                </div>

                
                <!--Cuadro de numero Usuarios Registrados-->
                <div class="CuadroRegistrados">
                    <div class="cuadro_hijo01">
                        <div>
                            <h2>66</h2>
                            <p>Usuarios Registrados</p>
                        </div>
                        <div>
                            <img src="../View/Resources/png/512/person-add.png">
                        </div>
                    </div>
                    <div class="cuadro_hijo02">
                        More Info
                    </div>
                </div>

                <!--Cuadro que coloca el numero de ordenes-->
                <div class="CuadroVisitantes">
                    <div class="cuadro_hijo01">
                        <div>
                            <h2>89</h2>
                            <p>Numero de Visitantes</p>
                        </div>
                        <div>
                            <img src="../View/Resources/png/512/pie-graph.png">
                        </div>
                    </div>
                    <div class="cuadro_hijo02">
                        <a href="lista-usuarios">Mas informacion</a>
                    </div>
                </div>
            </div>

        </section>
        </div>
    </main>
    
</body>
</html>