
<!--Parte de Usuarios -->
<h2 class="titleh2">Usuarios</h2>
<div class="row col">
    <!--Cuadro de numero Usuarios Registrados-->
    <button class="CuadroUsuariosRegistrados col-md-10 bloque_dashboard" data-bs-toggle="modal" data-bs-target="#graficaUsuario">
            <div class="cuadro_hijo01">
                <div>
                    <h2 id="num_usuarios">0</h2>
                    <p>Usuarios Registrados</p>
                </div>
                <div>
                    <img src="../View/Resources/png/512/android-friends.png">
                </div>
            </div>
        </button>
    <!--Cuadro de numero Usuarios Administradores Registrados-->
    <button class="CuadroUsuariosAdministradores col-md-3 bloque_dashboard" data-bs-toggle="modal" data-bs-target="#graficaUsuario">
            <div class="cuadro_hijo01">
                <div>
                    <h2 id="num_usuarios_administradores">0</h2>
                    <p>Usuarios Administradores Registrados</p>
                </div>
                <div>
                    <img src="../View/Resources/png/512/android-add-contact.png">
                </div>
            </div>
        </button>

        <!--Cuadro de numero Usuarios Tecnicos Registrados-->
        <button class="CuadroUsuariosTecnicos col-md-3 bloque_dashboard" data-bs-toggle="modal" data-bs-target="#graficaUsuario">
    
            <div class="cuadro_hijo01">
                <div>
                    <h2 id="num_usuarios_tecnicos">0</h2>
                    <p>Usuarios Técnicos Registrados</p>
                </div>
                <div>
                    <img src="../View/Resources/png/512/android-contacts.png">
                </div>
            </div>
       </button>
    
    <!--Cuadro de numero Usuarios Solicitantes Registrados-->
        <button class="CuadroUsuariosSolicitantes col-md-3 bloque_dashboard" data-bs-toggle="modal" data-bs-target="#graficaUsuario">
            <div class="cuadro_hijo01">
                <div>
                    <h2 id="num_usuarios_solicitantes">0</h2>
                    <p>Usuarios Solicitante Registrados</p>
                </div>
                <div>
                    <img src="../View/Resources/png/512/android-contact.png">
                </div>
            </div>
        </button>      
</div>

<!-- Modal -->
<div class="modal fade" id="graficaUsuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background-color: rgb(195,155,211);">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Gráfica de Usuarios:</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <div class="col-md-12 p-0 m-0">
        <div class="card">
            <div>
                <div class="card-body">
                    <div class="chartjs-size-monitor">
                        <div class="chartjs-size-monitor-expand">
                            <div class="">
                            </div>
                        </div>
                        <div class="chartjs-size-monitor-shrink">
                        </div>
                    </div>
                    <canvas id="graficaUsuarios" style="min-height: 250px; height: 250px;    max-height: 350px; max-width: 100%; display: block; width: 320px;" width="318" height="250" class="chartjs-render-monitor">
                    </canvas>
                </div>
            </div>
        </div>
    </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-danger" data-bs-dismiss="modal">Cerrar</button>
        <a  class="btn btn-primary" href="usuarios-administrar.php">Ver Lista</a>
      </div>
    </div>
  </div>
</div>
