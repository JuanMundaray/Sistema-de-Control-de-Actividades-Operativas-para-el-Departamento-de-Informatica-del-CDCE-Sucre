<header class="container-fluid p-0 m-0 sticky-top w-100">
    <div>

        <div>
            <div class="Imagenes-Cabecera">
                <img src="./Resources/Imagenes/logo_ministerio.png<?php echo "?v=".rand(1000,9999)?>">
                <img class="px-1" src="./Resources/Imagenes/CDCE-logo-ministerio-de-educacion.png<?php echo "?v=".rand(1000,9999)?>">
                <img class="img2" style="float:right;" src="Resources/Imagenes/logo-zamora-03.png<?php echo "?v=".rand(1000,9999)?>">
            </div>

            <div class="raya"></div>

            <div class="bg-Header d-flex w-100 p-1 justify-content-start align-items-center">

                <div class="flex-grow-1 d-flex align-items-center">
                    <div class="me-3">
                        <?php
                            if(isset($_SESSION["nombre_usuario"])){
                                echo '
                                <svg xmlns="http://www.w3.org/2000/svg" id="boton_despliegue" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
                                </svg>';
                            } 
                        ?>
                    </div>

                    <h3 class="text-white align-self-end fw-semibold">CDCE-SUCRE</h3>
                </div>

                    <?php
                        if(isset($_SESSION["nombre_usuario"])){
                        echo '<div class="imagen_perfil align-items-center me-3 mb-3 text-white fw-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person text-center" viewBox="0 0 16 16">
                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                            </svg>
                            <p class="text-nowrap text-center" style="font-size: 10px;">
                                '.$_SESSION["nombre_usuario"].'
                            </p>
                        </div>';
                        }
                    ?>
                
            </div>
        </div>

    </div>
</header>