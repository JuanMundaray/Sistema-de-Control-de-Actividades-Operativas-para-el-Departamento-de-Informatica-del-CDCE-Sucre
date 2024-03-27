$(document).ready(function(){

    getTipoActividad();
});

function getTipoActividad(pagina=1){

    let num_resultados=$("#num_resultados").val();

    $.ajax({
        type:"POST",
        url:"../Controller/controllerTipo_actividad.php",
        data:{option:"obtener",pagina:pagina,num_resultados:num_resultados},
        dataType:'json',
        success:function(msg){
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
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }
    });

    paginacion(num_resultados);
}

function paginacion(num_resultados){//Esta funcion hace apararecerlos botones para paginar los registros obtenidos

    let num_filas;
    $.ajax({
        async:false,
        type:"POST",
        url:"../Controller/controllerTipo_actividad.php",
        data:{option:'contarRegistros'},
        dataType:'json',
        success:function(msg){
            num_filas=msg;
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }

    });

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