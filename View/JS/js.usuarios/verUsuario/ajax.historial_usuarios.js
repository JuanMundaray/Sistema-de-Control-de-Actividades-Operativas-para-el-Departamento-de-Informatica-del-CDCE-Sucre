$(document).ready(function(){
        
    $('#num_resultados').on('click',function(){
        getUsuarios();
    });

    $('#buscar_nombre_usuario').on('input',function(){
        getUsuarios();
    });
    getUsuarios();//Se Dibujan todas las actividades registradas en la tabla de actividades

});

window.getUsuarios=function(pagina=1){

    let num_resultados=$("#num_resultados").val();
    let nombre_usuario=$("#buscar_nombre_usuario").val();
    $.ajax({
        type:"POST",
        url:"../Controller/controllerUsuario.php",
        data:{
            option:'obtener',
            pagina:pagina,
            num_resultados:num_resultados,
            nombre_usuario:nombre_usuario,
            extraer_todos:true,
        },
        dataType:'json',
        success:function(msg){
            RellenarTablaHistorialUsuarios(msg);
            paginacion(num_resultados,msg.length);
        }

    });
}
function paginacion(num_resultados){//Esta funcion hace apararecerlos botones para paginar los registros obtenidos

    let nombre_usuario=$("#nombre_usuario").val();
    let num_filas;
    
    $.ajax({ 
        async:false,
        type:"POST",
        url:"../Controller/controllerUsuario.php",
        data:{
            option:'contarRegistros',
            nombre_usuario:nombre_usuario,
            extraer_todos:true
        },
        dataType:'json',
        success:function(msg){
            num_filas=msg
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
            `<li class="page-item"><a class="page-link" href='#tabla_actividades' onclick="getUsuarios(${numero})"'>${numero}</a></li>`
        )
    }
}


function RellenarTablaHistorialUsuarios(msg){
    let cuerpo_tabla_1=$("#tabla_usuario_1 tbody");
    cuerpo_tabla_1.empty();
    let cuerpo_tabla_2=$("#tabla_usuario_2 tbody");
    cuerpo_tabla_2.empty();
    
    msg.forEach(function(elemento){

        let estado_usuario;
        if(elemento['marca_existencia']){
            estado_usuario=`<h5><span class="badge rounded-pill bg-primary" style="width: 120px;">Existente</span><h5>`;
        }
        if(elemento['marca_existencia']==false){
            estado_usuario=`<h5><span class="badge rounded-pill bg-danger" style="width: 120px;">Eliminado</span><h5>`;
        }

        cuerpo_tabla_1.append(`<tr>
        <td>${elemento['id_usuario']}</td>
        <td>${elemento['nombre_usuario']}</td>
        <td>${estado_usuario}</td>
        <td>${elemento['nombre_departamento']}</td>
        <td>${elemento['tipo_usuario']}</td>
        <td>${elemento['fecha_creacion']}</td>
        </tr>`);

        cuerpo_tabla_2.append(`
            <tr>
                <td>${elemento['id_usuario']}</td>
                <td>${elemento['nombre_personal']} ${elemento['apellido_personal']}</td>
                <td>${elemento['cedula']}</td>
            </tr>
        `);
    });
}