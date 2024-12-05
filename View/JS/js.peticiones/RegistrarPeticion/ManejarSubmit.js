export function SubmitCrearPeticion(){

    const form = $("#formularioRegistrarPeticion");
    const ConfirmarRegistrarPeticion= $("#ConfirmarRegistrarPeticion");

    form.on("submit",function(event){

        event.preventDefault();

        if(document.querySelector("#formularioRegistrarPeticion").checkValidity()){
            $("#label_nombre").text($("#nombre_peticion").val());
            $("#label_departamento").text(ObtenerDepartamentos($("#departamento_peticion").val()));
            $("#label_tipo_actividad").text(ObtenerTipoActividad($("#tipo_actividad").val()));
            $("#label_emisor").text($("#emisor_peticion").val());
            $("#label_detalles").text($("#detalles_peticion").val());
            $("#ModalConfirmarRegistroPeticion").modal("show");
        }
    });

    ConfirmarRegistrarPeticion.on("click",function(){
        $.ajax({
            async:false,
            type:"POST",
            url:"../Controller/controllerPeticion.php",
            data:form.serialize(),
            dataType:'json',
            success:function(msg){
                let m=1;
                sessionStorage.setItem('mensaje',m);
                location.href="./peticiones-registradas-propias.php";
            },
            error:function(jqXHR,textStatus,errorThrown){
                alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
            }
        });

    });
} 


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

function ObtenerTipoActividad(id_tipo_actividad){

    let resultado; 
    $.ajax({
        async:false,
        type:"POST",
        url:"../Controller/controllerTipo_actividad.php",
        data:{
            option:"obtener",
            id_tipo_actividad:id_tipo_actividad
        },
        dataType:'json',
        success:function(msg){
            resultado=msg[0]['nombre_tipo'];
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }
    });
    return resultado;
}

function CrearPeticion(){
    
}