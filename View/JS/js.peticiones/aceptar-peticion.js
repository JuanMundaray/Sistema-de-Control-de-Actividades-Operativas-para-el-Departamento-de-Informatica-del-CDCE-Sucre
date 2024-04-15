$(document).ready(function(){

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
                    marcarPeticionAceptada();
                    location.replace('./actividades-registradas.php');
                },
                error:function(jqXHR,textStatus,errorThrown){
                    alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
                }
            });

        }else{
            alert("Ningun Campo Puede Estar Vacio");
        }
    });

    //Rellenar los datos del usuario atendido al aceptar su peticion
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
            console.log(msg);
            msg.forEach(function(elemento){
                let input_nom_atendido=$("#nom_atendido").val(elemento['nombre_personal']);
                let input_ape_atendido=$("#ape_atendido").val(elemento['apellido_personal']);
                let input_ced_atendido=$("#ced_atendido").val(elemento['cedula']);
                let input_dep_emisor=$("#dep_emisor").val(elemento['nombre_departamento']);
                let input_tipo_actividad=$("#id_tipo_actividad").val(elemento['tipo_actividad']);
                let input_nombre_actividad=$("#nombre_actividad").val(elemento['nombre_peticion']);
            });
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }
    });
    
});

function marcarPeticionAceptada(){  
    $.ajax({
        type:"POST",
        url:"../Controller/controllerPeticion.php",
        data:{
            option:"aceptar",
            id_peticion:$('#id_peticion').val()
            },
        dataType:'json',
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }
    });
}