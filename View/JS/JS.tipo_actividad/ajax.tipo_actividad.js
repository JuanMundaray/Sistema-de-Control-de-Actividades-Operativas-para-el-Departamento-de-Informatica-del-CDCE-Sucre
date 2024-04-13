$(document).ready(function(){

    getTipoActividad();

    $("#buscar_nombre_boton").click(function(){ //Funcion ajax para buscar una actividad por su nombre
        getTipoActividad();
    });

    $("#buscar_id").click(function(){ //Funcion ajax para buscar una actividad por su nombre
        getTipoActividad();
    });
});

function getTipoActividad(pagina=1){

    let num_resultados=$("#num_resultados").val();
    let nombre_tipo=$("#data_busq_nombre").val();
    let id_tipo=$("#data_busq_id").val();
    let num_filas;

    $.ajax({
        type:"POST",
        url:"../Controller/controllerTipo_actividad.php",
        data:{
            option:"obtener",
            num_resultados:num_resultados,
            pagina:pagina,
            nombre_tipo:nombre_tipo,
            id_tipo:id_tipo
        },
        dataType:'json',
        success:function(msg){
            if(msg==''){alert('Sin Resultados')};
            num_filas=msg.length;
            let tabla=$("#tabla_tipo_actividad");
            tabla.empty();
            tabla.append(`<tbody><tr>
                <th><label>ID</label></th>
                <th><label>Tipo de Actividad</label></th>
            </tr>`);
            msg.forEach(function(elemento){
                tabla.append(`<tr>
                <td>${elemento['id_tipo']}</td>
                <td>${elemento['nombre_tipo']}</td></tr>`)
            });
            tabla.append("</tbody>");

            paginacion(num_resultados,num_filas);
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("Sin Resultados");
            let tabla=$("#tabla_tipo_actividad");
            tabla.html('');
        }
    });
}

function paginacion(num_resultados,num_filas){//Esta funcion hace apararecerlos botones para paginar los registros obtenidos

    let num_paginas=Math.ceil((num_filas)/(num_resultados));
    $("#num_paginas").empty();
    for(let i=1;i<=num_paginas;i++){
        setNumeroPaginas(i);
    }
    
    function setNumeroPaginas(numero){
        $("#num_paginas").append(
            `<li class="page-item"><a class="page-link" href='#' onclick="getTipoActividad(${numero})"'>${numero}</a></li>`
        )
    }
}