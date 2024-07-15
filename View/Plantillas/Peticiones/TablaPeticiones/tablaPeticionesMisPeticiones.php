
<!--Tabla de Contenido sobre Actividades-->
<div class="container mt-5">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs pb-2" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="tabla1-tab" data-bs-toggle="tab" data-bs-target="#tabla_datos_peticion" type="button" role="tab" aria-controls="tabla1" aria-selected="true">Datos de Petición</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tabla2-tab" data-bs-toggle="tab" data-bs-target="#tabla_datos_responsable" type="button" role="tab" aria-controls="tabla2" aria-selected="false">Datos del Responsable de la Petición</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tabla2-tab" data-bs-toggle="tab" data-bs-target="#otros_datos" type="button" role="tab" aria-controls="tabla2" aria-selected="false">Otros Detalles</button>
        </li>
    </ul>
    
    <!--La tabla de Actividades Registradas-->
    <div class="tab-content">
        <div class="table-responsive tab-pane fade show active" id="tabla_datos_peticion" role="tabpanel">
            <table id="tabla_1" class="table text-nowrap table_default">
                <thead>
                    <tr>
                    <th scope='col'><label>Fila</label></th>
                        <th scope='col'><label>Fecha de Registro</label></th>
                        <th scope='col'><label>Accion</label></th>
                        <th><label>Nombre</label></th>
                        <th><label>Estado</label></th>
                        <th scope='col'><label>Estado de Actividad Originada</label></th>
                    </tr>
                </thead>

                <tbody>
                </tbody>

            </table>
        </div>
    </div>

    <div class="tab-content">
        <div class="table-responsive tab-pane fade" id="tabla_datos_responsable" role="tabpanel">
            <table id="tabla_2" class="table text-nowrap table_default">
                <thead>
                    <tr>
                    <th scope='col'><label>Fila</label></th>
                        <th><label>Usuario que registro la peticion</label></th>
                        <th><label>Nombre Completo</label></th>
                        <th scope='col'><label>Cédula</label></th>
                    </tr>
                </thead>

                <tbody>
                </tbody>

            </table>
        </div>
    </div>

    <div class="tab-content">
        <div class="table-responsive tab-pane fade" id="otros_datos" role="tabpanel">
            <table id="tabla_3" class="table text-nowrap table_default">
                <thead>
                    <tr>
                    <th scope='col'><label>Fila</label></th>
                        <th><label>Departamento</label></th>
                        <th scope='col'><label>Tipo de Actividad</label></th>
                    </tr>
                </thead>

                <tbody>
                </tbody>

            </table>
        </div>
    </div>

</div>