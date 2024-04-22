$(document).ready(function(){

    getDepartamentos();

    $("#buscar_nombre_boton").click(function(){ //Funcion ajax para buscar una actividad por su nombre
        getDepartamentos();
    });

    $("#buscar_id").click(function(){ //Funcion ajax para buscar una actividad por su nombre
        getDepartamentos();
    });
});

function getDepartamentos(pagina=1){

    let num_resultados=$("#num_resultados").val();
    let nombre_departamento=$("#data_busq_nombre").val();
    let id_departamento=$("#data_busq_id").val();
    let num_filas;

    $.ajax({
        type:"POST",
        url:"../Controller/controllerDepartamentos.php",
        data:{
            option:"obtener",
            num_resultados:num_resultados,
            pagina:pagina,
            nombre_departamento:nombre_departamento,
            id_departamento:id_departamento
        },
        dataType:'json',
        success:function(msg){

            if(msg==''){
                alert('Sin Resultados')
            };

            num_filas=msg.length;
            let tabla=$("#tabla_departamentos");

            tabla.empty();
            tabla.append(`<tbody><tr>
                <th><label>ID</label></th>
                <th><label>Nombre de Departamento</label></th>
            </tr>`);
            msg.forEach(function(elemento){
                tabla.append(`<tr>
                <td>${elemento['id_departamento']}</td>
                <td>${elemento['nombre_departamento']}</td></tr>`)
            });
            tabla.append("</tbody>");

            paginacion(num_resultados,num_filas);
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("Sin Resultados");
            let tabla=$("#tabla_departamentos");
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
            `<li class="page-item"><a class="page-link" href='#' onclick="getDepartamentos(${numero})"'>${numero}</a></li>`
        )
    }
}