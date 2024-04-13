
$(document).ready(function(){
    $('#buscar_nombre_usuario').click(function(){
        //Funcion ajax para buscar una actividad por su nombre
        let data=$("#nombre_usuario").val();
        buscarUsuario(data,"nombre_usuario",true);
    });
    getUsuarios();//Se Dibujan todas las actividades registradas en la tabla de actividades

});

function getUsuarios(pagina=1){

    let num_resultados=$("#num_resultados").val();

    $.ajax({
        type:"POST",
        url:"../Controller/controllerUsuario.php",
        data:{option:'obtener',pagina:pagina,num_resultados:num_resultados},
        dataType:'json',
        success:function(msg){
            RellenarTablaUsuario(msg);
            paginacion(num_resultados);
        }

    });
}

function buscarUsuario(data_busq,columna,useLIKE=true,pagina=1){

    let num_resultados=$("#num_resultados").val();
    
    $.ajax({
        type:"POST",
        url:"../Controller/controllerUsuario.php",
        data:{option:"buscar",data_busq:data_busq,columna:columna,
        num_resultados:num_resultados,
        pagina:pagina,useLIKE:useLIKE},
        dataType:'json',
        success:function(msg){
            RellenarTablaUsuario(msg);
            paginacion(num_resultados,data_busq,columna,useLIKE);

        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("Sin Resultados");
        }

    });
}




function paginacion(num_resultados,data_busq=false,columna=false,useLIKE=true){
    //Esta funcion hace apararecerlos botones para paginar los registros obtenidos

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
        url:"../Controller/controllerUsuario.php",
        data:data_ajax,
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

    if(data_busq!=false){
        for(let i=1;i<=num_paginas;i++){
            setNumeroPaginas(i,data_busq,columna,useLIKE);
        }
    }
    else{
        for(let i=1;i<=num_paginas;i++){
            setNumeroPaginas(i);
        }
    }
    
    function setNumeroPaginas(numero,data_busq=false,columna=false,useLIKE=true){

        if(data_busq!=false){
            $("#num_paginas").append(
                `<li class="page-item">
                    <a class="page-link" href='#' 
                    onclick="buscarUsuario('${data_busq}','${columna}',${useLIKE},${numero})"'>
                        ${numero}
                    </a>
                </li>`
            )
        }
        else{
            $("#num_paginas").append(
                `<li class="page-item"><a class="page-link" href='#' onclick="getUsuarios(${numero})"'>${numero}</a></li>`
            )
        }
    }
}

function RellenarTablaUsuario(msg){

    let tabla=$("#tabla_usuarios");
    tabla.empty();
    tabla.append(`<tbody><tr>
        <th><label>ID</label></th>
        <th><label>Nombre de Usuario</label></th>
        <th><label>Nombre y Apellido</label></th>
        <th><label>Cedula</label></th>
        <th><label>Departamento</label></th>
        <th><label>Tipo de Usuario</label></th>
        <th><label>Fecha de Creacion</label></th>
        <th><label>Accion</label></th>
    </tr>`);
    msg.forEach(function(elemento){
        if(elemento['marca_existencia']==true){

            tabla.append(`<tr>
            <td>${elemento['id_usuario']}</td>
            <td>${elemento['nombre_usuario']}</td>
            <td>${elemento['nombre_personal']} ${elemento['apellido_personal']}</td>
            <td>${elemento['cedula']}</td>
            <td>${elemento['nombre_departamento']}</td>
            <td>${elemento['tipo_usuario']}</td>
            <td>${elemento['fecha_creacion']}</td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                        Seleccione...
                    </button>

                    <ul class="dropdown-menu dropdown-menu-lg-end">
                        <li><button class="dropdown-item" onclick="eliminarUsuario(${elemento['id_usuario']})">Eliminar Usuario</button></li>
                        <li><a class="dropdown-item" href="editar-usuario.php?id_usuario=${elemento['id_usuario']}">Editar Usuario</a></li>
                    </ul>
                </div>
            </td>
            </tr>`);

        }
    });
    tabla.append("</tbody>");
}

function eliminarUsuario(id_usuario){
    let ok=confirm("¿Seguro que desea eliminar a este Usuario?");
    if(ok){
        $.ajax({
            type:"POST",
            url:"../Controller/controllerusuario.php",
            data:"option=eliminar&id_usuario="+id_usuario,
            dataType:'json',
            success:function(msg){
                if(msg==1){
                    alert("Usuario Eliminada Exitosamente");
                    location.reload();
                }
                if(msg==0){
                    alert("No Se Puede Eliminar Una Sesion Activa");
                }
            }
    });
    }
}