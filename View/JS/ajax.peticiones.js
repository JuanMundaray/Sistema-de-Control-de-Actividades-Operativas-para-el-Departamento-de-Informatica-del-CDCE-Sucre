$(document).ready(function(){
    getPeticiones();
})

function getPeticiones(){
    $.ajax({

        type:"POST",
        url:"../controller/controllerPeticion.php",
        data:"option=obtener",
        dataType:'json',
        success:function(msg){
            msg.forEach(function(elemento){
                //Dibujar la Tabla de Peticiones por medio del DOM de JavaScripts 
                let tabla=$("#tabla_peticiones");
                tabla.append(`<tr>
                <td>${elemento['nombre_peticion']}</td>
                <td>${elemento['nombre_usuario']}</td>
                <td>${elemento['departamento_peticion']}</td>
                <td>${elemento['fecha_peticion']}</td>

                <td><a href="id=${elemento['id_peticion']}"><button class="btn btn-success">Aceptar</button></a></td>

                <td><button class="btn btn-danger" onclick="eliminarPeticion(${elemento['id_peticion']})">Eliminar</button></td>
                </tr>`)
                    
            });
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
            url:"../controller/controllerPeticion.php",
            data:"option=eliminar&id_peticion="+id_peticion,
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