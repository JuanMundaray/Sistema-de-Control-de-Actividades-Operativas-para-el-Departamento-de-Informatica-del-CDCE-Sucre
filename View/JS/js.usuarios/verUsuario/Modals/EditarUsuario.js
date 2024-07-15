window.editarUsuario=function(id_usuario){

    $("#ModalEditarUsuario").modal("show");
    $("#cancel").on("click",()=>{
        let mytoast = document.querySelector("#cancelarUsuario");
        let Toast = new bootstrap.Toast(mytoast);
        Toast.show();
    });

    $.ajax({
        type:"POST",
        url:"../Controller/controllerUsuario.php",
        dataType:'json',
        data:{option:"obtener",id_usuario:id_usuario},
        success:function(msg){
            msg.forEach(function(elemento){
                let id=$("#id_usuario").val(id_usuario);
                let nombre_usuario=$("#editar_input_nombre_usuario").val(elemento["nombre_usuario"]);
                let nombre_personal=$("#nombre_personal").val(elemento["nombre_personal"]);
                let apellido_personal=$("#apellido_personal").val(elemento["apellido_personal"]);
                let cedula=$("#cedula").val(elemento["cedula"]);
                let departamento=$("#departamento").val(elemento["id_departamento"]);
                let tipo_usuario=$("#tipo_usuario").val(elemento["tipo_usuario"]);                    
                if(tipo_usuario.val()=='administrador'){
                        tipo_usuario.addClass("is-disabled");
                }
            });
        },error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }
    
    });

        //Esta parte obtiene todos los departamentos y los agrega a la lista de departamentos
        $.ajax({
            type:"POST",
            url:"../Controller/controllerDepartamentos.php",
            data:{option:"obtener"},
            dataType:'json',
            success:function(msg){
                msg.forEach(function(elemento){
                    let departamento=$("#departamento");
                    departamento.append(`<option value="${elemento['id_departamento']}">${elemento["nombre_departamento"]}</option>`);
                });
            },
            error:function(jqXHR,textStatus,errorThrown){
                 alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
            }
        });

    const form=$("#form_editar_usuario");
    form.on("submit",(event)=>{
        event.preventDefault();
        if(document.querySelector("#form_editar_usuario").checkValidity()){
            form.off("submit");
            form.submit();
        }
    });
            



}
