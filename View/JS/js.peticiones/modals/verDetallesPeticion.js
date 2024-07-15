window.MostrarDetalles=function(id){

    $("#ModalDetallesPeticion").modal("show");
    $.ajax({
        type:"POST",
        url:"../Controller/controllerPeticion.php",
        data:{
            option:"obtener",
            id_peticion:$("#id_peticion").val()
        },
        dataType:'json',
        success:function(msg){
            let nombre=$("#nombre_peticion").append(msg[0]["nombre_peticion"]);
            let departamento_peticion=$("#departamento_peticion").append(msg[0]["departamento_peticion"]);
            let tipo=$("#tipo").append(msg[0]["nombre_tipo"]);
            let estado=$("#estado_peticion").append(msg[0]["nombre_estado_peticion"]);
            let nombre_solicitante=$("#nombre_solicitante").append(`${msg[0]["nombre_personal"]} ${msg[0]["apellido_personal"]}`);
            let cedula_solicitante=$("#cedula_solicitante").append(msg[0]["cedula"]);
            let detalles_peticion=$("#detalles_peticion").append(msg[0]["detalles_peticion"]);
            
        },error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }
    })
};