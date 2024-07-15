<!-- Modal para registrar Departamento -->
<div class="modal fade" id="modal-departamento" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-white" style="background-color: rgb(0, 180, 10);"">
                <h4 class="modal-tittle fw-semibold">Agregar Departamento</h4>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation container-fluid" method="post" id="form-departamento" novalidate>
                    <div>
                            <label class="form-label">Nombre de Departamento a Registrar:</label>
                            <input class="form-control" type="text" name="nombre_departamento" id="nombre_departamento" required pattern="[a-zA-Z0-9 ]{4,}" maxlength="50">
                            <div class="invalid-feedback">
                                *Este Campo Debe Tener Como Mínimo 4 Caracteres
                            </div>
                    </div>
            </div>
            <div class="modal-footer">
                <input class="col-md-6" type="hidden" value="crear" name="option" id="option">
                <button type="submit" class="btn btn-primary col-md-3" value="Agregar Departamento" id="boton_agregar_departamento"> Agregar</button>
                </form> 
                <button class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>