window.SeguimientoActividad=function(codigo_actividad){

    $("#ModalSeguimientoActividad").modal("show");  
    getRegistrosModificacion(codigo_actividad)
}

//Obtener todos los registros de cada cambio en una actividad
function getRegistrosModificacion(codigo_actividad,pagina=1){
    
    let num_resultados=5;

    $.ajax({
        async:false,
        type:"POST",
        url:"../Controller/controllerActividad.php",
        data:{
            option:'obtenerRegistrosModificacion',
            pagina:pagina,
            num_resultados:num_resultados,
            codigo_actividad:codigo_actividad
        },
        dataType:'json',
        success:function(msg){
            if(msg==""){
                alert('Sin Resultados');
            }
            RellenarTablaActividades(msg);
            
        },error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }

    });
}

//funcion para llenar el cuerpo de la tabla de registro de modificacion
function RellenarTablaActividades(msg){
    
    function bg_estilo(elemento){
        if(elemento=="INICIADA"){
            var bg_estilo="bg-primary";
        }
        if(elemento=="CREADA"){
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
        return bg_estilo;
    }

    let cuerpo_tabla=$("#tabla_actividades_registro_modificacion tbody");
    cuerpo_tabla.empty();
    msg.forEach(function(elemento){
        let bg_estilo_bage=bg_estilo(elemento['nombre_estado_actividad']);
        let bg_estilo_bage_modificacion=bg_estilo(elemento['estado_modificado']);
        cuerpo_tabla.append(`
        <tr class='align-middle'>

            <td><h5><span class="badge rounded-pill  ${bg_estilo_bage_modificacion}" style="width: 120px;">${elemento['estado_modificado']}</span></h5></td>

            <td><h5><span class="badge rounded-pill ${bg_estilo_bage}" style="width: 120px;">${elemento['nombre_estado_actividad']}</span></h5></td>

            <td>${elemento['fecha_modificacion']}</td>

            <td>${elemento['hora_modificacion']}</td>
            <td>${elemento['nombre_tipo']}</td>
        </tr>`);
    });
}