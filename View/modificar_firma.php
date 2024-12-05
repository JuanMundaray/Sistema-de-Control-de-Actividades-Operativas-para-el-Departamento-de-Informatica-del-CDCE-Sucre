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
        <title>Modificar Firma CDCE</title>

    </head>

    <?php
        //Estas tres lineas de codigo desabilitan el cache
        header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP/1.1
        header("Pragma: no-cache");
        header("Expires: 0"); // Fecha en el pasado
            
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
                <h2 class="titleh2">Modificar Firma del CDCE</h2>
                <section class="secciones container">
                    <div class="container">

                        <form class="needs-validation row" method="post" action="../Controller/controllerSystem.php" enctype="multipart/form-data" novalidate>

                            <div class="card border-dark col-md-5 ">
                                <div class="card-header">Firma Actual</div>
                                <div class="card-body">
                                    <img class="w-100 h-100" src="./Resources/firmas/firma_cdce.jpg" id="firma_actual"/>
                                </div>
                            </div>

                            <div class="col-md-2"></div>

                            <div class="card border-dark col-md-5">
                                <div class="card-header">Imagen de la nueva firma</div>
                                <div class="card-body">
                                    <button type="button" id="restaurar_firma" class="btn position-absolute bottom-0 end-0">Restaurar a firma original</button>
                                    
                                    <input class="form-control" type="file" size=100 name="firma" id="firma" accept="image/jpeg" required>
                                    <div class="invalid-feedback">
                                        Este campo es requerido
                                    </div>
                                    <div>
                                        <img class="w-100 h-100 p-3" id="imagen_nueva">
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="option" value="cambiar_firma"/>


                            <!-- Boton para Cambiar Firma-->
                            <div class="col-md-12" style="text-align: center;margin-top: 50px;">
                                <button  class="btn btn-large btn-primary" role="button">

                                    <label>Cambiar Firma</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
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

        <script>
            document.getElementById('firma_actual').src="./Resources/firmas/firma_cdce.jpg"+'?'+new Date().getTime();

            let campo_nueva_firma=document.querySelector('#firma');
            campo_nueva_firma.addEventListener('change',(event)=>{
                const reader = new FileReader();
                const file=event.target.files[0];
                document.querySelector("#imagen_nueva").innerHTML=''; 
                
                if (file) {
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        
                        document.querySelector("#imagen_nueva").setAttribute('src',e.target.result);
                    }
                }
                reader.readAsDataURL(file);
            });



            let boton_restaurar_firma=document.querySelector('#restaurar_firma');
            boton_restaurar_firma.addEventListener('click',()=>{
                
                $.ajax({
                    type:"POST",
                    url:"../Controller/controllerSystem.php",
                    data:{
                        option:"restaurar_firma"
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
        </script>
    </body>
</html>