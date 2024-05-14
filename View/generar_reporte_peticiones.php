<!DOCTYPE html>
    <html lang="es">
    <head>
        <link rel="icon" href="../favicon.ico" />
        <meta charset="UTF-8"><link rel="icon" href="../favicon.ico" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" href="../Framework/bootstrap-5.3.0/css/bootstrap.css" type="text/css">
        <link rel="stylesheet" href="CSS/EstiloCabecera.css" type="text/css">
        <link rel="stylesheet" href="CSS/MenuDelizante.css" type="text/css">
        <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">
        <title>Exportar Actividades Registradas</title>

    </head>

    <?php
            session_start();
            if(isset($_SESSION["tipo_usuario"])){
                if($_SESSION["tipo_usuario"]=="estandar"){
                    echo '<script src="Plantillas/menu_desplegable-estandar.js"></script>';
                }
                if($_SESSION["tipo_usuario"]=="administrador"){
                    echo '<script src="Plantillas/menu_desplegable-administrador.js"></script>';
                }
                if($_SESSION["tipo_usuario"]=="invitado"){
                    header("Location:./Dashboard.php");
                    exit();
                }
            }
            else{
                header("Location:../index.php");
                exit();
            }
        ?>
    <?php
        require_once("Plantillas/Plantilla_cabecera.php");
    ?>

    <body>  
        
        <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->

        <main>

            <!--id del usuario que tienen abierta la sesion-->
            <input type="hidden" value="<?PHP echo $_SESSION['tipo_usuario']?>" id="tipo_usuario">
            <!----------------------------------------------->
            <h1 class="titleh1">Exportar Peticiones Creadas</h1>
            
            <div class="contenedorPrincipal">
                <h2 class="titleh2">Preferencias de Exportación</h2>
                <section class="secciones container">
                    <div class="container">
                        <form class="needs-validation row gy-3 gx-4" method="post" action="../Controller/controllerPeticion.php" novalidate>

                            <div class="col-md-4">
                                <label class="form-label">Fecha de Peticion:</label>
                                <input class="form-control" type="date" placeholder="Buscar por Fecha..." aria-label="Search" name="fecha_peticion">
                            </div>

                            <div class="col-md-4 offset-md-2">
                                <label class="form-label">Estado de Peticion:</label>
                                <select class="form-select" name="estado_peticion" id="estado_peticion">
                                    <option value="">Todas</option>
                                </select>
                            </div>

                            <!-- Obligar a las siguientes columnas a pasar a una nueva línea en el breakpoint md y hacia arriba -->
                            <div class="w-100 d-none d-md-block"></div>

                            <div class="col-md-4">
                                <label class="form-label">Departamento de Peticion:</label>
                                <select class="form-select" name="departamento_peticion" id="departamento_peticion">
                                    <option selected value="">Todos...</option>
                                </select>
                            </div>

                            <!-- Obligar a las siguientes columnas a pasar a una nueva línea en el breakpoint md y hacia arriba -->
                            <div class="w-100 d-none d-md-block"></div>

                            <div class="col-md-4">
                                <label class="form-label">Archivo a Exportar:</label>
                                <select class="form-select" name="option" required>
                                    <option selected disabled value="">Seleccione...</option>
                                    <option value="exportarPDF">Exportar a PDF</option>
                                    <option value="exportarExcel">Exportar a Excel</option>
                                </select>
                                <div class="invalid-feedback">
                                    Seleccione un Tipo de Archivo para Exportar
                                </div>
                            </div>

                            <!-- Boton para exportar actividad -->
                            <div class="col-md-12" style="text-align: center;margin-top: 50px;">
                                <button  class="btn btn-large btn-primary" role="button">
                                    <label>Generar Reporte</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                                        <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                                        <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                                    </svg>

                                </button>
                            </div>

                        </form>
                    </div>
                <section>
            </div>
        </main>

        <script src="../Framework/jquery-3.6.3.min.js"></script>
        <script src="./JS/validar.formularios.js"></script>
        <script src="./JS/js.generar_reportes/generar_reportes_peticiones.js"></script>
    </body>
</html>