$(document).ready(function(){
    setTimeout(num_actividad,0);
    setTimeout(num_actividades_iniciadas,0);
    setTimeout(num_actividades_suspendidas,0);
    setTimeout(num_actividades_proceso,0);
    setTimeout(num_usuarios,0);
    setTimeout(num_actividades_completadas,0);

});

function num_actividad(){

    let num_actividades;

    $.ajax({
        async:false,
        type:"POST",
        url:"../Controller/controllerActividad.php",
        data:{
            option:'contarRegistros'
        },
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

function num_actividades_iniciadas(){

    let num_resultados;

    $.ajax({
        async:false,
        type:"POST",
        url:"../Controller/controllerActividad.php",
        data:{
            option:'contarRegistros',
            estado_actividad:"INICIADA"
        },
        dataType:'json',
        success:function(msg){
            num_resultados=msg;
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }

    });
    $("#num_actividades_iniciadas").html(num_resultados);
    
}

function num_actividades_suspendidas(){

    let num_resultados;

    $.ajax({
        async:false,
        type:"POST",
        url:"../Controller/controllerActividad.php",
        data:{
            option:'contarRegistros',
            estado_actividad:"SUSPENDIDA"
        },
        dataType:'json',
        success:function(msg){
            num_resultados=msg;
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }

    });
    $("#num_actividades_suspendidas").html(num_resultados);
    
}

function num_actividades_proceso(){

    let num_resultados;

    $.ajax({
        async:false,
        type:"POST",
        url:"../Controller/controllerActividad.php",
        data:{
            option:'contarRegistros',
            estado_actividad:"PROCESO"
        },
        dataType:'json',
        success:function(msg){
            num_resultados=msg;
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }

    });
    $("#num_actividades_proceso").html(num_resultados);
    
}

function num_usuarios(){

    let num_resultados;

    $.ajax({
        async:false,
        type:"POST",
        url:"../Controller/controllerUsuario.php",
        data:{option:'contarRegistros'},
        dataType:'json',
        success:function(msg){
            num_resultados=msg;
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }

    });
    $("#num_usuarios").html(num_resultados);
    
}

function num_actividades_completadas(){

    let num_resultados;

    $.ajax({
        async:false,
        type:"POST",
        url:"../Controller/controllerActividad.php",
        data:{
            option:'contarRegistros',
            estado_actividad:"COMPLETADA"
        },
        dataType:'json',
        success:function(msg){
            num_resultados=msg;
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }

    });
    $("#num_actividades_completadas").html(num_resultados);
    
}