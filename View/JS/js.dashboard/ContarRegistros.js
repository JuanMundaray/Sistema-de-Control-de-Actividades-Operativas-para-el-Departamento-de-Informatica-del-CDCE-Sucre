export function contarActividades(estado_actividad=null,year=null,month=null,day=null){

    let num_actividades;

    $.ajax({
        async:false,
        type:"POST",
        url:"../Controller/controllerActividad.php",
        data:{
            option:'contarRegistros',
            estado_actividad:estado_actividad,
            year:year,
            month:month,
            day:day
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

export function contarUsuarios(tipo_usuario=null){

    let num_resultados;

    $.ajax({
        async:false,
        type:"POST",
        url:"../Controller/controllerUsuario.php",
        data:{
            option:'contarRegistros',
            tipo_usuario:tipo_usuario
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

export function FilterArrayActividades(array,estado_actividad=null,year=null,month=null,day=null){
    
    let resultado=array;

    if(estado_actividad!=null){
        resultado=resultado.filter((element)=>element['estado_actividad']==estado_actividad)
    }
    if(day!=null){
        resultado=resultado.filter((element)=>element['day']==day)
    }
    if(month!=null){
        resultado=resultado.filter((element)=>element['month']==month)
    }
    if(year!=null){
        resultado=resultado.filter((element)=>element['year']==year)
    }

    return resultado.length;

}

export function FilterArrayUsuarios(array,tipo_usuario=null){
    
    let resultado=array;

    if(tipo_usuario!=null){
        resultado=resultado.filter((element)=>element['tipo_usuario']==tipo_usuario)
    }

    return resultado.length;

}

export function FilterArrayPeticiones(array,nombre_estado_peticion=null){
    
    let resultado=array;

    if(nombre_estado_peticion!=null){
        resultado=resultado.filter((element)=>element['nombre_estado_peticion']==nombre_estado_peticion)
    }

    return resultado.length;

}