<div class="modal fade modal-lg" id="ModalCambiarClave" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-white" id="ModalLabelCambiarClave">Cambiar Contraseña</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">

                <section id="secciones" class="secciones">
                    <form id="form_cambiarClave" class="formulario needs-validation" method="post" action="../Controller/controllerUsuario.php" novalidate>
                        
                        <div class="row gy-4">

                            <div class="col-md-10">
                                <label class="col-md-12 form-label">Contraseña:</label>
                                <input type="text" class=" input_form col-md-12 form-control" name="password" id="password" placeholder="/1234" pattern=".{4,}" required />

                                <div class="invalid-feedback">
                                    *Una contraseña debe tener como mínimo 4 carácteres
                                </div>
                            </div>

                            <div class="col-md-10">
                                <label class="col-md-12 form-label">Confirmar Contraseña:</label>
                                <input type="text" class=" input_form col-md-12 form-control" name="password_confirm" id="password_confirm" placeholder="/1234" required/>

                                <div class="invalid-feedback">
                                    *Esta contraseña no coincide con la ingresada
                                </div>
                            </div>

                            <input type="hidden" value="" name="id_usuario" id="cambiar_clave_id_usuario" />
                            <input type="hidden" value="cambiar_clave" name="option" />

                            <div class="col-md-12 pt-4 row justify-content-center">
                                <input type="submit" class=" btn btn-primary col-md-3" value="Cambiar Contraseña" name="crear_usuario" id="create_user">
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