<header>
    <div class=".header">
        <div class="Imagenes-Cabecera">
            <img class="Mover-Izquierda logo-ZEED" src="Resources/Imagenes/logo_me_zees_negro.png">
            <img class="Mover-Derecha logo-zamora200" src="Resources/Imagenes/logo-zamora-03.png">
        </div>

        <div class="raya"></div>

        <div class="Parte-Inferior-Cabecera">

            <div style="display: flex; margin-left: 20px;">
                <h3>CDCE-SUCRE</h3>
                <img id="boton_despliegue" src="Resources/png/512/navicon.png" width="60px" height="60px">
            </div>

            <div class="Mover-Derecha">
                <img style="margin:0; padding:0;" src="Resources/png/512/person.png" 
                width=<?php if(isset($_SESSION["nombre_usuario"])){ echo "40px";}else{echo "50px";} ?> 
                height=<?php if(isset($_SESSION["nombre_usuario"])){ echo "40px";}else{echo "50px";} ?>>
                <p style="margin:0; font-size: 10px; text-align: center;">
                    <?php
                        if(isset($_SESSION["nombre_usuario"])){
                            echo $_SESSION["nombre_usuario"];
                        }
                    ?>
                </p>
            </div>
            
        </div>
    </div>
</header>