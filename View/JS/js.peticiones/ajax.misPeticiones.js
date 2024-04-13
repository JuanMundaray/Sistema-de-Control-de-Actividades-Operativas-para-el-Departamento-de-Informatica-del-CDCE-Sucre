$(document).ready(function(){
    getPeticiones();
    
    $("#data_busq_nombre").on('input',function(){ //Funcion ajax para buscar una actividad por su nombre o codigo
        getPeticiones();
    });
    $('#boton_buscar').click(function(){
        getPeticiones();
    });$("#data_busq_fecha").on('input',function(){ //Funcion ajax para buscar una actividad por su nombre o codigo
        getPeticiones();
    });

});

function getPeticiones(pagina=1){
    let num_resultados=$("#num_resultados").val();
    let nombre_peticion=$("#data_busq_nombre").val();
    let fecha_peticion=$("#data_busq_fecha").val();
    let estado_peticion=$("#data_busq_estado").val();
    let id_usuario=$("#id_usuario_sesion").val();
    $.ajax({
        type:"POST",
        url:"../Controller/controllerPeticion.php",
        data:{
            option:'obtener',
            pagina:pagina,
            num_resultados:num_resultados,
            nombre_peticion:nombre_peticion,
            fecha_peticion:fecha_peticion,
            estado_peticion:estado_peticion,
            id_usuario:id_usuario
        },
        dataType:'json',
        success:function(msg){
            console.log(msg);
            RellenarTablaPeticiones(msg);
            paginacion(num_resultados,msg.length);

        },error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }

    });
}

function RellenarTablaPeticiones(msg){
    let tabla=$("#tabla_peticiones");
    let tipo_usuario=$('#tipo_usuario').val();
    
    function estilo_btn(elemento){
        if(elemento=="ESPERA"){
            var btn_estilo="btn-warning";
        }if(elemento=="RECHAZADA"){
            var btn_estilo="btn-danger";
        }if(elemento=="ACEPTADA"){
            var btn_estilo="btn-success";
        }
        if(elemento=="SUSPENDIDA"){
            var btn_estilo="btn-danger";
        }
        return btn_estilo;
    }

    tabla.empty();
    tabla.append(`<tbody><tr>
        <th><label>Nombre de Peticion</label></th>
        <th><label>Usuario que registro la peticion</label></th>
        <th><label>Departamento de la Peticion</label></th>
        <th><label>Fecha de la Peticion</label></th>
        <th><label>Tipo de Actividad de la Peticion</label></th>
        <th><label>Estado de la Peticion</label></th>
        <th colspan="1"><label>Accion</label></th>
    </tr>`);
    msg.forEach(function(elemento){
        //Dibujar la Tabla de Peticiones por medio del DOM de JavaScripts
            tabla.append(`<tr>
            <td>${elemento['nombre_peticion']}</td>
            <td>${elemento['nombre_usuario']}</td>
            <td>${elemento['nombre_departamento']}</td>
            <td>${elemento['fecha_peticion']}</td>
            <td>${elemento['nombre_tipo']}</td>
            <td>
                <button class='tamano_boton btn ${estilo_btn(elemento['estado_peticion'])}'>${elemento['estado_peticion']}</button>
                </td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                        Seleccione...
                    </button>

                    <ul class="dropdown-menu dropdown-menu-lg-end">
                        <button class="dropdown-item" onclick="eliminarPeticion(${elemento['id_peticion']})">Cancelar</button>   
                    </ul>
                </div>
            </td>
            </tr>`);
    });
    tabla.append("</tbody>");
}

function paginacion(num_resultados,num_filas){//Esta funcion hace apararecerlos botones para paginar los registros obtenidos

    let num_paginas=Math.ceil((num_filas)/(num_resultados));
    $("#num_paginas").empty();

    for(let i=1;i<=num_paginas;i++){
        setNumeroPaginas(i);
    }

    function setNumeroPaginas(numero){
        $("#num_paginas").append(
            `<li class="page-item"><a class="page-link" href='#tabla_peticiones' onclick="getPeticiones(${numero})"'>${numero}</a></li>`
        )
    }
}