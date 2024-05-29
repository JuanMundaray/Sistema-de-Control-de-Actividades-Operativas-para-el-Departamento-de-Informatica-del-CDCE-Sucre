
$(document).ready(function(){
    $('#buscar_nombre_usuario').click(function(){
        getUsuarios();
    });
    
    getUsuarios();//Se Dibujan todas las actividades registradas en la tabla de actividades

});

function getUsuarios(pagina=1){

    let num_resultados=$("#num_resultados").val();
    let nombre_usuario=$("#nombre_usuario").val();
    $.ajax({
        type:"POST",
        url:"../Controller/controllerUsuario.php",
        data:{
            option:'obtener',
            pagina:pagina,
            num_resultados:num_resultados,
            nombre_usuario:nombre_usuario
        },
        dataType:'json',
        success:function(msg){
            RellenarTablaUsuario(msg);
            paginacion(num_resultados,msg.length);
        }

    });
}

function RellenarTablaUsuario(msg){

    let cuerpo_tabla=$("#tabla_usuarios tbody");
    cuerpo_tabla.empty();
    
    msg.forEach(function(elemento){
        if(elemento['marca_existencia']==true){

            cuerpo_tabla.append(`<tr>
            <td>${elemento['id_usuario']}</td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-success dropdown-toggle rounded-pill" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                        Seleccione...
                    </button>

                    <ul class="dropdown-menu dropdown-menu-lg-end">
                        <li><button class="dropdown-item" onclick="eliminarUsuario(${elemento['id_usuario']})">Eliminar Usuario</button></li>
                        <li><a class="dropdown-item" href="usuario-editar.php?id_usuario=${elemento['id_usuario']}">Editar Usuario</a></li>
                    </ul>
                </div>
            </td>
            <td>${elemento['nombre_usuario']}</td>
            <td>${elemento['nombre_personal']} ${elemento['apellido_personal']}</td>
            <td>${elemento['cedula']}</td>
            <td>${elemento['nombre_departamento']}</td>
            <td>${elemento['tipo_usuario']}</td>
            <td>${elemento['fecha_creacion']}</td>
            </tr>`);

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
            nombre_usuario:nombre_usuario
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