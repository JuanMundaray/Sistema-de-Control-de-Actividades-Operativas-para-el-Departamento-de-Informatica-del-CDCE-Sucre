$(document).ready(function(){
    $.ajax({
        type:"POST",
        url:"../Controller/controllerPeticion.php",
        data:{
            option:"obtener",
            id_peticion:$("#id_peticion").val()
        },
        dataType:'json',
        success:function(msg){
            console.log(msg);
            msg.forEach(function(elemento){
                let codigo=$("#id_peticion").append(elemento["id_peticion"]);
                let nombre=$("#nombre_peticion").append(elemento["nombre_peticion"]);
                let departamento_peticion=$("#departamento_peticion").append(elemento["nombre_departamento"]);
                let tipo=$("#tipo").append(elemento["nombre_tipo"]);
                let estado=$("#estado_peticion").append(elemento["estado_peticion"]);
                let nombre_solicitante=$("#nombre_solicitante").append(`${elemento["nombre_personal"]} ${elemento["apellido_personal"]}`);
                let cedula_solicitante=$("#cedula_solicitante").append(elemento["cedula"]);
                let detalles_peticion=$("#detalles_peticion").append(elemento["detalles_peticion"]);
                
            });
        },error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }
    })
});