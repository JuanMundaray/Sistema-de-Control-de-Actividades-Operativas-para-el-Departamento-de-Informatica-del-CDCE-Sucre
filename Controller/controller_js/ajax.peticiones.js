$(document).ready(function(){
        
    getActividades();//Se Dibujan todas las actividades registradas en la tabla de actividades
    filtrar_estado();

});

function getPeticiones(){
    $.ajax({

        type:"POST",
        url:"../controller/controllerActividad.php",
        data:"option=obtener",
        dataType:'json',
        success:function(msg){
            paginacion(msg);
            
            msg.forEach(function(elemento){
                //Dibujar la Tabla de Peticiones por medio del DOM de JavaScripts 
                let tabla=$("#tabla_actividades");
                tabla.append(`<tr>
                <td>${elemento['codigo']}</td>
                <td>${elemento['fecha']}</td>
                <td>${elemento['nombre']}</td>
                <td>${elemento['nombre_tipo']}</td>
                <td>${elemento['dep_receptor']}</td>
                <td>${elemento['dep_emisor']}</td>
                <td>${elemento['nom_responsable']} ${elemento['ape_responsable']}</td>
                <td>${elemento['ced_responsable']}</td>
                <td>${elemento['nom_atendido']+" "+elemento['ape_atendido']}</td>
                <td>${elemento['ced_atendido']}</td>
                <td><button class="btn ${btn_estilo}">${elemento['estado']}</button></td>
                <td>${elemento['observacion']}</td>
                    
                <td>
                    <a href="editar-actividad.php?id=${elemento['id']}"><button class="btn btn-outline-secondary">Modificar</button></a>
                </td>
                <td><button class="btn btn-outline-danger" onclick="eliminarPeticion(${elemento['id']})">Eliminar</button></td></tr>`);
            });
        }

    });
}

function eliminarPeticion(id){
    let ok=confirm("¿Seguro que desea eliminar esta peticion?");
    if(ok){
        $.ajax({
            type:"POST",
            url:"../controller/controllerActividad.php",
            data:"option=eliminar&id="+id,
            dataType:'json',
            success:function(msg){
                alert("Peticion Eliminada");
                location.href="peticiones-registradas.php";
            }
    });
    }
}