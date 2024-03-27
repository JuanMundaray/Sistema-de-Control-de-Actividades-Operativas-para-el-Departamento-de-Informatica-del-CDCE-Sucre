$(document).ready(function(){
        
    getActividades();//Se Dibujan todas las actividades registradas en la tabla de actividades

});

function getActividades(pagina=1){

    let num_resultados=$("#num_resultados").val();

    $.ajax({
        type:"POST",
        url:"../Controller/controllerActividad.php",
        data:{option:'obtener',pagina:pagina,num_resultados:num_resultados},
        dataType:'json',
        success:function(msg){
            RellenarTablaActividades(msg);
            paginacion(num_resultados);
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }

    });
}

function paginacion(num_resultados){//Esta funcion hace apararecerlos botones para paginar los registros obtenidos

    let num_filas;
    $.ajax({
        async:false,
        type:"POST",
        url:"../Controller/controllerActividad.php",
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
            `<li class="page-item"><a class="page-link" href='#' onclick="getActividades(${numero})"'>${numero}</a></li>`
        )
    }
}