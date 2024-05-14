$(document).ready(function(){
    obtener_estado_peticion();
    obtenerDepartamentos();
});
function obtener_estado_peticion(){
    let resultado;

    $.ajax({
        async:false,
        type:"POST",
        url:"../Controller/controllerEstado_peticion.php",
        data:{
            option:'obtener'
        },
        dataType:'json',
        success:function(msg){
            resultado=msg;
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }
    });

    resultado.forEach(function(elemento){
        estado_peticion=$("#estado_peticion");
        estado_peticion.append("<option value='"+elemento['id_estado_peticion']+"'>"+elemento["nombre_estado_peticion"]+"</option>");
    });
}

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
                let departamento_peticion=$("#departamento_peticion");
                departamento_peticion.append("<option value='"+elemento['nombre_departamento']+"'>"+elemento["nombre_departamento"]+"</option>");
                });
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }
    });
}