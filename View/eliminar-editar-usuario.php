    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8"><link rel="icon" href="../favicon.ico" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../Framework/bootstrap-5.3.0/css/bootstrap.css" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="CSS/EstiloCabecera.css" type="text/css">
        <link rel="stylesheet" href="CSS/MenuDelizante.css" type="text/css">
        <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">
        
        <script src="./Plantillas/menu_desplegable-administrador.js"></script>
        <title>Document</title>
    </head>
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
                <h2 class="titleh2">Opciones de Usuario</h2>
                <section class="secciones">
                    <!--Barra de Busqueda-->
                    <nav class="navbar navbar-expand-lg">
                        <div class="collapse navbar-collapse row" id="navbarSupportedContent">
                            <form class="form-inline">
                            <input class="form-control" type="search" placeholder="Buscar Usuario..." aria-label="Search">
                            <button class="btn btn-primary" type="submit">Buscar</button>
                            </form>
                        </div>
                    </nav>
                    
                        <table class="table table-bordered table-responsive">
                            <tr>
                                <th scope="col" class="align-middle"><label>ID de Usuario</label></th>
                                <th scope="col" class="align-middle"><label>Nombre de Usuario</label></th>
                                <th colspan="2" scope="col" class="align-middle"><label>acciones</label></th>
                                
                            <tr>
                                <td>hola</td>
                                <td>hola</td>
                                <td>hola</td>
                                <td>hola</td>
                            </tr>
                            
                        </table>
                        <div>
                            <p>Pagina 1-1</p>
                        </div>
                <section>
            </div>
        </main>
        <!-- <footer class="main-footer">
         To the right
        <div class="pull-right hidden-xs">
          <?php echo $dptoweb;?>
        </div>
        <strong>Copyright &copy; <!?php echo copyrigth3_app; ?> <a href="<!?php echo copyrigth2_app; ?>" target='_blank'><!?php echo copyrigth1_app; ?></a>.</strong> Todos los Derechos Reservados.
      </footer>-->
    </body>
</html>