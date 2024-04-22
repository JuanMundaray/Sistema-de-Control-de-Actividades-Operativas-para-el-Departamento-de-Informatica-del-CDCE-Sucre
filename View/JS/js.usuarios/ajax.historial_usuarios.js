$(document).ready(function(){
        
    $('#num_resultados').on('click',function(){
        getUsuarios();
    });

    $('#buscar_nombre_usuario').on('input',function(){
        getUsuarios();
    });
    getUsuarios();//Se Dibujan todas las actividades registradas en la tabla de actividades

});

function getUsuarios(pagina=1){

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

    let tabla=$("#tabla_historial_usuarios");
    tabla.empty();
    tabla.append(`<tbody><tr>
        <th><label>ID</label></th>
        <th><label>Nombre de Usuario</label></th>
        <th><label>Nombre y Apellido</label></th>
        <th><label>Cedula</label></th>
        <th><label>Departamento</label></th>
        <th><label>Tipo de Usuario</label></th>
        <th><label>Fecha de Creacion</label></th>
        <th><label>Estado del Usuario</label></th>
    </tr>`);
    msg.forEach(function(elemento){
        let estado_usuario;
        if(elemento['marca_existencia']){
            estado_usuario=`<button class='btn btn-success'>EXISTENTE</button>`;
        }
        if(elemento['marca_existencia']==false){
            estado_usuario=`<button class='btn btn-danger'>ELIMINADO</button>`;
        }
        tabla.append(`<tr>
        <td>${elemento['id_usuario']}</td>
        <td>${elemento['nombre_usuario']}</td>
        <td>${elemento['nombre_personal']} ${elemento['apellido_personal']}</td>
        <td>${elemento['cedula']}</td>
        <td>${elemento['nombre_departamento']}</td>
        <td>${elemento['tipo_usuario']}</td>
        <td>${elemento['fecha_creacion']}</td>
        <td>${estado_usuario}</td>
        </tr>`);
    });
    tabla.append("</tbody>");
}