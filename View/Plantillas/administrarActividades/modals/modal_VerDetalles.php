
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header bg-primary">
            <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">Detalles de la Actividad</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <div class="row justify-content-between">

                    <div class="col-md-6 py-2">
                        <label class="col-md-12 form-label"><strong >Código de Actividad:</strong></label>
                        <p id="p_codigo_actividad"></p>
                    </div>

                    <div class="col-md-6 py-2">
                        <label class="col-md-12 form-label"><strong >Nombre de Actividad:</strong></label>
                        <p id="p_nombre_actividad"></p>
                    </div>
                    
                    <div class="col-md-6 py-2">
                        <label class="col-md-12 form-label"><strong >Departamento Receptor:</strong></label>
                        <p id="p_dep_receptor"></p>
                    </div>
                    
                    <div class="col-md-6 py-2">
                        <label class="col-md-12 form-label"><strong >Departamento Emisor:</strong></label>
                        <p id="p_dep_emisor"></p>
                    </div>
                    
                    <div class="col-md-6 py-2">
                        <label class="col-md-12 form-label"><strong >Tipo de Actividad:</strong></label>
                        <p id="p_tipo"></p>
                    </div>
                    
                    <div class="col-md-6 py-2">
                        <label class="col-md-12 form-label"><strong >Estado de Actividad:</strong></label>
                        <p id="p_estado_actividad"></p>
                    </div>
                    
                    <div class="col-md-6 py-2">
                        <label class="col-md-12 form-label"><strong >Nombre del Responsable de la Actividad:</strong></label>
                        <p id="p_nom_responsable"></p>
                    </div>
                    
                    <div class="col-md-6 py-2">
                        <label class="col-md-12 form-label"><strong >Cédula del Responsable de la Actividad:</strong></label>
                        <p id="p_ced_responsable"></p>
                    </div>
                    
                    <div class="col-md-6 py-2">
                        <label class="col-md-12 form-label"><strong >Nombre del Funcionario Atendido:</strong></label>
                        <p id="p_nom_atendido"></p>
                    </div>
                    
                    <div class="col-md-6 py-2">
                        <label class="col-md-12 form-label"><strong >Cédula del Funcionario Atendido:</strong></label>
                        <p id="p_ced_atendido"></p>
                    </div>

                    <div class="col-md-12 py-2" id="p_div_observacion">
                        <!--Lo agrega js en caso de que este campo tenga informacion-->
                    </div>

                    <div class="col-md-12 py-2" id="p_div_informe">
                        <!--Lo agrega js en caso de que este campo tenga informacion-->
                    </div>

                    <div class="col-md-12 py-2" id=p_evidencia>
                        <!--Lo agrega js en caso de que este campo tenga informacion-->
                    </div>

                    <form class="py-5" style="text-align: center;" action="../Controller/controllerActividad.php" method="post">
                        <input type="hidden" value="exportarDetalles" name="option" id="option">
                        <input type="hidden" id="input_codigo_actividad" value="" name="codigo_actividad">
                        <button class="btn btn-primary" type="submit">
                            Imprimir Detalles
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                                <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
                                <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
                            </svg>
                        </button>
                    </form>
                    
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
    </div>
</div>
</div>