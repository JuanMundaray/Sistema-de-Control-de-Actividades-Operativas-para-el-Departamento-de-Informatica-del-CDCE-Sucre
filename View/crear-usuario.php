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
    <script src="./Plantillas/menu_desplegable-administrador.js"></script>
    <title>Crear Usuario</title>
</head>
    <script>
        $(document).ready(function(){
            $("#cedula").on('input',function(){
                var valor=$(this).val();
                $(this).val(valor.replace(/\D/g,""));
            });
        })
        
        $.ajax({
            type:"POST",
            url:"../Controller/controllerDepartamentos.php",
            data:{option:"obtener"},
            dataType:'json',
            success:function(msg){
                msg.forEach(function(elemento){
                    let departamento=$("#departamento");
                    departamento.append("<option value='"+elemento['id_departamento']+"'>"+elemento["nombre_departamento"]+"</option>");
                });
            },
            error:function(jqXHR,textStatus,errorThrown){
                alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
            }
        });
    </script>
<?php
    session_start();
    
    if(isset($_SESSION["tipo_usuario"])){
        if(($_SESSION["tipo_usuario"]!="administrador")){
            header("Location:./Dashboard.php");
            exit();
        }
    }else{
        header("Location:../Index");
        exit();
    }
    require_once("Plantillas/Plantilla_cabecera.php");
?>
<body>
    <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->
    <main>
        <div class="contenedorPrincipal">
            <h2 class="titleh2">Registrar Usuario</h2>

            <form class="formulario needs-validation" method="post" action="../Controller/controllerUsuario.php" novalidate>
                    <section id="secciones" class="secciones row">
                        <div class="col-md-10 div_input_form">
                            <label class="col-md-12 form-label">Nombre de Usuario:</label>
                            <input type="text"class="input_form col-md-12 form-control" name="username" id="username" placeholder="Nombre de Usuario" required>

                            <div class="invalid-feedback">
                                *Este Campo no Puede Estar Vacío
                            </div>
                        </div>

                        <div class="col-md-10 div_input_form">
                            <label class="col-md-12 form-label">Contraseña:</label>
                            <input type="text"class="input_form col-md-12 form-control" name="password" id="password" placeholder="****" minlength="4" required>

                            <div class="invalid-feedback">
                                *La Contraseña debe tener mínimo 4 dígitos
                            </div>
                        </div>

                        <div class="col-md-10 div_input_form">
                            <label class="col-md-12 form-label">Nombre:</label>
                            <input type="text"class=" input_form col-md-12 form-control" name="nombre" id="nombre" placeholder="Nombre" required>

                            <div class="invalid-feedback">
                                *Este Campo no Puede Estar Vacío
                            </div>
                        </div>

                        <div class="col-md-10 div_input_form">
                            <label class="col-md-12 form-label">Apellido:</label>
                            <input type="text"class=" input_form col-md-12 form-control" name="apellido" id="apellido" placeholder="Apellido" required>

                            <div class="invalid-feedback">
                                *Este Campo no Puede Estar Vacío
                            </div>

                        </div>

                        <div class="col-md-10 div_input_form">
                            <label class=" form-label" >Cedula de Identidad:</label>
                            <input type="text"class=" input_form col-md-12 form-control" name="cedula" id="cedula" placeholder="Cédula de Identidad" maxlength="10" minlength="9" required>

                            <div class="invalid-feedback">
                                *La Cédula debe tener como mínimo 9 dígitos
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

                        <div class="col-md-3 div_input_form">
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

                        <input type="hidden" value="crear" name="option" id="option">

                        <div class="col-md-12 form_button">
                            <input type="submit" class=" btn btn-primary col-md-3" value="Registrar Usuario" name="crear_usuario" id="create_user">
                        </div>
                        
                    </section>
                    <script src="./JS/validar.formularios.js"></script>
            </form>
        </div>
    </main>
    
</body>
</html>