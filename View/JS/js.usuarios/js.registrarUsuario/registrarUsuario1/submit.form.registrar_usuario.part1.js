$("#cedula").on("input",(event)=>{
    $("#cedula").removeClass("is-invalid");
});

$("#form_crear_usuario_part1").on("submit",(event)=>{
    event.preventDefault();
    const form=$($("#form_crear_usuario_part1"));

    $.ajax({
        data:{
            option:"contarRegistros",
            cedula:$("#cedula").val(),
            extraer_todos:false
        },
        url: "../Controller/controllerUsuario.php",
        type: 'post',
        success: function (response){
            if(parseInt(response)===0){
                if(document.querySelector("#form_crear_usuario_part1").checkValidity()){
                    form.off("submit");
                    form.submit();
                }
                else{
                    $("#container_cedula .invalid-feedback").text("*La Cédula debe tener como mínimo 7 dígitos");
                }
            }

            else{
                form.removeClass("was-validated");
                $("#cedula").addClass("is-invalid");
                $("#container_cedula .invalid-feedback").text("*No se Puede Repetir la Cedula");
            }
        }
    });
});