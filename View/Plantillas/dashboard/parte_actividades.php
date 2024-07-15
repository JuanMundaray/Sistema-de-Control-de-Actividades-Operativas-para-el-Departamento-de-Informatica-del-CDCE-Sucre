
<h2 class="titleh2" id="tituloActividadesRegistradas">Actividades</h2>
<div class="row">
    <!--Cuadro que muestra el Actividades Registradas-->
    <button class="panel-pastel-blue col-md-10 bloque_dashboard" data-bs-toggle="modal" data-bs-target="#graficasActividad">
            <div class="cuadro_hijo01">

                <div>
                    <h2 id="num_actividades">0</h2>
                    <p>Actividades Registradas</p>
                </div>
                <div>
                    <img src="../View/Resources/png/512/clipboard.png">
                </div>
            </div>
    </button>

    
    <!--Cuadro que muestra el Actividades Iniciadas-->
     <button class="panel-paste-light_green col-md-5 bloque_dashboard" data-bs-toggle="modal" data-bs-target="#graficasActividad">
            <div class="cuadro_hijo01">
                <div>
                    <h2 id="num_actividades_iniciadas">0</h2>
                    <p>Actividades Iniciadas</p>
                </div>
                <div>
                    <img src="../View/Resources/png/512/compose.png">
                </div>
            </div>
       </button>
    <!--Cuadro que muestra el Actividades en Proceso-->
    <button class="panel-pastel-yellow col-md-5 bloque_dashboard" data-bs-toggle="modal" data-bs-target="#graficasActividad">
            <div class="cuadro_hijo01">
                <div>
                    <h2 id="num_actividades_proceso">0</h2>
                    <p>Actividades en Proceso</p>
                </div>
                <div>
                    <img src="../View/Resources/png/512/pie-graph.png">
                </div>
            </div>
    </button>
     
    <!--Cuadro que muestra el Actividades Suspendidas-->
    <button class="panel-pastel-red col-md-5 bloque_dashboard" data-bs-toggle="modal" data-bs-target="#graficasActividad">
            <div class="cuadro_hijo01">
                <div>
                    <h2 id="num_actividades_suspendidas">0</h2>
                    <p>Actividades Suspendidas</p>
                </div>
                <div>
                    <img src="../View/Resources/png/512/close.png">
                </div>
            </div>
        </button>
    <!-- Button modal -->
    <!--Cuadro de Actividades Completadas-->
        <button class="panel-pastel-green col-md-5 bloque_dashboard" data-bs-toggle="modal" data-bs-target="#graficasActividad">
            <div class="cuadro_hijo01 ">
                <div>
                    <h2 id="num_actividades_completadas">0</h2>
                    <p>Actividades Completadas</p>
                </div>
                <div>
                    <img src="../View/Resources/png/512/checkmark.png">
                </div>
            </div>
        </button>
</div>

<!-- Modal de graficas de actividadades-->

<!-- Modal -->
<div class="modal fade modal-xl" data-bs-backdrop="static" data-bs-keyboard="false" id="graficasActividad" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgb(133,193,233);">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Gráficas Actividades</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div  class="row">
            <div class="col-md-6 grid gap-3 p-3">
        <div class="card" style="background-color: rgb(93, 173, 226);">
            <div class="card-header">
                <h4 class="card-title">Índice de Estados de Actividad Por Mes</h4>
            </div>
            <div>
                <div class="card-body" style="display: block;">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                        </div>
                    </div>
                    <canvas id="graficoActividadesEstado" style="min-height: 250px; height: 250px;    max-height: 350px; max-width: 100%; display: block; width: 320px;" width="318" height="250" class="chartjs-render-monitor">
                    </canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 grid gap-3 p-3">
        <div class="card" style="background-color: rgb(93, 173, 226);">
            <div class="card-header">
                <h4 class="card-title">Actividades Por Estado</h4>
            </div>
            <div>
                <div class="card-body" style="display: block;">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                        </div>
                    </div>
                    <canvas id="graficoActividadesYear" style="min-height: 250px; height: 250px;    max-height: 350px; max-width: 100%; display: block; width: 320px;" width="318" height="250" class="chartjs-render-monitor">
                    </canvas>
                </div>
            </div>
        </div>
    </div>
</div>    
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Ver Más Gráficas</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade modal-xl" data-bs-backdrop="static" data-bs-keyboard="false" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgb(133,193,233);">
        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Gráficas Actividades</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
    <div class="col-md-6 grid gap-3 p-3">
        <div class="card" style="background-color: rgb(93, 173, 226);">
            <div class="card-header">
                <h4 class="card-title">Gráfica de Actividades</h4>
            </div>
            <div>
                <div class="card-body" style="display: block;">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                        </div>
                    </div>
                    <canvas id="graficaActividades" style="min-height: 250px; height: 250px;    max-height: 100%; max-width: 100%; display: block; width: 320px;" width="318" height="250" class="chartjs-render-monitor">
                    </canvas>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6 grid gap-3 p-3">
        <div class="card" style="background-color: rgb(93, 173, 226);">
            <div class="card-header">
                <h4 class="card-title">Índice de Registro de Actividades por Mes</h4>
            </div>
            <div>
                <div class="card-body" style="display: block;">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                        </div>
                    </div>
                    <canvas id="graficoBarras" style="min-height: 250px; height: 250px;    max-height: 700px; max-width: 800px; display: block; width: 320px;" width="318" height="250" class="chartjs-render-monitor">
                    </canvas>
                </div>
            </div>
        </div>
    </div>
</div>
      </div>
        <div class="modal-footer">
            <button class="btn btn-primary" data-bs-target="#graficasActividad" data-bs-toggle="modal">volver</button>
            <a  class="btn btn-secondary" href="actividades-registradas.php">Ver Lista</a>      
        </div>
    </div>
  </div>
</div>
