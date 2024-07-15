window.rechazarPeticion=function(id_peticion){
    $("#ModalRechazarPeticion").modal("show");

    $("#confirmarRechazarPeticion").on("click",()=>{
        $.ajax({
            type:"POST",
            url:"../Controller/controllerPeticion.php",
            data:{option:"rechazar",id_peticion:id_peticion},
            dataType:'json',
            success:function(){
                let m=2;
                sessionStorage.setItem('mensaje',m);
                location.reload();
            },error:function(jqXHR,textStatus,errorThrown){
                alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
            }
        });

    });
}