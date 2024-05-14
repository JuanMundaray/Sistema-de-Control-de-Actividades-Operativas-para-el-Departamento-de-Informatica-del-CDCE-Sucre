<!DOCTYPE html>
    <html lang="es">
    <head>
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
        <link rel="icon" href="../favicon.ico" />
        <meta charset="UTF-8"><link rel="icon" href="../favicon.ico" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" href="../Framework/bootstrap-5.3.0/css/bootstrap.css" type="text/css">
        <link rel="stylesheet" href="CSS/EstiloCabecera.css" type="text/css">
        <link rel="stylesheet" href="CSS/MenuDelizante.css" type="text/css">
        <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">
        <title>Exportar Peticiones</title>

    </head>

    <?php
        require_once("Plantillas/Plantilla_cabecera.php");
    ?>

    <body>  
        
        <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->

        <main>

            <!--id del usuario que tienen abierta la sesion-->
            <input type="hidden" value="<?PHP echo $_SESSION['tipo_usuario']?>" id="tipo_usuario">
            <!----------------------------------------------->
            <h1 class="titleh1">Exportar Peticiones</h1>
            
            <div class="contenedorPrincipal">
                <h2 class="titleh2" <?PHP if($_REQUEST['option']=='exportarExcel'){echo 'style="background-color:#157347"';} ?>>Filtros de Exportacion</h2>
                <section class="secciones container">
                    <div class="container">

                        <!--Formulario-->
                        <form class="row gy-3 gx-4" method="post" action="../Controller/controllerPeticion.php">

                            <div class="col-md-4">
                                <label class="form-label">Fecha de Registro:</label>
                                <input class="form-control" type="date" placeholder="Buscar por Fecha..." aria-label="Search" name="fecha_peticion">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Estado de Peticion:</label>
                                <select class="form-select" name="estado_peticion" id="estado_peticion">
                                    <option value="">Todas</option>
                                    <option value="ACEPTADA">ACEPTADA</option>
                                    <option value="RECHAZADA">RECHAZADA</option>
                                    <option value="ESPERA">EN ESPERA</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="col-md-12 form-label">Departamento de Peticion:</label>
                                <select class="col-md-12 form-select" name="departamento_peticion" id="departamento_peticion">
                                    <option selected value="">Todos...</option>
                                </select>
                            </div>

                            <!--options hidden-->
                            <input type="hidden" class="btn btn-success" name="id_usuario_sesion" value="<?PHP 
                            if(isset($_REQUEST['id_usuario_sesion'])){
                                echo $_REQUEST['id_usuario_sesion'];
                            }
                            ?>">
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
        <script>
            $(document).ready(function(){
                $.ajax({
                    type:"POST",
                    url:"../Controller/controllerDepartamentos.php",
                    data:{
                        option:"obtener"
                    },
                    dataType:'json',
                    success:function(msg){
                        msg.forEach(function(elemento){
                            let dep_emisor=$("#departamento_peticion");
                            dep_emisor.append("<option value='"+elemento['id_departamento']+"'>"+elemento["nombre_departamento"]+"</option>");
                        });
                    },
                    error:function(jqXHR,textStatus,errorThrown){
                        alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
                    }
                });

            });
        </script>
    </body>
</html>