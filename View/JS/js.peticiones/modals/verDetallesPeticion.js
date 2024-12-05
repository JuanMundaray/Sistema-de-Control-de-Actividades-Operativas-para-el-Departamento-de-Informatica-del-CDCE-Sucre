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
            let nombre=$("#nombre_peticion").text(msg[0]["nombre_peticion"]);
            let departamento_peticion=$("#departamento_peticion_modal").text(ObtenerDepartamentos(msg[0]["departamento_peticion"]));
            let tipo=$("#tipo").text(msg[0]["nombre_tipo"]);
            let estado=$("#estado_peticion").text(msg[0]["nombre_estado_peticion"]);
            let nombre_solicitante=$("#nombre_solicitante").text(`${msg[0]["nombre_personal"]} ${msg[0]["apellido_personal"]}`);
            let cedula_solicitante=$("#cedula_solicitante").text(msg[0]["cedula"]);
            let detalles_peticion=$("#detalles_peticion").text(msg[0]["detalles_peticion"]);
            
        },error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }
    })
};

function ObtenerDepartamentos(id_departamento){
    let resultado; 
    $.ajax({
        async:false,
        type:"POST",
        url:"../Controller/controllerDepartamentos.php",
        data:{
            option:"obtener",
            id_departamento:id_departamento
        },
        dataType:'json',
        success:function(msg){
            resultado=msg[0]['nombre_departamento'];
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }
    });
    return resultado;
}