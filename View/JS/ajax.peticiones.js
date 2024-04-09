$(document).ready(function(){
    getPeticiones();
})

function getPeticiones(pagina=1){
    let num_resultados=$("#num_resultados").val();
    $.ajax({
        type:"POST",
        url:"../Controller/controllerPeticion.php",
        data:{option:'obtener',pagina:pagina,num_resultados:num_resultados},
        dataType:'json',
        success:function(msg){
            
            RellenarTablaPeticiones(msg);
            paginacion(num_resultados);

        },error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }

    });
}

function eliminarPeticion(id_peticion){
    let ok=confirm("¿Seguro que desea eliminar esta peticion?");
    if(ok){
        $.ajax({
            type:"POST",
            url:"../Controller/controllerPeticion.php",
            data:{option:"eliminar",id_peticion:id_peticion},
            dataType:'json',
            success:function(){
                alert("Peticion Eliminada");
            },error:function(jqXHR,textStatus,errorThrown){
                alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
            }
    });
    location.reload();
    }
}

function paginacion(num_resultados){//Esta funcion hace apararecerlos botones para paginar los registros obtenidos

    let num_filas;
    $.ajax({
        async:false,
        type:"POST",
        url:"../Controller/controllerPeticion.php",
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
            `<li class="page-item"><a class="page-link" href='#' onclick="getPeticiones(${numero})"'>${numero}</a></li>`
        )
    }
}

function RellenarTablaPeticiones(msg){
    let tabla=$("#tabla_peticiones");
    let tipo_usuario=$('#tipo_usuario').val();
            
            
    if(tipo_usuario!="invitado"){
        tabla.empty();
        tabla.append(`<tbody><tr>
            <th><label>Nombre de Peticion</label></th>
            <th><label>Usuario que registro la peticion</label></th>
            <th><label>Departamento de la Peticion</label></th>
            <th><label>Fecha de la Peticion</label></th>
            <th colspan="1"><label>Accion</label></th>
        </tr>`);
        msg.forEach(function(elemento){
            //Dibujar la Tabla de Peticiones por medio del DOM de JavaScripts 
            
            tabla.append(`<tr>
            <td>${elemento['nombre_peticion']}</td>
            <td>${elemento['nombre_usuario']}</td>
            <td>${elemento['nombre_departamento']}</td>
            <td>${elemento['fecha_peticion']}</td>
            <td><button class="btn btn-danger" onclick="eliminarPeticion(${elemento['id_peticion']})">Rechazar</button></td>
            </tr>`);
        });
        tabla.append("</tbody>");
    }else{
        tabla.empty();
        tabla.append(`<tbody><tr>
            <th><label>Nombre de Peticion</label></th>
            <th><label>Usuario que registro la peticion</label></th>
            <th><label>Departamento de la Peticion</label></th>
            <th><label>Fecha de la Peticion</label></th>
        </tr>`);
        msg.forEach(function(elemento){
            //Dibujar la Tabla de Peticiones por medio del DOM de JavaScripts 
            
            tabla.append(`<tr>
            <td>${elemento['nombre_peticion']}</td>
            <td>${elemento['nombre_usuario']}</td>
            <td>${elemento['nombre_departamento']}</td>
            <td>${elemento['fecha_peticion']}</td>
            </tr>`);
        });
        tabla.append("</tbody>");

    }
}