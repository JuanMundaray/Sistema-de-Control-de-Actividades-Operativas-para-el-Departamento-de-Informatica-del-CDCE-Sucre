<div class="modal fade modal-lg" id="ModalEditarUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-white" id="ModalLabelEditarUsuario">Editar Usuario</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">

                <section id="secciones" class="secciones">

                    <form id="form_editar_usuario" class="formulario needs-validation" method="post" action="../Controller/controllerUsuario.php" novalidate>
                        <div class="row gy-4">
                            <input type="hidden" value="" name="id_usuario" id="id_usuario">

                            <div class="col-md-10 div_input_form">
                                <label class="col-md-12  form-label">Nombre de Usuario:</label>
                                <input type="text"class="input_form is-disabled col-md-12 form-control" name="nombre_usuario" id="editar_input_nombre_usuario" value="" placeholder="Nombre de Usuario">

                                <div class="invalid-feedback">
                                    *Este Campo no Puede Estar Vacío
                                </div>
                            </div>

                            <div class="col-md-10 div_input_form">
                                <label class="col-md-12 form-label">Nombre:</label>
                                <input type="text"class=" input_form col-md-12 form-control" name="nombre_personal" id="nombre_personal" placeholder="Nombre" required>

                                <div class="invalid-feedback">
                                    *Este Campo no Puede Estar Vacío
                                </div>
                            </div>

                            <div class="col-md-10 div_input_form">
                                <label class="col-md-12 form-label">Apellido:</label>
                                <input type="text"class=" input_form col-md-12 form-control" name="apellido_personal" id="apellido_personal" placeholder="Apellido" required>

                                <div class="invalid-feedback">
                                    *Este Campo no Puede Estar Vacío
                                </div>
                            </div>

                            <div class="col-md-10 div_input_form">
                                <label class=" form-label">Cedula de Identidad:</label>
                                <input type="text"class=" is-disabled input_form col-md-12 form-control" name="cedula" id="cedula" placeholder="Cédula de Identidad" maxlength="10" minlength="9" required>

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

                            <div class="col-md-12 div_input_form">
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

                            <input type="hidden" value="modificar" name="option" id="option">

                            <div class="col-md-12 form_button pt-5  justify-content-center row">
                                <input type="submit" class=" btn btn-primary col-md-3" value="Editar usuario" name="crear_usuario" id="create_user">
                            </div>
                            
                        </div>
                    </form>
                </section>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-danger" data-bs-dismiss="modal" id="cancelarUsuario">Cancelar</button>
            </div>
        </div>
    </div>
</div>