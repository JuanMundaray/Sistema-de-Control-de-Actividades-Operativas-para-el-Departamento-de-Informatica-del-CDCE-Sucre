
<!-- Modal -->
<div class="modal fade" id="ModalExportarActividad" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header bg-danger">
            <h1 class="modal-title fs-5 text-white" id="ModalLabelExportarActividad">Exportar Tabla Actividad a PDF</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <!--id del usuario que tienen abierta la sesion-->
            <input type="hidden" value="<?PHP echo $_SESSION['tipo_usuario']?>" id="tipo_usuario">
            <!----------------------------------------------->
            <div class="container-fluid">
                <form class="row gy-3 gx-4" method="post" action="../Controller/controllerActividad.php">

                    <!-- Obligar a las siguientes columnas a pasar a una nueva línea en el breakpoint md y hacia arriba -->
                    <div class="w-100 d-none d-md-block"></div>
                                
                    <div class="col-md-3 ">
                        <label class="label-sm form-label text-nowrap">Día de Registro:</label>
                        <select class="form-select" id="day" name="day">
                            <option value="">Cuaquiera</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="label-sm form-label text-nowrap">Mes de Registro:</label>
                        <select class="form-select" id="month" name="month">
                            <option value="">Cuaquiera</option>
                            <option value="1">Enero</option>
                            <option value="2">Febrero</option>
                            <option value="3">Marzo</option>
                            <option value="4">Abril</option>
                            <option value="5">Mayo</option>
                            <option value="6">Junio</option>
                            <option value="7">Julio</option>
                            <option value="8">Agosto</option>
                            <option value="9">Septiembre</option>
                            <option value="10">Octubre</option>
                            <option value="11">Noviembre</option>
                            <option value="12">Diciembre</option>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="label-sm form-label text-nowrap">Año de Registro:</label>
                        <select class="form-select" id="year" name="year">
                            <option value="">Cuaquiera</option>
                        </select>
                    </div>

                    <!-- Obligar a las siguientes columnas a pasar a una nueva línea en el breakpoint md y hacia arriba -->
                    <div class="w-100 d-none d-md-block"></div>

                    <div class="col-md-4">
                        <label class="form-label">Estado de Actividad:</label>
                        <select class="form-select" name="estado_actividad" id="estado_actividad">
                            <option value="">Todas</option>
                        </select>
                    </div>

                    <!-- Obligar a las siguientes columnas a pasar a una nueva línea en el breakpoint md y hacia arriba -->
                    <div class="w-100 d-none d-md-block"></div>

                    <div class="col-md-4">
                        <label class="col-md-12 form-label">Departamento Receptor:</label>
                        <select class="col-md-12 form-select" name="dep_receptor" id="dep_receptor">
                            <option selected value="">Todos...</option>
                        </select>
                    </div>

                    <div class="col-md-4 offset-md-2">
                        <label class="col-md-12 form-label">Departamento Emisor:</label>
                        <select class="col-md-12 form-select" name="dep_emisor" id="dep_emisor">
                            <option selected value="">Todos...</option>
                        </select>
                    </div>

                    <!--options hidden-->
                    <input type="hidden" name="id_usuario_sesion" value="<?PHP 
                    if(isset($_REQUEST['id_usuario_sesion'])){
                        echo $_REQUEST['id_usuario_sesion'];
                    }
                    ?>">

                    <?php

                    if(isset($_REQUEST['todas'])){
                        echo '<input type="hidden" name="todas" id="todas" value=true>';
                    }

                    ?> 

                    <input type="hidden" class="btn btn-success" name="option" value="exportarPDF">

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

            <script src="../Framework/jquery-3.6.3.min.js"></script>
            <script src="./JS/js.generar_reportes/generar_reportes_actividad.js"></script>
            <script src="./JS/obtenerListaDay_Month_Year.js"></script>
            <script>
                $(document).ready(function(){
                    const date=new Date();
                    $("#month").val((date.getMonth())+1);
                    $("#year").val(date.getFullYear());
                });
            </script>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
    </div>
</div>
</div>