$(document).ready(function(){
    num_actividad();

});
function num_actividad(){

    let num_actividades;

    $.ajax({
        async:false,
        type:"POST",
        url:"../Controller/controllerActividad.php",
        data:{option:'contarRegistros'},
        dataType:'json',
        success:function(msg){
            num_actividades=msg;
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }

    });

    $("#num_actividades").html(num_actividades);
}