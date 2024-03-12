    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../Framework/bootstrap-5.3.0/css/bootstrap.css" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="CSS/EstiloCabecera.css" type="text/css">
        <link rel="stylesheet" href="CSS/MenuDelizante.css" type="text/css">
        <link rel="stylesheet" href="CSS/contenedoresPrincipales.css" type="text/css">
        
        <script src="JS/menu_desplegable-administrador.js"></script>
        <title>Document</title>
    </head>
    <?php
            require_once("Plantillas/Plantilla_cabecera.php");
        ?>
    <body>
        
        
        <nav id="menuLateral"></nav><!--Menu lateral creado por medio del DOM de js-->

        <main>
            <div class="contenedorPrincipal">
                <h2 class="titleh2">Historial de Actividades</h2>
                <section class="secciones">
                    <!--Barra de Busqueda-->
                    <nav class="navbar navbar-expand-lg">
                        <div class="collapse navbar-collapse row" id="navbarSupportedContent">
                            <form class="form-inline">
                            <input class="form-control" type="search" placeholder="Buscar Actividad..." aria-label="Search">
                            <button class="btn btn-primary" type="submit">Buscar</button>
                            </form>
                        </div>
                    </nav>
                    <nav>
                            <label for="">Filtrar por:</label>
                            <select>
                                <option>Año</option>
                                <option>Mes</option>
                                <option>Semana</option>
                                <option>Completadas</option>
                                <option>Pendientes</option>
                                <option>Eliminadas</option>
                            </select>
                                
                    </nav>
                    
                        <table class="table table-bordered table-responsive table-default">
                            <tr>
                                <th scope="col" class="align-middle"><label>Codigo de Registro</label></th>
                                <th scope="col"><label>Fecha de Registro</label></th>
                                <th scope="col"><label>Actividad</label></th>
                                <th scope="col"><label>dep_receptor</label></th>
                                <th scope="col"><label>Nombre del Responsable</label></th>
                                <th scope="col"><label>Cedula del Responsable</label></th>
                                <th><label>Fecha de Borrado</label></th>
                            </tr>
                            <tr>
                                <td>hola</td>
                                <td>hola</td>
                                <td>hola</td>
                                <td>hola</td>
                                <td>hola</td>
                                <td>31157430</td>
                                <td>22/02/25</td>
                            </tr>
                            
                        </table>
                        <div class="row">
                            <div class="col-md-6">
                                <p>Pagina 1-1</p>
                            </div>
                            <div class="col-md-6">
                                <button>Exportar a PDF</button>
                                
                                <button>Exportar a EXEL</button>
                            </div>
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