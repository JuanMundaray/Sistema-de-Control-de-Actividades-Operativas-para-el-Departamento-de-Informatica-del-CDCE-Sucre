<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><link rel="icon" href="../favicon.ico" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Framework/bootstrap-5.3.0/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="CSS/EstiloCabecera.css" type="text/css">
    <link rel="stylesheet" href="CSS/MenuDelizante.css" type="text/css">
    <link rel="stylesheet" href="CSS/formulario.css" type="text/css">
    <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">
    <title>Crear Usuario</title>
</head>
    <script src="../Framework/bootstrap-5.3.0/js/bootstrap.min.js"></script>
<?php
    ini_set('session.cache_limiter','public');
    session_cache_limiter(false);
    session_start();
    
    if(isset($_SESSION["tipo_usuario"])){
        if(($_SESSION["tipo_usuario"]!="administrador")){
            header("Location:./Dashboard.php");
            exit();
        }
    }else{
        header("Location:../index.php");
        exit();
    }
    require_once("Plantillas/Plantilla_cabecera.php");
?>
<body>
    <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->
    <main>
        <h1 class="titleh1">Crear Usuario 2/2</h1>
        <div class="contenedorPrincipal">
            <h2 class="titleh2">Datos de Cuenta de Usuario</h2>

            <form class="formulario needs-validation" id="form_crear_usuario_part2" method="post" novalidate>
                <?php 
                    echo '<input type="hidden" name="nombre" value="'.$_REQUEST['nombre'].'">';
                    echo '<input type="hidden" name="apellido" value="'.$_REQUEST['apellido'].'">';
                    echo '<input type="hidden" name="cedula" value="'.$_REQUEST['cedula'].'">';

                    if ($_REQUEST['cedula'] < 9900000) {
                        header("Location:usuario-crear-1.php");
                    }
                ?>
                <section id="secciones" class="secciones row">
                   
                    <div class="col-md-10 div_input_form" id="container_username">
                        <label class="form-label">Nombre de Usuario:</label>
                        <input type="text"class="input_form col-md-12 form-control" name="username" id="username" placeholder="Nombre de Usuario" minlength="4" maxlength="50" pattern="[a-zA-Z0-9]{4,}" required>

                        <div class="invalid-feedback">
                            *El Nombre de Usuario Debe de Tener Como Mínimo 4 Carácteres
                        </div>
                    </div>

                    <div class="col-md-10 div_input_form" id="container_password">
                        <label class="col-md-12 form-label">Contraseña:</label>
                        <input type="text"class="input_form col-md-12 form-control" name="password" id="password" placeholder="****" minlength="4" maxlength="50" pattern="[0-9a-zA-Z]{4,}" required>

                        <div class="invalid-feedback">
                            *El Nombre de Usuario Debe de Tener Como Mínimo 4 Carácteres
                        </div>
                    </div>
                    <div class="col-md-10 div_input_form" id="container_departamento">
                        <label class="col-md-12 form-label">Departamento:</label>
                        <select class="col-md-12 form-select" name="departamento" id="departamento" required>
                            <option selected disabled value="">Seleccione...</option>
                        </select>
                        <div class="invalid-feedback">
                            *Elija un Departamento Valido
                        </div>
                    </div>

                    <!--input hidden-->
                    <input type="hidden" name="option" id="option" value="crear">

                    <div class="col-md-6 div_input_form">
                        <label class="form-label" >Seleccione el tipo de usuario:</label>
                        <select class="input_form form-select" name="tipo_usuario" id="tipo_usuario" required>
                            <option selected disabled value="">Seleccione...</option>
                            <option value="estandar">Usuario Estandar</option>
                            <option value="administrador">Administrador</option>
                            <option value="invitado">Invitado</option>
                        </select>

                        <div class="invalid-feedback">
                            *Elija un Tipo de Usuario Válido
                        </div>
                    </div>


                    <div class="col-md-12 form_button">
                        <input type="submit" class=" btn btn-primary col-md-3" value="Crear Usuario" name="crear_usuario" id="create_user">
                    </div>
                    
                </section>
            </form>
            
            <!-- Modal -->

            <div class="modal fade" id="confirmarRegistroUsuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="confirmarRegistro" aria-hidden="true">

                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white ">
                            <h1 class="modal-title fs-5">¿Seguro que desea Registrar Este Usuario?</h1>

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="row justify-content-between gx-3">
                                    <div class="row col-md-12 pb-4">
                                        <div class="col-md-12 text-nowrap">Nombre de Usuario:</div>
                                        <div class="col-md-12" id="label_username"></div>
                                    </div>

                                    <div class="row col-md-6 pb-4">
                                        <div class="col-md-12 text-nowrap">Nombre:</div>
                                        <div class="col-md-12"><?php echo $_REQUEST['nombre']; ?></div>
                                    </div>

                                    <div class="row col-md-6 pb-4">
                                        <div class="col-md-12 text-nowrap">Apellido:</div>
                                        <div class="col-md-12"><?php echo $_REQUEST['apellido']; ?></div>
                                    </div>

                                    <div class="row  col-md-6 pb-4">
                                        <div class="col-md-12 text-nowrap">Cédula:</div>
                                        <div class="col-md-12"><?php echo $_REQUEST['cedula']; ?></div>
                                    </div>

                                    <div class="row col-md-6 pb-4">
                                        <div class="col-md-12 text-nowrap">Departamento:</div>
                                        <div class="col-md-12" id="label_departamento"></div>
                                    </div>

                                    <div class="row col-md-6 pb-4">
                                        <div class="col-md-12 text-nowrap">Tipo de Usuario:</div>
                                        <div class="col-md-12" id="label_tipo_usuario"></div>
                                    </div>
                                    <div class="row  col-md-6 pb-4">
                                        <div class="col-md-12 text-nowrap">Contraseña:</div>
                                        <div class="col-md-12" id="label_password"></div>
                                    </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="CancelarRegistrarUsuario" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" id="ConfirmarRegistrarUsuario" class="btn btn-primary">Confirmar</button>
                        </div>
                    </div>
                </div>
            </div>

            <script src="../Framework/jquery-3.6.3.min.js"></script>
            <script src="./Plantillas/menu_desplegable-administrador.js"></script>
            <script src="./JS/validar.formularios.js"></script>
            <script src="./JS/js.usuarios/js.registrarUsuario/registrarUsuario2/index.js" type="module"></script>
            <script src="./JS/js.usuarios/js.registrarUsuario/registrarUsuario2/index.js" type="module"></script>
            <script src="./JS/js.departamentos/modalDepartamentos.js"></script>
</main>
<?php require_once("./Plantillas/administrarUsuarios/toast/toast.php"); ?>
<?php require_once("./Plantillas/administrarDepartamentos/modalRegistrarDepartametos.php"); ?>
</body>
</html>