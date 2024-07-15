$(document).ready(function(){
    obtenerEstadosActividad();
    getHistorialActividades();//Se Dibujan todas las actividades registradas en la tabla de actividades
    tipo_usuario_sesion=$('#tipo_usuario_sesion').val();
    $("#num_resultados option").on('input',function(){
        getHistorialActividades();
    });

    $("#aplicar_filtro").click(function(){ 
        //Funcion ajax para buscar una actividad por su codigo
        getHistorialActividades();
    });


});

function getHistorialActividades(pagina=1){
    let num_resultados=$("#num_resultados").val();
    let codigo_actividad=$("#data_busq_codigo").val();
    let nombre_actividad=$("#data_busq_nombre").val();
    let fecha_registro=$("#data_busq_fecha").val();
    let estado_actividad=$("#estado_actividad").val();
    let day=$("#day").val();
    let year=$("#year").val();
    let month=$("#month").val();

    $.ajax({
        type:"POST",
        url:"../Controller/controllerActividad.php",
        data:{
            option:'obtener',
            pagina:pagina,
            num_resultados:num_resultados,
            codigo_actividad:codigo_actividad,
            nombre_actividad:nombre_actividad,
            fecha_registro:fecha_registro,
            estado_actividad:estado_actividad,
            day:day,
            month:month,
            year:year,
            todas:true
        },
        dataType:'json',
        success:function(msg){
            if(msg==""){
                alert('Sin Resultados');
            }
            RellenarTablaActividades(msg);
            paginacion(num_resultados);
        }

    });
}

function RellenarTablaActividades(msg){
    
    function estilo_bg(elemento){

        ESTADO_ACTIVIDAD={
            INICIADA:"INICIADA",
            PROCESO:"PROCESO",
            COMPLETADA:"COMPLETADA",
            SUSPENDIDA:"SUSPENDIDA",
            ELIMINADA:"ELIMINADA",
        }

        if(elemento=="INICIADA"){
            var bg_estilo="bg-primary";
        }
        if(elemento=="PROCESO"){
            var bg_estilo="bg-warning";
        }
        if(elemento=="COMPLETADA"){
            var bg_estilo="bg-success";
        }
        if(elemento=="SUSPENDIDA"){
            var bg_estilo="bg-danger";
        }
        if(elemento=="ELIMINADA"){
            var bg_estilo="bg-danger";
        }
        return bg_estilo;
    }

    let tabla_part_1=$("#tabla_historial_actividades_1 tbody");
    let tabla_part_2=$("#tabla_historial_actividades_2 tbody");
    let tabla_part_3=$("#tabla_historial_actividades_3 tbody");
    tabla_part_1.empty();
    tabla_part_2.empty();
    tabla_part_3.empty();

    msg.forEach(function(elemento,index){
        //Estas son los botones de accion que estaran disponibles segun si la actividad a sido completada o no
        index+=1;

        let bg_estilo=estilo_bg(elemento['nombre_estado_actividad']);
        
        tabla_part_1.append(
        `<tr class='align-middle'>
            <td>${index}</td>
            <td>${elemento['fecha_registro']}</td>
            <td>${elemento['nombre_actividad']}</td>
            <td>${elemento['nombre_tipo']}</td>
            <td><h5><span class="badge rounded-pill  ${bg_estilo}" style="width: 120px;">${elemento['nombre_estado_actividad']}</span><h5></td>
        </tr>
        `);
        tabla_part_2.append(`
        <tr>
            <td>${index}</td>
            <td>${elemento['nombre_personal']} ${elemento['apellido_personal']}</td>
            <td>${elemento['cedula']}</td> 
            <td>${elemento['dep_receptor']}</td>
        </tr>
            `);
        tabla_part_3.append(`
        <tr>
            <td>${index}</td>
            <td>${elemento['nom_atendido']+" "+elemento['ape_atendido']}</td>
            <td>${elemento['ced_atendido']}</td>
            <td>${elemento['dep_emisor']}</td>
        </tr>
            `);
    });
}

function paginacion(num_resultados){//Esta funcion hace apararecerlos botones para paginar los registros obtenidos

    let codigo_actividad=$("#data_busq_codigo").val();
    let nombre_actividad=$("#data_busq_nombre").val();
    let fecha_registro=$("#data_busq_fecha").val();
    let estado_actividad=$("#estado_actividad").val();
    let day=$("#day").val();
    let year=$("#year").val();
    let month=$("#month").val();
    let num_filas;

    $.ajax({ 
        async:false,
        type:"POST",
        url:"../Controller/controllerActividad.php",
        data:{
            option:'contarRegistros',
            codigo_actividad:codigo_actividad,
            nombre_actividad:nombre_actividad,
            fecha_registro:fecha_registro,
            estado_actividad:estado_actividad,
            todas:true,
            day:day,
            month:month,
            year:year
        },
        dataType:'json',
        success:function(msg){
            num_filas=msg
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }

    });

    let num_paginas=Math.ceil((num_filas)/(num_resultados));
    $("#num_paginas").empty();

    for(let i=1;i<=num_paginas;i++){
        setNumeroPaginas(i);
    }

    function setNumeroPaginas(numero){
        $("#num_paginas").append(
            `<li class="page-item"><a class="page-link" href='#tabla_actividades' onclick="getHistorialActividades(${numero})"'>${numero}</a></li>`
        )
    }
}
function eliminarActividad(codigo_actividad){
    let ok=confirm("¿Seguro que desea eliminar esta actividad?");
    if(ok){
        $.ajax({
            type:"POST",
            url:"../Controller/controllerActividad.php",
            data:"option=eliminar&codigo_actividad="+codigo_actividad,
            dataType:'json',
            success:function(msg){
                alert("Actividad Eliminada Exitosamente");
                location.reload();
            }
    });
    }
}
function obtenerEstadosActividad(){
    $.ajax({
        async:false,
        type:"POST",
        url:"../Controller/controllerEstado_actividad.php",
        data:{
            option:"obtener"
        },
        dataType:'json',
        success:function(msg){
            msg.forEach(function(elemento){
                let nombre_estado=elemento['nombre_estado_actividad'];
                let id_estado=elemento['id_estado_actividad'];
                $("#estado_actividad").append(`<option value='${id_estado}'>${nombre_estado}</option>`);
            });
        },error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }

    });
}