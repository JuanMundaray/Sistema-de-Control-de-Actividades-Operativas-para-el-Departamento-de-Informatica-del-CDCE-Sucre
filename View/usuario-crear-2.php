<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><link rel="icon" href="../favicon.ico" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Framework/bootstrap-5.3.0/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="../Framework/bootstrap-icons-1.11.1/bootstrap-icons.min.css" type="text/css">
    <link rel="stylesheet" href="CSS/EstiloCabecera.css" type="text/css">
    <link rel="stylesheet" href="CSS/MenuDelizante.css" type="text/css">
    <link rel="stylesheet" href="CSs/formulario.css" type="text/css">
    <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">
    <script src="../Framework/jquery-3.6.3.min.js"></script>
    <script src="./JS/js.usuarios/js.registrar_usuario.js"></script>
    <script src="./Plantillas/menu_desplegable-administrador.js"></script>
    <title>Crear Usuario</title>
</head>
    <script>
    </script>
<?php
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
        <h1 class="titleh1">Crear Usuario</h1>
        <div class="contenedorPrincipal">
            <h2 class="titleh2">Datos de Cuenta de Usuario</h2>

            <form class="formulario needs-validation" method="post" action="./usuario-crear-3.php" novalidate>
                <?php 
                    echo '<input type="hidden" name="nombre" value="'.$_REQUEST['nombre'].'">';
                    echo '<input type="hidden" name="apellido" value="'.$_REQUEST['apellido'].'">';
                    echo '<input type="hidden" name="cedula" value="'.$_REQUEST['cedula'].'">';
                ?>
                <section id="secciones" class="secciones row">
                    <div class="col-md-10 div_input_form">
                        <label class="form-label">Nombre de Usuario:</label>
                        <input type="text"class="input_form col-md-12 form-control" name="username" id="username" placeholder="Nombre de Usuario" minlength="4" maxlength="50" required>

                        <div class="invalid-feedback">
                            *El Nombre de Usuario Debe de Tener Como Mínimo 4 Carácteres
                        </div>
                    </div>

                    <div class="col-md-10 div_input_form">
                        <label class="col-md-12 form-label">Contraseña:</label>
                        <input type="text"class="input_form col-md-12 form-control" name="password" id="password" placeholder="****" minlength="4" maxlength="50" required>

                        <div class="invalid-feedback">
                            *La Contraseña Debe de Tener Como Mínimo 4 Carácteres
                        </div>
                    </div>

                    <div class="col-md-10 div_input_form">
                        <label class="col-md-12 form-label">Departamento:</label>
                        <select class="col-md-12 form-select" name="departamento" id="departamento" required>
                            <option selected disabled value="">Seleccione...</option>
                        </select>
                        <div class="invalid-feedback">
                            *Elija un Departamento Valido
                        </div>
                    </div>

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
                <script src="./JS/validar.formularios.js"></script>
            </form>
        </div>
    </main>
    
</body>
</html>