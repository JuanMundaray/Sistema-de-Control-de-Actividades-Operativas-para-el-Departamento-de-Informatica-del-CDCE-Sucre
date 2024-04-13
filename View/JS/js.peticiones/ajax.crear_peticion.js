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
        data:{option:"buscar",data_busq:$('#id_usuario_sesion').val(),columna:'id_usuario',useLIKE:false},
        dataType:'json',
        success:function(msg){
            msg.forEach(function(elemento){
                let departamento_peticion=$("#departamento_peticion");
                departamento_peticion.html("<option value='"+elemento['departamento_usuario']+"'>"+elemento["nombre_departamento"]+"</option>");
            });
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }
    });
});