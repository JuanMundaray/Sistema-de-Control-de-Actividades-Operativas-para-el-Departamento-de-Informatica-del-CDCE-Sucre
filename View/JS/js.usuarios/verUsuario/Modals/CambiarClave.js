window.cambiarClave=function(id_usuario){

    $("#ModalCambiarClave").modal("show");
    $("#cancel").on("click",()=>{
        let mytoast = document.querySelector("#cancelarUsuario");
        let Toast = new bootstrap.Toast(mytoast);
        Toast.show();
    });

    $('#cambiar_clave_id_usuario').val(id_usuario);
    
    const form=$("#form_cambiarClave");

    form.on("submit",(event)=>{
        let confirmada=($("#password_confirm").val())==($("#password").val());

        event.preventDefault();
        if(confirmada){
            if(document.querySelector("#form_cambiarClave").checkValidity()){
                $("#password_confirm").removeClass("is-invalid");
                form.off("submit");
                form.submit();
            }
        }

        else{
            form.removeClass("was-validated");
            $("#password_confirm").addClass("is-invalid");
        }

    });
            



}
