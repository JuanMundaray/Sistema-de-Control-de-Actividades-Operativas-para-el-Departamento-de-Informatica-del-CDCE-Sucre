$(document).ready(function(){
    obtenerEstadosActividad();
    $("#COMPLETADA").click(function(){
        $("#div_estado").before(`
        <div class="col-md-12 div_input_form" id="div_evidencia">
            <label class="col-md-12 form-label">Evidencia:</label>
            <input class="form-control" type="file" size=100 name="evidencia" id="evidencia" accept="image/jpeg,image/png" required>
        </div>
        `);
    });

    $("#INICIADA").click(function(){
        eliminarCampoEvidecia();
    });

    $("#PROCESO").click(function(){
        eliminarCampoEvidecia();
    });

    $.ajax({

        type:"POST",
        url:"../Controller/controllerActividad.php",
        data:{
            option:"obtener",
            codigo_actividad:$("#codigo_actividad").val()
        },
        dataType:'json',
        success:function(msg){
            msg.forEach(function(elemento){
                let codigo=$("#codigo").val(elemento["codigo_actividad"]);
                let nombre=$("#nombre").val(elemento["nombre_actividad"]);
                let observacion=$("#observacion").val(elemento["observacion"]);
                let informe=$("#informe").val(elemento["informe"]);
                let dep_receptor=$("#dep_receptor").val(elemento["dep_receptor"]);
                let dep_emisor=$("#dep_emisor").val(elemento["dep_emisor"]);
                let tipo=$("#tipo").val(elemento["nombre_tipo"]);
                let nom_responsable=$("#nom_responsable").val(elemento["nombre_personal"]);
                let ape_responsable=$("#ape_responsable").val(elemento["apellido_personal"]);
                let ced_responsable=$("#ced_responsable").val(elemento["cedula"]);
                let nom_atendido=$("#nom_atendido").val(elemento["nom_atendido"]);
                let ape_atendido=$("#ape_atendido").val(elemento["ape_atendido"]);
                let ced_atendido=$("#ced_atendido").val(elemento["ced_atendido"]);



                
            });
        },error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }

    });
});
function obtenerActividadPorCodigo(codigo){
    let resultado;
    $.ajax({
        async:false,
        type:"POST",
        url:"../Controller/controllerActividad.php",
        data:{
            option:"obtener",
            codigo_actividad:codigo
        },
        dataType:'json',
        success:function(msg){
            resultado=msg;
        },error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }

    });
    return resultado;
}
function eliminarCampoEvidecia(){
    $("#div_evidencia").remove();
}

function obtenerEstadosActividad(){
    $.ajax({
        async:false,
        type:"POST",
        url:"../Controller/controllerEstado_actividad.php",
        data:{
            option:"obtener",
            codigo_actividad:$("#codigo_actividad").val()
        },
        dataType:'json',
        success:function(msg){
            msg.forEach(function(elemento){
                let nombre_estado=elemento['nombre_estado_actividad'];
                let id_estado=elemento['id_estado_actividad'];
                
                let rc=obtenerActividadPorCodigo($("#codigo_actividad").val());
                estado_actividad_actual=rc[0]['nombre_estado_actividad'];

                if((nombre_estado!='CREADA')&&(nombre_estado!=estado_actividad_actual)){
                    $("#estado").append(`<option id='${nombre_estado}' value='${id_estado}'>${nombre_estado}</option>`);
                }
            });
        },error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }

    });
}