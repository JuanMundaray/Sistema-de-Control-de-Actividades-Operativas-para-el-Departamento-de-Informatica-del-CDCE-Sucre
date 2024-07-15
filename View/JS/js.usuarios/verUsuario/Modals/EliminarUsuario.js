window.eliminarUsuario=function(id_usuario){
    $("#ModalEliminarUsuario").modal("show");
    $("#cancelar").on("click",()=>{
        let mytoast = document.querySelector("#cancel-usuario");
        let Toast = new bootstrap.Toast(mytoast);
        Toast.show();
    });
    $("#confirmarEliminarUsuario").on("click",()=>{
        $.ajax({
            type:"POST",
            url:"../Controller/controllerUsuario.php",
            data:"option=eliminar&id_usuario="+id_usuario,
            dataType:'json',
            success:function(msg){
                if(msg==1){
                    let m=2;
                     sessionStorage.setItem('mensaje',m);
                     location.reload();
                 }
                 if(msg==0){
                     let mytoast = document.querySelector("#intento-usuario");
                     let Toast = new bootstrap.Toast(mytoast);
                     Toast.show();
                 }
            }
        });

    });
}
