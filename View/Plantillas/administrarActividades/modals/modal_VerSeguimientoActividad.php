<!-- Modal -->
<div class="modal fade" id="ModalSeguimientoActividad" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgb(236,112,99);">
                <h1 class="modal-title fs-5 text-white" id="ModalLabelSeguimientoActividad">Seguimiento de Actividad</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="py-3">Tabla de Estados de Actividad</h5>
                <div class="table-responsive">
                    <table id="tabla_actividades_registro_modificacion" class="table py-3 text-nowrap text-center rounded">
                        <thead>
                            <tr>
                                <th scope='col'><label>Estado al Cual Fue Modificado</label></th>
                                <th scope='col'><label>Estado Actual de Actividad</label></th>
                                <th scope='col'><label>Fecha de Modificacion</label></th>
                                <th scope='col'><label>Hora de Modificacion</label></th>
                                <th scope='col'><label>Tipo de Actividad</label></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    <!--La tabla se rellena por medio de el archivo ajax.actividades-historial.js-->
                    </table>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>