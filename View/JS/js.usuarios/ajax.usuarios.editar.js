$(document).ready(function(){
    id=$("#id_usuario").val();
    $.ajax({
        type:"POST",
        url:"../Controller/controllerUsuario.php",
        data:{option:"buscar",data_busq:id,columna:'id_usuario',useLIKE:false},
        dataType:'json',
        success:function(msg){
            msg.forEach(function(elemento){
                let nombre_usuario=$("#nombre_usuario").val(elemento["nombre_usuario"]);
                let password=$("#password").val(elemento["contrasena"]);
                let nombre=$("#nombre").val(elemento["nombre"]);
                let cedula=$("#cedula").val(elemento["cedula"]);
                let departamento=$("#departamento").val(elemento["id_departamento"]);
                let tipo_usuario=$("#tipo_usuario").val(elemento["tipo_usuario"]);
                if(tipo_usuario.val()!='administrador'){
                    console.log(tipo_usuario.removeAttr("disabled"));
                }
            });
        },error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }

    });
        
    //Esta parte obtiene todos los departamentos y los agrega a la lista de departamentos
    $.ajax({
        type:"POST",
        url:"../Controller/controllerDepartamentos.php",
        data:{option:"obtener"},
        dataType:'json',
        success:function(msg){
            msg.forEach(function(elemento){
                let departamento=$("#departamento");
                departamento.append("<option value='"+elemento['id_departamento']+"'>"+elemento["nombre_departamento"]+"</option>");
            });
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }
    });
});