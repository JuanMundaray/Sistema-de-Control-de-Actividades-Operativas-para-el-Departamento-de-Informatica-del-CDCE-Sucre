$(document).ready(function(){
    obtenerEstadosActividad();
    obtenerDepartamentos();
});

function obtenerDepartamentos(){
    $.ajax({
        type:"POST",
        url:"../Controller/controllerDepartamentos.php",
        data:{
            option:"obtener"
        },
        dataType:'json',
        success:function(msg){
            msg.forEach(function(elemento){
                let dep_emisor=$("#dep_emisor");
                dep_emisor.append("<option value='"+elemento['nombre_departamento']+"'>"+elemento["nombre_departamento"]+"</option>");
                let dep_receptor=$("#dep_receptor");
                dep_receptor.append("<option value='"+elemento['nombre_departamento']+"'>"+elemento["nombre_departamento"]+"</option>");
            });
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }
    });

}
function obtenerEstadosActividad(){
    $.ajax({

        type:"POST",
        url:"../Controller/controllerEstado_actividad.php",
        data:{
            option:"obtener"
        },
        dataType:'json',
        success:function(msg){
            msg.forEach(function(elemento){
                $("#estado_actividad").append(`<option value='${elemento['id_estado_actividad']}'>${elemento['nombre_estado_actividad']}</option>`);
            });
        },error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }

    });
}