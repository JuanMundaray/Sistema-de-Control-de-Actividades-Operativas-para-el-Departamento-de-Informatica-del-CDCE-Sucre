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
        ini_set('session.cache_limiter','public');
        session_cache_limiter(false);
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

            if(!isset($_REQUEST['option'])){
                header("Location:./actividades-registradas.php");
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
            <h1 class="titleh1">Exportar Actividades Registradas</h1>
            
            <div class="contenedorPrincipal">
                <h2 class="titleh2" <?PHP if($_REQUEST['option']=='exportarExcel'){echo 'style="background-color:#157347"';} ?>>Preferencias de Exportación</h2>
                <section class="secciones container">
                    <div class="container">
                        <form class="row gy-3 gx-4" method="post" action="../Controller/controllerActividad.php">


                            <div class="col-md-4">
                                <label class="form-label">Nombre de Actividad:</label>
                                <input class="form-control" type="search" placeholder="Nombre..." aria-label="Search" name="nombre_actividad">
                            </div>

                            <!-- Obligar a las siguientes columnas a pasar a una nueva línea en el breakpoint md y hacia arriba -->
                            <div class="w-100 d-none d-md-block"></div>
                                        
                            <div class="col-md-3 ">
                                <label class="label-sm form-label text-nowrap">Día de Registro:</label>
                                <select class="form-select" id="day" name="day">
                                    <option value="">Cuaquiera</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="label-sm form-label text-nowrap">Mes de Registro:</label>
                                <select class="form-select" id="month" name="month">
                                    <option value="">Cuaquiera</option>
                                    <option value="1">Enero</option>
                                    <option value="2">Febrero</option>
                                    <option value="3">Marzo</option>
                                    <option value="4">Abril</option>
                                    <option value="5">Mayo</option>
                                    <option value="6">Junio</option>
                                    <option value="7">Julio</option>
                                    <option value="8">Agosto</option>
                                    <option value="9">Septiembre</option>
                                    <option value="10">Octubre</option>
                                    <option value="11">Noviembre</option>
                                    <option value="12">Diciembre</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="label-sm form-label text-nowrap">Año de Registro:</label>
                                <select class="form-select" id="year" name="year">
                                    <option value="">Cuaquiera</option>
                                </select>
                            </div>

                            <!-- Obligar a las siguientes columnas a pasar a una nueva línea en el breakpoint md y hacia arriba -->
                            <div class="w-100 d-none d-md-block"></div>

                            <div class="col-md-4">
                                <label class="form-label">Estado de Actividad:</label>
                                <select class="form-select" name="estado_actividad" id="estado_actividad">
                                    <option value="">Todas</option>
                                </select>
                            </div>

                            <!-- Obligar a las siguientes columnas a pasar a una nueva línea en el breakpoint md y hacia arriba -->
                            <div class="w-100 d-none d-md-block"></div>

                            <div class="col-md-4">
                                <label class="col-md-12 form-label">Departamento Receptor:</label>
                                <select class="col-md-12 form-select" name="dep_receptor" id="dep_receptor">
                                    <option selected value="">Todos...</option>
                                </select>
                            </div>

                            <div class="col-md-4 offset-md-2">
                                <label class="col-md-12 form-label">Departamento Emisor:</label>
                                <select class="col-md-12 form-select" name="dep_emisor" id="dep_emisor">
                                    <option selected value="">Todos...</option>
                                </select>
                            </div>

                            <!--options hidden-->
                            <input type="hidden" name="id_usuario_sesion" value="<?PHP 
                            if(isset($_REQUEST['id_usuario_sesion'])){
                                echo $_REQUEST['id_usuario_sesion'];
                            }
                            ?>">

                            <?php
                            
                            if(isset($_REQUEST['todas'])){
                                echo '<input type="hidden" name="todas" id="todas" value=true>';
                            }
                            ?> 

                            <input type="hidden" class="btn btn-success" name="option" value=<?PHP echo $_REQUEST['option']?>>

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
        <script src="./JS/js.generar_reportes/generar_reportes_actividad.js"></script>
        <script src="./JS/obtenerListaDay_Month_Year.js"></script>
        <script>
            $(document).ready(function(){
                const date=new Date();
                $(month).val((date.getMonth())+1);
                $(year).val(date.getFullYear());
            });
        </script>
    </body>
</html>