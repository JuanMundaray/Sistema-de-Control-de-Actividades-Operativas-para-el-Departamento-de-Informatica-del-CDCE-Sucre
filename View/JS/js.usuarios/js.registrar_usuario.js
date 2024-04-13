$(document).ready(function(){
    $("#cedula").on('input',function(){
        var valor=$(this).val();
        $(this).val(valor.replace(/\D/g,""));
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