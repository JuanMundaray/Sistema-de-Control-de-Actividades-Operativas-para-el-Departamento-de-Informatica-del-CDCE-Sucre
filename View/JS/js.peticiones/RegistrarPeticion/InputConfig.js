window.$(document).ready(function(){
    $("#nombre_peticion").on('input',function(){
        var valor=$(this).val();
        var nuevo_valor=valor.replace(/[0-9!@#$%^&*()_{}"´'¡¿°:|<>?,.`~+=/;[-]/g,"");
        $(this).val(nuevo_valor);
    
    });
    $.ajax({
        type:"POST",
        url:"../Controller/controllerTipo_actividad.php",
        data:{option:"obtener"},
        dataType:'json',
        success:function(msg){
            msg.forEach(function(elemento){
                $("#tipo_actividad").append("<option value='"+elemento['id_tipo']+"'>"+elemento["nombre_tipo"]+"</option>");
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
                $("#departamento_peticion").val(elemento["id_departamento"]);
                $("#visualizar_departamento_peticion").val(elemento["nombre_departamento"]);
                $("#emisor_peticion").val(elemento['nombre_personal']+' '+elemento['apellido_personal']);
            });
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }
    });
});