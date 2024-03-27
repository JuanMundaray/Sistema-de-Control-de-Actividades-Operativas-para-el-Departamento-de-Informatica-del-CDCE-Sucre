$(document).ready(function(){
    $("#ced_atendido").on('input',function(){
        var valor=$(this).val();
        $(this).val(valor.replace(/\D/g,""));
    });
    $("#ced_responsable").on('input',function(){
        var valor=$(this).val();
        $(this).val(valor.replace(/\D/g,""));
    });

    $("#guardar_actividad").click(function(){
        if($("#nombre").val==""){
            alert("Debe Ingresar Un nombre");
            return false;
        }

    });
    
});