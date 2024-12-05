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
        <title>Modificar Cabecera</title>

    </head>

    <?php
        //Estas tres lineas de codigo desabilitan el cache
        
        header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
        header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado

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
            
            <div class="contenedorPrincipal mt-5">
                <h2 class="titleh2">Modificar Imágenes de la Cabecera</h2>
                <section class="secciones container">
                    <div class="container">

                        <div class="card border-dark col-md-8 p-3 ">
                        <h3 class="mb-3">Logo CDCE</h3>
                            
                            <form class="needs-validation row" method="post" action="../Controller/controllerSystem.php" enctype="multipart/form-data" novalidate>

                            <div class="card border-gray col-md-6">
                                <div class="card-header text-nowrap">Imagen Actual</div>
                                <div class="card-body">
                                    <img class="w-100 h-100" src="./Resources/Imagenes/CDCE-logo-ministerio-de-educacion.png<?php echo "?v=".rand(1000,9999)?>"/>
                                </div>
                            </div>

                            <div class="card border-gray col-md-6">
                                <div class="card-header text-nowrap">Nueva Imagen</div>
                                <div class="card-body">
                                    <button type="button" id="restaurar_logo" class="btn position-absolute bottom-0 end-0">Restaurar Logo</button>
                                    
                                    <input class="form-control" type="file" size=100 name="logo" id="logo" accept="image/png" required>
                                    <div class="invalid-feedback">
                                        Este campo es requerido
                                    </div>

                                    <div>
                                        <img class="w-100 h-100 p-3" id="logo_nuevo">
                                    </div>

                                </div>
                            </div>

                            <input type="hidden" name="option" value="cambiar_logo"/>

                            <!-- Boton para Firmar Actividad -->
                            <div class="col-md-12" style="text-align: center;margin-top: 30px;">
                                <button  class="btn btn-large btn-primary" role="button">

                                    <label>Cambiar Logo</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                    </svg>

                                </button>
                            </div>
                            </form>
                        </div>

                        <!---------------------------------------------------------------------------->
                        <div class="card border-dark col-md-10 p-3 mt-3">
                        <h3 class="mb-3">Logo y Nombre del CDCE</h3>
                            
                            <form class="needs-validation row" method="post" action="../Controller/controllerSystem.php" enctype="multipart/form-data" novalidate>

                            <div class="card border-gray col-md-6">
                                <div class="card-header text-nowrap">Imagen Actual</div>
                                <div class="card-body">
                                    <img class="w-100 h-100" src="./Resources/Imagenes/logo.jpg<?php echo "?v=".rand(1000,9999)?>"/>
                                </div>
                            </div>

                            <div class="card border-gray col-md-6">
                                <div class="card-header text-nowrap">Nueva Imagen</div>
                                <div class="card-body">
                                    <button type="button" id="restaurar_logo_nombre" class="btn position-absolute bottom-0 end-0">Restaurar Logo</button>
                                    
                                    <input class="form-control" type="file" size=100 name="logo_nombre" id="logo_nombre" accept="image/jpeg" required>
                                    <div class="invalid-feedback">
                                        Este campo es requerido
                                    </div>

                                    <div>
                                        <img class="w-100 h-100 p-3" id="logo_nuevo">
                                    </div>

                                </div>
                            </div>

                            <input type="hidden" name="option" value="cambiar_logo_nombre"/>

                            <!-- Boton para Firmar Actividad -->
                            <div class="col-md-12" style="text-align: center;margin-top: 30px;">
                                <button  class="btn btn-large btn-primary" role="button">

                                    <label>Cambiar Logo</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                    </svg>

                                </button>
                            </div>
                            </form>
                        </div>

                        <!----------------------------------------------------------------------------->
                        <div class="card border-dark col-md-8 p-3 mt-3">
                            <h3 class="mb-3">Imagen Derecha de la Cabecera</h3>
                            <form class="needs-validation row" method="post" action="../Controller/controllerSystem.php" enctype="multipart/form-data" novalidate>

                                <div class="card border-gray col-md-6">
                                    <div class="card-header text-nowrap">Imagen Actual</div>
                                    <div class="card-body">
                                        <img class="w-100 h-100" src="./Resources/Imagenes/logo-zamora-03.png<?php echo "?v=".rand(1000,9999)?>"/>
                                    </div>
                                </div>

                                <div class="card border-gray col-md-6">
                                    <div class="card-header text-nowrap">Nueva Imagen</div>
                                    <div class="card-body">

                                        <button type="button" id="restaurar_imagen_derecha" class="btn position-absolute bottom-0 end-0">Restaurar Imagen</button>
                                        
                                        <input class="form-control" type="file" size=100 name="imagen_derecha" id="imagen_derecha" accept="image/png" required>
                                        <div class="invalid-feedback">
                                            Este campo es requerido
                                        </div>

                                        <div>
                                            <img class="w-100 h-100 p-3" id="imagen_derecha_nueva">
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="option" value="cambiar_imagen_derecha"/>

                                <!-- Boton para Cambiar Imagen Izquierda de Cabecera -->
                                <div class="col-md-12" style="text-align: center;margin-top: 30px;">
                                    <button  class="btn btn-large btn-primary" role="button">

                                        <label>Cambiar Imagen de la Derecha</label>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                        </svg>

                                    </button>
                                </div>
                            </form>
                        </div>

                        <!----------------------------------------------------------------------------->
                        <div class="card border-dark col-md-12 p-4 mt-3">
                        <h3 class="mb-3">Logo del Ministerio de Educación</h3>
                        
                            <form class="needs-validation row" method="post" action="../Controller/controllerSystem.php" enctype="multipart/form-data" novalidate>

                                <div class="card border-gray col-md-6">
                                    <div class="card-header text-nowrap">Imagen Actual</div>
                                    <div class="card-body">
                                        <img class="w-100 h-100" src="./Resources/Imagenes/logo_ministerio.png<?php echo "?v=".rand(1000,9999)?>"/>
                                    </div>
                                </div>

                                <div class="card border-gray col-md-6">
                                    <div class="card-header text-nowrap">Nueva Imagen</div>
                                    <div class="card-body">

                                        <button type="button" id="restaurar_imagen_izquierda" class="btn position-absolute bottom-0 end-0">Restaurar Imagen</button>
                                        
                                        <input class="form-control" type="file" size=100 name="imagen_izquierda" id="imagen_izquierda" accept="image/png" required>
                                        <div class="invalid-feedback">
                                            Este campo es requerido
                                        </div>

                                        <div>
                                            <img class="w-100 h-100 p-3" id="imagen_izquierda_nueva">
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="option" value="cambiar_imagen_izquierda"/>

                                <!-- Boton para Cambiar imagen derecha de la cabecera -->
                                <div class="col-md-12" style="text-align: center;margin-top: 30px;">
                                    <button  class="btn btn-large btn-primary" role="button">

                                        <label>Cambiar Logo del Ministerio de Educación</label>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                        </svg>

                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    </div>
                <section>
            </div>
        </main>

        <script src="../Framework/jquery-3.6.3.min.js"></script>
        <script src="./JS/validar.formularios.js"></script>

        <script>
            cambiar_imagen('logo','logo_nuevo');
            cambiar_imagen('imagen_izquierda','imagen_izquierda_nueva');
            cambiar_imagen('imagen_derecha','imagen_derecha_nueva');

            let boton_restaurar_logo=document.querySelector('#restaurar_logo');
            boton_restaurar_logo.addEventListener('click',()=>{
                
                $.ajax({
                    type:"POST",
                    url:"../Controller/controllerSystem.php",
                    data:{
                        option:"restaurar_logo"
                    },
                    dataType:'text',
                    success:function(msg){
                        location.reload();
                    },
                    error:function(jqXHR,textStatus,errorThrown){
                        alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
                    }
                });
            });

            let boton_restaurar_imagen_izquierda=document.querySelector('#restaurar_imagen_izquierda');
            boton_restaurar_imagen_izquierda.addEventListener('click',()=>{
                
                $.ajax({
                    type:"POST",
                    url:"../Controller/controllerSystem.php",
                    data:{
                        option:"restaurar_imagen_izquierda"
                    },
                    dataType:'text',
                    success:function(msg){
                        location.reload();
                    },
                    error:function(jqXHR,textStatus,errorThrown){
                        alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
                    }
                });
            });

            let boton_restaurar_imagen_derecha=document.querySelector('#restaurar_imagen_derecha');
            boton_restaurar_imagen_derecha.addEventListener('click',()=>{
                
                $.ajax({
                    type:"POST",
                    url:"../Controller/controllerSystem.php",
                    data:{
                        option:"restaurar_imagen_derecha"
                    },
                    dataType:'text',
                    success:function(msg){
                        location.reload();
                    },
                    error:function(jqXHR,textStatus,errorThrown){
                        alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
                    }
                });
            });

            let boton_restaurar_logo_nombre=document.querySelector('#restaurar_logo_nombre');
            boton_restaurar_logo_nombre.addEventListener('click',()=>{
                
                $.ajax({
                    type:"POST",
                    url:"../Controller/controllerSystem.php",
                    data:{
                        option:"restaurar_logo_nombre"
                    },
                    dataType:'text',
                    success:function(msg){
                        location.reload();
                    },
                    error:function(jqXHR,textStatus,errorThrown){
                        alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
                    }
                });
            });

            function cambiar_imagen(campo_imagen,nueva_imagen){
                let campo_nueva_imagen=document.querySelector(`#${campo_imagen}`);
                campo_nueva_imagen.addEventListener('change',(event)=>{
                    const reader = new FileReader();
                    const file=event.target.files[0];
                    document.querySelector(`#${nueva_imagen}`).innerHTML=''; 
                    
                    if (file) {
                        reader.onload = function(e) {
                            const img = document.createElement('img');
                            
                            document.querySelector(`#${nueva_imagen}`).setAttribute('src',e.target.result);
                        }
                    }
                    reader.readAsDataURL(file);
                });

            }

        </script>
    </body>
</html>