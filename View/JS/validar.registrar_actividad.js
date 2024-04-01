$(document).ready(function(){
    $("#ced_atendido").on('input',function(){
        var valor=$(this).val();
        $(this).val(valor.replace(/\D/g,""));
    });
    $("#ced_responsable").on('input',function(){
        var valor=$(this).val();
        $(this).val(valor.replace(/\D/g,""));
    });
    
});