$(document).ready(function(){
    $("#buscar_peticion").click(function(){ //Funcion ajax para buscar una actividad por su nombre o codigo
        let data=$("#data_busq_peticion").val();
        buscarPeticiones(data,"nombre_peticion");

    });
});

function buscarPeticiones(data_busq,parametro_busq,pagina=1){

    let num_resultados=$("#num_resultados").val();
    $.ajax({
        type:"POST",
        url:"../Controller/controllerPeticion.php",
        data:{option:"buscar",data_busq:data_busq,parametro_busq:parametro_busq,num_resultados:num_resultados,pagina:pagina},
        dataType:'json',
        success:function(msg){

            RellenarTablaPeticiones(msg);
            paginacionBusqueda(num_resultados,data_busq,parametro_busq);

        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("Sin Resultados");
        }

    });
}

function paginacionBusqueda(num_resultados,data_busq,parametro_busq){//Esta funcion hace apararecerlos botones para paginar los registros obtenidos en una busqueda con condicion

    let num_filas;
    $.ajax({
        async:false,
        type:"POST",
        url:"../Controller/controllerPeticion.php",
        data:{option:'contarRegistros',data_busq:data_busq,parametro_busq:parametro_busq},
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
            `<li class="page-item"><a class="page-link" href='#' onclick="buscarPeticiones('${data_busq}','${parametro_busq}',${numero})"'>${numero}</a></li>`
        )
    }
}