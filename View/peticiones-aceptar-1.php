<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><link rel="icon" href="../favicon.ico" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Actividad</title>
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
            if(($_SESSION["tipo_usuario"]=="invitado")){
                header("Location:./Dashboard.php");
                exit();
            }
        }
        else{
            header("Location:../index.php");
            exit();
        }
        if(!isset($_REQUEST['id_peticion'])){
            header("Location:./Dashboard.php");
            exit();
        }

        require_once("Plantillas/Plantilla_cabecera.php");
        ?>
    <link rel="stylesheet" href="../Framework/bootstrap-5.3.0/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="CSS/EstiloCabecera.css" type="text/css">
    <link rel="stylesheet" href="CSS/MenuDelizante.css" type="text/css">
    <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">
    <link rel="stylesheet" href="CSS/formulario.css" type="text/css">
    
    <script src="../Framework/jquery-3.6.3.min.js"></script>
    <script>
    $(document).ready(function(){
        //Rellenar los datos del usuario atendido para aceptar su peticion
        $.ajax({
            async:false,
            type:"POST",
            url:"../Controller/controllerPeticion.php",
            data:{
                option:"obtener",
                id_peticion:$('#id_peticion').val()
                },
            dataType:'json',
            success:function(msg){
                console.log(msg);
                msg.forEach(function(elemento){
                    $("#dep_emisor").val(elemento['nombre_departamento']);
                    $("#id_tipo_actividad").val(elemento['tipo_actividad']);
                    $("#modalDetallesPeticion .modal-body").append(elemento['detalles_peticion']);
                });
            },
            error:function(jqXHR,textStatus,errorThrown){
                alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
            }
        });

    });
</script>
</head>
<?php
        ?>
<body>
    <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->
    <main>
        <input type="hidden" value="<?PHP echo $_SESSION['id_usuario'] ?>" name="id_usuario_sesion" id="id_usuario_sesion">
        <h1 class="titleh1">Aceptar Peticion 1/2</h1>
        <div class="contenedorPrincipal">
            <!--Comienzo del Formuloario-->
            <form class="needs-validation" id="crear_actividad_peticion" action="./peticiones-aceptar-2.php" novalidate>
                    <h2 class="titleh2">Datos de Actividad Generada</h2>
                    <section class="secciones row gy-2">
                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Codigo de Registro:</label>
                            <input class="col-md-12 form-control is-disabled" readonly type="text" name="codigo_actividad" id="codigo_actividad">
                        </div>

                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Nombre de Actividad:</label>
                            <input class="col-md-12 form-control" type="text" name="nombre_actividad" id="nombre_actividad" pattern="[a-zA-Z0-9 ]{4,}" required>
                            <div class="invalid-feedback">
                                Este Campo no puede esta vacío
                            </div>
                        </div>

                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Tipo de Actividad:</label>
                            <select class="col-md-12 input_form form-select" required name="id_tipo_actividad" id="id_tipo_actividad">
                                <option selected disabled value="">Seleccione...</option>
                            </select>
                                
                            <div class="invalid-feedback">
                                Seleccione un Tipo de Actividad Válido
                            </div>
                        </div>

                        <div class="col-md-6 div_input_form"> 
                            <label class="col-md-12 form-label">Fecha de Inicio:</label>
                            <input class="col-md-12 form-control" type="date" name="fecha_inicio" id="fecha_inicio" placeholder="Fecha de Registro" required>
                        </div>

                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Departamento Emisor:</label>
                            <input type="text" class="col-md-12 form-select is-disabled" name="dep_emisor" id="dep_emisor" readonly required>
                            <div class="invalid-feedback">
                                Elija un Departamento Valido
                            </div>
                        </div>

                        <div class="col-md-6 div_input_form">
                            <label class="col-md-12 form-label">Departamento Receptor:</label>
                            <input type="text" class="col-md-12 form-select  is-disabled" name="dep_receptor" id="dep_receptor" readonly required>
                            <div class="invalid-feedback">
                                Elija un Departamento Valido
                            </div>
                        </div>

                        <div class="col-md-12 div_input_form">
                                <label class="col-md-12 form-label">Observacion:</label>
                                <textarea class="col-md-12 form-control" name="observacion" id="observacion">Actividad Generada de Peticion.
                                </textarea>
                                <div id="emailHelp" class="form-text">*Este Campo es Opcional</div>
                        </div>
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary col-md-3" data-bs-toggle="modal" data-bs-target="#modalDetallesPeticion">
                                Leer Detalles de la Peticion
                            </button>
                        </div>

                        <!--Input type hiddens-->
                        <input type="hidden" value="<?PHP echo $_SESSION['id_usuario'] ?>" name="id_usuario_responsable" id="id_usuario_responsable">
                        <input type="hidden" value="<?PHP echo $_REQUEST['id_peticion'] ?>" id="id_peticion" name="id_peticion">
                        <!--Input type hiddens-->

                        <div class="col-md-12" style="text-align: center;">
                            <button type="submit" class="btn btn-primary">Siguiente</button>
                        </div>

                    </section>
            </form>
            <!--Fin del Formulario-->

            <!-- Modal -->
            <div class="modal fade" id="modalDetallesPeticion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Detalles de la Peticion</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Comprendido</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>                    
        <?php require_once("./Plantillas/administrarTipoActividad/notificacionRegistro.php") ?>
        <?php require_once("./Plantillas/administrarTipoActividad/modalRegistrarTipoActividad.php") ?>
        <script src="JS/js.actividades/RegistrarActividad/js.registrar_actividad-1.js"></script>
        <script src="JS/validar.formularios.js"></script>
        <script src="../Framework/bootstrap-5.3.0/js/bootstrap.bundle.js"></script>
        <script src="./JS/js.tipo_actividad/modalTipoActividad.js"></script>
    
</body>
</html>