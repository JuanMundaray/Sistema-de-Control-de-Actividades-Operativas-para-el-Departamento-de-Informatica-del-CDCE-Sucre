$(document).ready(function(){
    $.ajax({
        type:"POST",
        url:"../Controller/controllerTipo_actividad.php",
        data:{option:"obtener"},
        dataType:'json',
        success:function(msg){
            msg.forEach(function(elemento){
                let tipo=$("#tipo_actividad");
                tipo.append("<option value='"+elemento['id_tipo']+"'>"+elemento["nombre_tipo"]+"</option>");
            });
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }
    });
    $.ajax({
        type:"POST",
        url:"../Controller/controllerUsuario.php",
        data:{
            option:"obtener",
            id_usuario:$('#id_usuario_sesion').val()
        },
        dataType:'json',
        success:function(msg){
            msg.forEach(function(elemento){
                let departamento_peticion=$("#departamento_peticion");
                departamento_peticion.html("<option value='"+elemento['departamento_usuario']+"'>"+elemento["nombre_departamento"]+"</option>");
                $("#emisor_peticion").val(elemento['nombre_personal']+' '+elemento['apellido_personal']);
            });
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }
    });
});