window.eliminarActividad=function(codigo_actividad){
    $("#ModalEliminarActividad").modal("show");
    $("#cancelar").on("click",()=>{
        let mytoast = document.querySelector("#cancel-actividad");
        let Toast = new bootstrap.Toast(mytoast);
        Toast.show();
    });
    $("#confirmarEliminarActividad").on("click",()=>{
        $.ajax({
            type:"POST",
            url:"../Controller/controllerActividad.php",
            data:"option=eliminar&codigo_actividad="+codigo_actividad,
            dataType:'json',
            success:function(msg){
                let m=2;
                sessionStorage.setItem('mensaje',m);
                location.reload();
            }
        });

    });
}