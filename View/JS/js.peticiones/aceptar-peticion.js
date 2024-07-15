$(document).ready(function(){

    //Enviar formulario de Registro de Actividad a partir de una peticion
    let formulario=$('#crear_actividad_peticion');
    formulario.submit(function(e){
        if(this.checkValidity()){
            e.preventDefault();
            $.ajax({
                type:"POST",
                url:"../Controller/controllerActividad.php",
                data:formulario.serialize(),
                dataType:'json',
                success:function(msg){
                    AceptarPeticion();
                },
                error:function(jqXHR,textStatus,errorThrown){
                    alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
                }
            });

        }else{
            alert("NINGUN CAMPO PUEDE ESTAR VACIO");
        }
    });

    //Rellenar los datos del usuario atendido para aceptar su peticion
    $.ajax({
        async:false,
        type:"POST",
        url:"../Controller/controllerPeticion.php",
        data:{
            option:"obtener",
            id_peticion:$('#id_peticion').val()
            },
        dataType:'json',
        success:function(msg){
            msg.forEach(function(elemento){
                $("#nom_atendido").val(elemento['nombre_personal']);
                $("#ape_atendido").val(elemento['apellido_personal']);
                $("#ced_atendido").val(elemento['cedula']);
                $("#dep_emisor").val(elemento['nombre_departamento']);
                $("#id_tipo_actividad").val(elemento['tipo_actividad']);
                $("#modalDetallesPeticion .modal-body").append(elemento['detalles_peticion']);
            });
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }
    });
    
});

//Funcion para Cambiar el estado de la peticion a aceptada
function AceptarPeticion(){  
    $.ajax({
        async:false,
        type:"POST",
        url:"../Controller/controllerPeticion.php",
        data:{
            option:"aceptar",
            id_peticion:$('#id_peticion').val(),
            actividad_originada:$("#codigo_actividad").val()
            },
        dataType:'json',
        success:function(msg){
            let m=4;
            sessionStorage.setItem('mensaje',m);
            location.href='./actividades-registradas.php';
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error cambiar estado de peticion"+jqXHR+" "+textStatus+" "+errorThrown);
        }
    });
}