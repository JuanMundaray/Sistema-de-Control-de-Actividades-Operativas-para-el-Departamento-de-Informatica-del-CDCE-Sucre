import "./Modals/EditarUsuario.js"
import "./Modals/EliminarUsuario.js"
import "./Modals/CambiarClave.js"

$(document).ready(function(){

    $('#nombre_usuario').on('input',function(){
        getUsuarios();
    });
    
    getUsuarios();//Se Dibujan todas las actividades registradas en la tabla de actividades

});

window.getUsuarios=function(pagina=1){

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

    let cuerpo_tabla_1=$("#tabla_usuario_1 tbody");
    cuerpo_tabla_1.empty();
    let cuerpo_tabla_2=$("#tabla_usuario_2 tbody");
    cuerpo_tabla_2.empty();
    
    msg.forEach(function(elemento){
        if(elemento['marca_existencia']==true){

            cuerpo_tabla_1.append(`<tr>
            <td>${elemento['id_usuario']}</td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-success dropdown-toggle rounded-pill" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                        Seleccione...
                    </button>

                    <ul class="dropdown-menu dropdown-menu-lg-end">
                        <li><button class="dropdown-item" onclick="eliminarUsuario('${elemento['id_usuario']}')">Eliminar</button></li>
                        <li><button class="dropdown-item" onclick="editarUsuario('${elemento['id_usuario']}')">Modificar</button></li>
                        <li><button class="dropdown-item" onclick="cambiarClave('${elemento['id_usuario']}')">Cambiar Contraseña</button></li>
                    </ul>
                </div>
            </td>
            <td>${elemento['nombre_usuario']}</td>
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