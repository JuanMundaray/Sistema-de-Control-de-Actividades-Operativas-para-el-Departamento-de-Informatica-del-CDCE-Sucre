<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Framework/bootstrap-5.3.0/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="../Framework/bootstrap-icons-1.11.1/bootstrap-icons.min.css" type="text/css">
    <link rel="stylesheet" href="CSS/EstiloCabecera.css" type="text/css">
    <link rel="stylesheet" href="CSS/MenuDelizante.css" type="text/css">
    <link rel="stylesheet" href="CSs/formulario.css" type="text/css">
    <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">
    <script src="../Framework/jquery-3.6.3.min.js"></script>
    <script src="JS/menu_desplegable.js"></script>
</head>
<?php
            require_once("Plantillas/Plantilla_cabecera.php");
        ?>
<body>
    <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->
    <main>
        <div class="contenedorPrincipal">
            <h2 class="titleh2">Registrar Usuario</h2>

            <form class="formulario" method="post">
                    <section id="secciones" class="secciones row">
                        <div class="col-md-10 div_input_form">
                            <label class="col-md-12 form-label">Nombre de Usuario:</label>
                            <input type="text"class="input_form col-md-12 form-control" name="username" id="username" placeholder="Nombre de Usuario">
                            <i class="bi-key" style="font-size: 2rem; color: black;opacity:0.8;"></i>
                            
                            
                        </div>
                        <div class="col-md-10 div_input_form">
                            <label class="col-md-12 form-label">Contraseña:</label>
                            <input type="text"class="input_form col-md-12 form-control" name="password" id="password" placeholder="****">
                        </div>
                        <div class="col-md-10 div_input_form">
                            <label class="col-md-12 form-label">Nombre:</label>
                            <input type="text"class=" input_form col-md-12 form-control" name="nombre" id="nombre" placeholder="Nombre">
                        </div>
                        <div class="col-md-10 div_input_form">
                            <label class="col-md-12 form-label">Apellido:</label>
                            <input type="text"class=" input_form col-md-12 form-control" name="apellido" id="apellido" placeholder="Apellido">
                        </div>
                        <div class="col-md-10 div_input_form">
                            <label class=" form-label" >Cedula de Identidad:</label>
                            <input type="text"class=" input_form col-md-12 form-control" name="cedula_usuario" id="cedula_usuario" placeholder="Cédula de Identidad">
                        </div>
                        <div class="col-md-3 div_input_form">
                            <label class="form-label" >Seleccione el tipo de usuario:</label>
                            <select class="input_form form-select" name="profile" id="profile">
                                <option value="usuario_simple">Usuario Simple</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Invitado">Invitado</option>
                            </select>
                        </div>
                        <input type="hidden" value="crear" name="option" id="option">
                        <div class="col-md-12 form_button">
                            <input type="button" class=" btn btn-primary col-md-3" value="Registrar Usuario" name="crear_usuario" id="create_user">
                        </div>
                        
                    </section>
            </form>
        </div>
    </main>
    
</body>
</html>