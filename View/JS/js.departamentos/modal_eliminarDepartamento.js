window.eliminarDepartamento=function(id_departamento){
    $("#ModalEliminarDepartamento").modal("show");
    $("#confirmarEliminarDepartamento").on("click",()=>{
        $.ajax({
            type:"POST",
            url:"../Controller/controllerDepartamentos.php",
            data:{
                option:'eliminar',
                id_departamento:id_departamento
            },
            dataType:'json',
            success:function(msg){
                console.log(msg);
                if(msg==1){
                    location.reload();
                }
                else{
                    $("#ModalEliminarDepartamento").modal("hide");
                    $("#ModalErrorEliminar").modal("show");
                }
            }
        });

    });
}