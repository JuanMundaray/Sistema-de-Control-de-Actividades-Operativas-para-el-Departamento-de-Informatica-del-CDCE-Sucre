
<!--Tabla de Contenido sobre Actividades-->
<div class="container mt-5">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs pb-2" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="tabla1-tab" data-bs-toggle="tab" data-bs-target="#tabla_datos_actividad" type="button" role="tab" aria-controls="tabla1" aria-selected="true">Datos de Actividades</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tabla2-tab" data-bs-toggle="tab" data-bs-target="#tabla_datos_responsable" type="button" role="tab" aria-controls="tabla2" aria-selected="false">Datos del Responsable del Registro</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="tabla2-tab" data-bs-toggle="tab" data-bs-target="#tabla_datos_atendido" type="button" role="tab" aria-controls="tabla2" aria-selected="false">Datos del Funcionario Atendido</button>
        </li>
    </ul>
    
    <!--La tabla de Actividades Registradas-->
    <div class="tab-content">
        <div class="table-responsive tab-pane fade show active" id="tabla_datos_actividad" role="tabpanel">
            <table id="tabla_historial_actividades_1" class="table text-nowrap table_default">
                <thead>
                    <tr>
                    <th scope='col'><label>Fila</label></th>
                        <th scope='col'><label>Nombre</label></th>
                        <th scope='col'><label>Estado</label></th>
                        <th scope='col'><label>Tipo</label></th>
                        <th scope='col'><label>Fecha de Registro</label></th>
                        <th scope='col'><label>Hora de Registro</label></th>
                    </tr>
                </thead>

                <tbody>
                </tbody>

            </table>
        </div>
    </div>

    <div class="tab-content">
        <div class="table-responsive tab-pane fade" id="tabla_datos_responsable" role="tabpanel">
            <table id="tabla_historial_actividades_2" class="table text-nowrap table_default">
                <thead>
                    <tr>
                        <th scope='col'><label>Fila</label></th>
                        <th scope='col'><label>Nombre del Completo</label></th>
                        <th scope='col'><label>Cédula</label></th>
                        <th scope='col'><label>Departamento Receptor</label></th>
                    </tr>
                </thead>

                <tbody>
                </tbody>

            </table>
        </div>
    </div>

    <div class="tab-content">
        <div class="table-responsive tab-pane fade" id="tabla_datos_atendido" role="tabpanel">
            <table id="tabla_historial_actividades_3" class="table text-nowrap table_default">
                <thead>
                    <tr>
                    <th scope='col'><label>Fila</label></th>
                        <th scope='col'><label>Nombre Completo</label></th>
                        <th scope='col'><label>Cédula</label></th>
                        <th scope='col'><label>Departamento Emisor</label></th>
                    </tr>
                </thead>

                <tbody>
                </tbody>

            </table>
        </div>
    </div>

</div>