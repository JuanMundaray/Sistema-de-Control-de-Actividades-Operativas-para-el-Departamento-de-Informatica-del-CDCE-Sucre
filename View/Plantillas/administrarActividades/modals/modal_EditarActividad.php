<!-- Modal -->
<div class="modal fade" id="ModalEditarActividad" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-white" id="ModalLabelEditarActividad">Editar Actividad</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            <form id="form_editar_actividad" class="formulario needs-validation" method="post" action="../Controller/controllerActividad.php" enctype="multipart/form-data" novalidate>
                    <section class="secciones row">
                        <input type="hidden" value="modificar" name="option">
                        <input type="hidden" id="edit_codigo" value="" name="codigo_actividad">

                        <div class="col-md-6 py-2">
                            <label class="col-md-12 form-label">Tipo de Actividad:</label>
                            <input type="text" class="col-md-12 form-control" disabled name="tipo" id="edit_tipo" readonly>
                        </div>
                        
                        <div class="col-md-12 py-2">
                            <label class="col-md-12 form-label">Nombre de Actividad:</label>
                            <input class="col-md-12 form-control" type="text" readonly disabled name="nombre" id="edit_nombre">
                        </div>

                        <div class="col-md-6 py-2">
                            <label class="col-md-12 form-label">Departamento Emisor:</label>
                            <input class="col-md-12 form-control" type="text" readonly disabled name="dep_emisor" id="edit_dep_emisor">
                        </div>

                        <div class="col-md-6 py-2">
                            <label class="col-md-12 form-label">Departamento Receptor:</label>
                            <input type="text" class="col-md-12 form-control" disabled name="dep_receptor" id="edit_dep_receptor" readonly>
                        </div>
                        
                        <div class="col-md-12 py-2" id="div_estado">
                                <label class="col-md-12 form-label">Estado:</label>
                                <select class="form-select" id="edit_estado" name="estado" required>
                                    <option selected disabled value="">Seleccione el estado a marcar...</option>
                                </select>

                                <div class="invalid-feedback">
                                    *Seleccione un Estado de Actividad Válido
                                </div>
                        </div>

                        <div class="col-md-12 div_input_form" id="div_evidencia" hidden>
                            <label class="col-md-12 form-label">Evidencia:</label>
                            <input class="form-control" type="file" size=100 name="evidencia" id="evidencia" accept="image/jpeg,image/png" required>
                        </div>

                        <div class="col-md-12 py-2">
                                <label class="col-md-12 form-label">Observacion:</label>
                                <textarea class="col-md-12 form-control"  maxlength="512" name="observacion" id="edit_observacion"></textarea>
                                <div class="form-text">*Este Campo es Opcional</div>
                        </div>

                        <div class="col-md-12 py-2">
                                <label class="col-md-12 form-label">Informe:</label>
                                <textarea class="col-md-12 form-control" maxlength="512" name="informe" id="edit_informe" placeholder="Informe sobre la realizacion de esta Actividad" minlength="4" required></textarea>

                                <div class="invalid-feedback">
                                    *Este Campo Debe Tener Como Mínimo 15 Carácteres
                                </div>
                        </div>

                        <div class="col-md-6 py-2">
                            <label class="col-md-12 form-label">Nombre del responsable:</label>
                            <input class="col-md-12 form-control" disabled type="text" name="nom_responsable" id="edit_nom_responsable" readonly>
                        </div>

                        <div class="col-md-6 py-2">
                            <label class="col-md-12 form-label">Nombre del Funcionario Atendido:</label>
                            <input class="col-md-12 form-control" type="text" name="nom_atendido" id="edit_nom_atendido" readonly disabled>
                        </div>
                        
                        <div class="col-md-6 py-2">
                            <label class="col-md-12 form-label">Apellido del responsable:</label>
                            <input class="col-md-12 form-control" type="text" name="ape_responsable" id="edit_ape_responsable" readonly disabled>
                        </div>

                        <div class="col-md-6 py-2">
                            <label class="col-md-12 form-label">Apellido del Funcionario Atendido:</label>
                            <input class="col-md-12 form-control" type="text" name="ape_atendido" id="edit_ape_atendido" readonly disabled>
                        </div>

                        <div class="col-md-6 py-2">
                            <label class="col-md-12 form-label">Cedula del Responsable:</label>
                            <input class="col-md-12 form-control" type="text" name="ced_responsable" id="edit_ced_responsable" maxlength="9" readonly disabled>
                        </div>
                        
                        <div class="col-md-6 py-2">
                            <label class="col-md-12 form-label">Cedula del Funcionario Atendido:</label>
                            <input class="col-md-12 form-control" type="text" name="ced_atendido" id="edit_ced_atendido" readonly disabled>
                        </div>
                        
                        <!--input hidden-->
                        <input type="hidden" value="modificar" name="option" id="option">

                        <div class="col-md-12 py-4 justify-content-center row">
                            <input type="submit" class=" input_submit btn btn-primary col-md-4" value="Modificar Actividad" name="modificar_actividad" id="modificar_actividad">
                        </div>

                    </section>
            </form>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>