<header class="header">
    <div>
        <div class="Imagenes-Cabecera">
            <img src="Resources/Imagenes/logo_me_zees_negro.png">
            <img class="img2" style="float:right;" src="Resources/Imagenes/logo-zamora-03.png">
        </div>

        <div class="raya"></div>

        <div class="Parte-Inferior-Cabecera">

            <div style="display: flex; margin-left: 20px;">
                <h3>CDCE-SUCRE</h3>
                <img id="boton_despliegue" src="Resources/png/512/navicon.png">
            </div>

            <div class="imagen_perfil">
                    <?php
                        if(isset($_SESSION["nombre_usuario"])){
                            echo '<img src="Resources/png/512/person.png">';
                            echo '<p style="margin:0; font-size: 10px; text-align: center;">'
                                .$_SESSION["nombre_usuario"].
                            '</p>';
                        }
                    ?>
            </div>
            
        </div>
    </div>
</header>