window.cancelarPeticion=function(id_peticion){
    $("#ModalCancelarPeticion").modal("show");

    $("#confirmarCancelarPeticion").on("click",()=>{
        $.ajax({
            type:"POST",
            url:"../Controller/controllerPeticion.php",
            data:{
                option:'eliminar',
                id_peticion:id_peticion
            },
            dataType:'json',
            success:function(msg){
                let m=3;
                sessionStorage.setItem('mensaje',m);
                location.reload();
            }
        });

    });
}