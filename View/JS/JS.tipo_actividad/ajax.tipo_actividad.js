$(document).ready(function(){

    getTipoActividad();

    $("#buscar_tipo_act").click(function(){ //Funcion ajax para buscar una actividad por su nombre
        let data_busq=$("#data_busq").val();
        buscar("nombre_tipo",data_busq,true);
    });

    $("#buscar_id").click(function(){ //Funcion ajax para buscar una actividad por su nombre
        let data_busq=$("#data_busq_id").val();
        buscar("id_tipo",data_busq,false);
    });
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

function paginacion(num_resultados,data_busq=false,columna=false,useLIKE=true){//Esta funcion hace apararecerlos botones para paginar los registros obtenidos

    let num_filas;

    if(data_busq!=false){
        data_ajax={option:'contarRegistros',data_busq:data_busq,columna:columna,useLIKE:useLIKE};
    }
    else{
        data_ajax={option:'contarRegistros'};
    }
    $.ajax({
        async:false,
        type:"POST",
        url:"../Controller/controllerTipo_actividad.php",
        data:data_ajax,
        dataType:'json',
        success:function(msg){
            num_filas=msg;
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("Sin Resultados");
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

function buscar(columna,data_busq,useLIKE=true,pagina=1){

    let num_resultados=$("#num_resultados").val();

    $.ajax({
        type:"POST",
        url:"../Controller/controllerTipo_actividad.php",
        data:{option:"buscar",data_busq:data_busq,columna:columna,
        num_resultados:num_resultados,pagina:pagina,
        useLIKE:useLIKE},
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

            paginacion(num_resultados,data_busq,columna,useLIKE);
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("Sin Resultados");
        }

    });

}