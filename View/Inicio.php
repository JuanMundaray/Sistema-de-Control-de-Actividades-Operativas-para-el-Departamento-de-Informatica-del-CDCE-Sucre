    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <link rel="icon" href="../favicon.ico" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pagina de Inicio</title>

        <link rel="stylesheet" href="../Framework/bootstrap-5.3.0/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="CSS/EstiloCabecera.css" type="text/css">
        <link rel="stylesheet" href="CSS/MenuDelizante.css" type="text/css">
        <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">
        <script src="../Framework/jquery-3.6.3.min.js"></script>
        <script src="../Framework/bootstrap-5.3.0/js/bootstrap.min.js"></script>
        <script src="./Plantillas/menu_desplegable-login.js"></script>
    </head>
    <?php
            session_start();
            if(isset($_SESSION['nombre_usuario'])){  
                header('location:./Dashboard.php');
                exit();
            }
            require_once("Plantillas/Plantilla_cabecera.php");
        ?>
    <body>
        
        
        <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->

        <main>
            <h1 class="titleh1">Bienvenidos al Sistema de Control de Actividades</h1>
            <div class="contenedorPrincipal">
                <section class="secciones center-element">
                    <div class="carousel carousel-dark slide" data-bs-ride="carousel" style="width: 500px; height: 500px;">
                        <div class="carousel-inner">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-item active">
                                <img src="./Resources/Imagenes/carrusel/carrusel.png" class="d-block w-100" alt="...">
                            </div>

                            <div class="carousel-item">
                                <img src="./Resources/Imagenes/carrusel/carrusel2.png" class="d-block w-100" alt="...">
                            </div>

                            <div class="carousel-item">
                                <img src="./Resources/Imagenes/carrusel/carrusel3.png" class="d-block w-100" alt="...">
                            </div>
                            
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Anterior</span>
                            </button>
                            
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Siguiente</span>
                            </button>

                        </div>
                    </div>
                </section>
            </div>
        </main>
    </body>
</html>