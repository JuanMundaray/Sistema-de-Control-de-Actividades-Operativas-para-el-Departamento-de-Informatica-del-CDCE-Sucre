$(document).ready(function(){
        
    $('#buscar_nombre_usuario').on('input',function(){
        //Funcion ajax para buscar un usuario por su nombre
        let data=$("#buscar_nombre_usuario").val();
        buscarUsuarioHistorial(data,"nombre_usuario",true);
    });
    getHistorialUsuarios();//Se Dibujan todas las actividades registradas en la tabla de actividades

});

function getHistorialUsuarios(pagina=1){

    let num_resultados=$('#num_resultados').val();

    $.ajax({
        type:"POST",
        url:"../Controller/controllerUsuario.php",
        data:{option:'obtener',pagina:pagina,num_resultados:num_resultados},
        dataType:'json',
        success:function(msg){
            RellenarTablaHistorialUsuarios(msg);
            paginacion(num_resultados);
        },
        error:function(jqXHR,textStatus,errorThrown){
        }

    });
}

function paginacion(num_resultados){//Esta funcion hace apararecerlos botones para paginar los registros obtenidos

    let num_filas;
    $.ajax({
        async:false,
        type:"POST",
        url:"../Controller/controllerUsuario.php",
        data:{option:'contarRegistrosHistorial'},
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
            `<li class="page-item"><a class="page-link" href='#tabla_historial_usuarios' onclick="getHistorialUsuarios(${numero})"'>${numero}</a></li>`
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
    </tr>`);
    msg.forEach(function(elemento){
        
        tabla.append(`<tr>
        <td>${elemento['id_usuario']}</td>
        <td>${elemento['nombre_usuario']}</td>
        <td>${elemento['nombre_personal']} ${elemento['apellido_personal']}</td>
        <td>${elemento['cedula']}</td>
        <td>${elemento['nombre_departamento']}</td>
        <td>${elemento['tipo_usuario']}</td>
        <td>${elemento['fecha_creacion']}</td>
        </tr>`);
    });
    tabla.append("</tbody>");
}

function buscarUsuarioHistorial(data_busq,columna,useLIKE=true,pagina=1){

    let num_resultados=$("#num_resultados").val();
    
    $.ajax({
        type:"POST",
        url:"../Controller/controllerUsuario.php",
        data:{option:"buscar",data_busq:data_busq,columna:columna,
        num_resultados:num_resultados,
        pagina:pagina,useLIKE:useLIKE},
        dataType:'json',
        success:function(msg){
            RellenarTablaHistorialUsuarios(msg);
            paginacion(num_resultados,data_busq,columna,useLIKE);

        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("Sin Resultados");
        }

    });
}