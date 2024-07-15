export function ObtenerActividades(){

    let num_actividades;

    $.ajax({
        async:false,
        type:"POST",
        url:"../Controller/controllerActividad.php",
        data:{
            option:'obtener'
        },
        dataType:'json',
        success:function(msg){
            num_actividades=msg;
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }

    });

    return num_actividades;
}

export function ObtenerUsuarios(){

    let num_resultados;

    $.ajax({
        async:false,
        type:"POST",
        url:"../Controller/controllerUsuario.php",
        data:{
            option:'obtener'
        },
        dataType:'json',
        success:function(msg){
            num_resultados=msg;
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }

    });

    return num_resultados;
    
}
export function ObtenerPeticion(){

    let num_resultados;

    $.ajax({
        async:false,
        type:"POST",
        url:"../Controller/controllerPeticion.php",
        data:{
            option:'obtener'
        },
        dataType:'json',
        success:function(msg){
            num_resultados=msg;
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }

    });

    return num_resultados;
    
}
export function ObtenerDepartamentos(){

    let num_resultados;

    $.ajax({
        async:false,
        type:"POST",
        url:"../Controller/controllerDepartamentos.php",
        data:{
            option:'obtener'
        },
        dataType:'json',
        success:function(msg){
            num_resultados=msg;
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }

    });

    return num_resultados;
    
}