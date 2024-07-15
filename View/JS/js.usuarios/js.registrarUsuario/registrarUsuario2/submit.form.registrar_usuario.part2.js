export function SubmitUsuarioNuevo(){

    const form = $("#form_crear_usuario_part2");

    form.on("submit",function(event){

        event.preventDefault();

        $("#form_crear_usuario_part2 input").removeClass("is-invalid");

        if(document.querySelector("#form_crear_usuario_part2").checkValidity()){
            //Este es un ajax para contar los nombres de usuario que ya existen con el nombre de usuario en el input
            $.ajax({

                data:{
                    option:"contarRegistros",
                    nombre_usuario:$("#username").val(),
                    extraer_todos:false
                },
                url: "../Controller/controllerUsuario.php",
                type: 'post',

                success: function (response){

                    //primero se comprueba si el nombre de usuario ya existe
                    if(parseInt(response)===0){
                        $("#label_username").text($("#username").val());
                        $("#label_tipo_usuario").text($("#tipo_usuario").val().toUpperCase());
                        $("#label_password").text($("#password").val());
                        $("#label_departamento").text(ObtenerDepartamento($("#departamento").val()));
                        $("#confirmarRegistroUsuario").modal("show");
                    }
        
                    else{
                        form.removeClass("was-validated");
                        $("#username").addClass("is-invalid");
                        $("#container_username .invalid-feedback").text("*Este Nombre de Usuario ya Esta Siendo Utilizado");
                    }
                }
            });
        }

        else{
            $("#container_cedula .invalid-feedback").text("*El Nombre de Usuario Debe de Tener Como Mínimo 4 Carácteres");
        }
    });
} 

function ObtenerDepartamento(id_departamento){   
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