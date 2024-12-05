window.$(document).ready(function(){

    //impedir que en el campo username se le puedan agregar signos especiales
    $("#username").on('input',function(){
        var valor=$(this).val();
        var nuevo_valor=valor.replace(/[^\w]/g,"");
        $(this).val(nuevo_valor);
        console.log("sda");
    
    });

    //impedir que en el campo username se le puedan agregar signos especiales
    $("#password").on('input',function(){
        var valor=$(this).val();
        var nuevo_valor=valor.replace(/[^\w\s]/g,"");
        $(this).val(nuevo_valor);
    
    });
})

$.ajax({
    type:"POST",
    url:"../Controller/controllerDepartamentos.php",
    data:{option:"obtener"},
    dataType:'json',
    success:function(msg){
        let departamento=$("#departamento");
        msg.forEach(function(elemento){
            departamento.append("<option value='"+elemento['id_departamento']+"'>"+elemento["nombre_departamento"]+"</option>");
        });
        departamento.append(`<option value='' id="agregarDepartamento">+ Agregar Departamento</option>`);
        $("#agregarDepartamento").on("click",()=>{
            $("#modal-departamento").modal("show");
        });
    },
    error:function(jqXHR,textStatus,errorThrown){
        alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
    }
});