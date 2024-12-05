$(document).ready(function(){
    
    getDepartamentos();

    $("#data_busq_nombre").on('input',function(){ //Funcion ajax para buscar una actividad por su nombre
        getDepartamentos();
    });

    $("#data_busq_id").on('input',function(){ //Funcion ajax para buscar una actividad por su nombre
        getDepartamentos();
    });

    $("#num_resultados").click(function(){
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
            let tabla=$("#tabla_departamentos tbody");

            tabla.empty();
            msg.forEach(function(elemento){
                tabla.append(`
                <tr>
                    <td>${elemento['id_departamento']}</td>
                    <td>${elemento['nombre_departamento']}</td>
                    <td>
                        <button class="btn btn-danger" onclick="eliminarDepartamento(${elemento['id_departamento']})">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                            </svg>
                        </button>
                    </td>
                </tr>`
            )
            });

            paginacion(num_resultados);
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("Sin Resultados");
            let tabla=$("#tabla_departamentos");
            tabla.html('');
        }
    });
}

function paginacion(num_resultados){//Esta funcion hace apararecerlos botones para paginar los registros obtenidos
    
    let nombre_departamento=$("#data_busq_nombre").val();
    let id_departamento=$("#data_busq_id").val();
    let num_filas;
    
    $.ajax({ 
        async:false,
        type:"POST",
        url:"../Controller/controllerActividad.php",
        data:{
            option:'contarRegistros',
            nombre_departamento:nombre_departamento,
            id_departamento:id_departamento
        },
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
            `<li class="page-item"><a class="page-link" href='#' onclick="getDepartamentos(${numero})"'>${numero}</a></li>`
        )
    }
}