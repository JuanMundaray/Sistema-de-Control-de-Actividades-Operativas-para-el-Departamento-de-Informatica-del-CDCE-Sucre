<div class="modal fade" id="modalTipoActividad" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color:rgb(255, 60, 0);">
                <h4 class="modal-title fw-semibold">Crear Tipo de Actividad</h4>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation container-fluid w-100" id="formTipoActividad" method="post" novalidate id="form-tipo">
                <div>
                    <label class="form-label">Tipo de Actividad a Registrar:</label>
                    <input class="form-control" type="text" name="nombre_tipo" id="nombre_tipo" pattern="[a-zA-Z0-9 ]{4,}" required maxlength="50">
                    <div class="invalid-feedback">
                        *Este Campo Debe Tener Como Mínimo 4 Caracteres
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input class="col-md-7" type="hidden" value="crear" name="option" id="option">
                
                <button type="submit" class="btn btn-primary col-md-3" value="Crear Tipo de Actividad" id="crear_tipo_act">
                Registrar</button>
                
                </form>

                <button class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>

            </div>
        </div>
    </div>
</div> 
