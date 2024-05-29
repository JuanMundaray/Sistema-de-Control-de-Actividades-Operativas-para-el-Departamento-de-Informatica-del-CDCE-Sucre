$(document).ready(function(){
    $("#cedula").on('input',function(){
        var valor=$(this).val();
        $(this).val(valor.replace(/\D/g,""));
    });

    //impedir que en el campo nombre se le puedan agregar signos especiales o numeros
    $("#nombre").on('input',function(){
        var valor=$(this).val();
        var nuevo_valor=valor.replace(/[0-9!@#$%^&*()_{}"'-|<>?,.`~=+]/g,"");
        $(this).val(nuevo_valor);
    
    });

    //impedir que en el campo apellido se le puedan agregar signos especiales o numeros
    $("#apellido").on('input',function(){
        var valor=$(this).val();
        var nuevo_valor=valor.replace(/[0-9!@#$%^&*()_{}"'-|<>?,.`~=+]/g,"");
        $(this).val(nuevo_valor);
    
    });

    //impedir que en el campo username se le puedan agregar signos especiales o numeros
    $("#username").on('input',function(){
        var valor=$(this).val();
        var nuevo_valor=valor.replace(/[!@#$%^&*()_{}"'|<>?,.`~=+]/g,"");
        $(this).val(nuevo_valor);
    
    });

    //impedir que en el campo username se le puedan agregar signos especiales o numeros
    $("#password").on('input',function(){
        var valor=$(this).val();
        var nuevo_valor=valor.replace(/-[!@#$%^&*()_{}"'|<>?,.`~=+]/g,"");
        $(this).val(nuevo_valor);
    
    });

    //Redirigir a la pagina de departamentos-agregar.php
    $("#agregar_departamento").on('click',function(){
        location.href='./departamentos-agregar.php';
    });
})

$.ajax({
    type:"POST",
    url:"../Controller/controllerDepartamentos.php",
    data:{option:"obtener"},
    dataType:'json',
    success:function(msg){
        msg.forEach(function(elemento){
            let departamento=$("#departamento");
            departamento.append("<option value='"+elemento['id_departamento']+"'>"+elemento["nombre_departamento"]+"</option>");
        });
    },
    error:function(jqXHR,textStatus,errorThrown){
        alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
    }
});