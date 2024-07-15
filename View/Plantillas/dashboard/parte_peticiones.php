
<!--Parte de Peticiones -->
<h2 class="titleh2">Peticiones</h2>
<div class="row col">
    <!--Cuadro de numero Usuarios Registrados-->
        <button class="panel-pastel-purple col-md-10 bloque_dashboard" data-bs-toggle="modal" data-bs-target="#graficaPeticiones">
            <div class="cuadro_hijo01">
                <div>
                    <h2 id="num_peticiones">0</h2>
                    <p>Peticiones Registradas</p>
                </div>
                <div>
                    <img src="../View/Resources/png/512/bookmark.png">
                </div>
            </div>
        </button>

    <!--Cuadro de numero de Peticiones en Espera Registradas-->
    <button class="panel-pastel-yellow col-md-5 bloque_dashboard" data-bs-toggle="modal" data-bs-target="#graficaPeticiones">
        <div class="cuadro_hijo01"> 
            <div>
                <h2 id="num_peticiones_espera">0</h2>
                <p>Peticiones en Espera</p>
            </div>
            <div>
                <img src="../View/Resources/png/512/android-clock.png">
            </div>
        </div>
    </button>

    <!--Cuadro de numero Peticiones Aceptadas Registradas-->
    <button class="panel-pastel-green col-md-5 bloque_dashboard" data-bs-toggle="modal" data-bs-target="#graficaPeticiones">
            <div class="cuadro_hijo01">
                <div>
                    <h2 id="num_peticiones_aceptadas">0</h2>
                    <p>Peticiones Aceptadas</p>
                </div>
                <div>
                    <img src="../View/Resources/png/512/checkmark.png">
                </div>
            </div>
       </button>    
</div>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="graficaPeticiones" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgb(118,215,196);">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Gráfico de Peticiones</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    
    <div class="col-md-12 p-0 m-0">
        <div class="card bg-light_green">
            <div>
                <div class="card-body">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div>
                            </div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                        </div>
                    </div>
                    <canvas id="grafica_peticiones" style="min-height: 250px; height: 250px;    max-height: 350px; max-width: 100%; display: block; width: 320px;" width="318" height="250" class="chartjs-render-monitor">
                    </canvas>
                </div>
            </div>
        </div>
    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-danger" data-bs-dismiss="modal">Cerrar</button>
        <a  class="btn btn-primary" href="peticiones-registradas.php">Ver Lista</a>
      </div>
    </div>
  </div>
</div>


<!--     -->