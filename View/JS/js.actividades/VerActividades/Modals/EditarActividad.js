window.EditarActividad=function(codigo_actividad){

    $("#ModalEditarActividad").modal("show");
    $("#cancel").on("click",()=>{
        let mytoast = document.querySelector("#intento-actividad");
        let Toast = new bootstrap.Toast(mytoast);
        Toast.show();
    });

    obtenerEstadosActividad(codigo_actividad);

    $("#edit_estado #COMPLETADA").click(function(){
        $("#div_estado").before(`
        <div class="col-md-12 div_input_form" id="div_evidencia">
            <label class="col-md-12 form-label">Evidencia:</label>
            <input class="form-control" type="file" size=100 name="evidencia" id="evidencia" accept="image/jpeg,image/png" required>
        </div>
        `);
    });

    $("#edit_estado #INICIADA").click(function(){
    eliminarCampoEvidecia();
    });

    $("#edit_estado #PROCESO").click(function(){
    eliminarCampoEvidecia();
    });

    $.ajax({

        type:"POST",
        url:"../Controller/controllerActividad.php",
        data:{
            option:"obtener",
            codigo_actividad:codigo_actividad
        },
        
        dataType:'json',
        success:function(msg){
            msg.forEach(function(elemento){
                let codigo=$("#edit_codigo").val(elemento["codigo_actividad"]);
                let nombre=$("#edit_nombre").val(elemento["nombre_actividad"]);
                let observacion=$("#edit_observacion").val(elemento["observacion"]);
                let informe=$("#edit_informe").val(elemento["informe"]);
                let dep_receptor=$("#edit_dep_receptor").val(elemento["dep_receptor"]);
                let dep_emisor=$("#edit_dep_emisor").val(elemento["dep_emisor"]);
                let tipo=$("#edit_tipo").val(elemento["nombre_tipo"]);
                let nom_responsable=$("#edit_nom_responsable").val(elemento["nombre_personal"]);
                let ape_responsable=$("#edit_ape_responsable").val(elemento["apellido_personal"]);
                let ced_responsable=$("#edit_ced_responsable").val(elemento["cedula"]);
                let nom_atendido=$("#edit_nom_atendido").val(elemento["nom_atendido"]);
                let ape_atendido=$("#edit_ape_atendido").val(elemento["ape_atendido"]);
                let ced_atendido=$("#edit_ced_atendido").val(elemento["ced_atendido"]);
                let m=3;
                sessionStorage.setItem('mensaje',m);


                
            });
        },error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }

    });
}
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

function obtenerEstadosActividad(codigo_actividad){
    $.ajax({
        async:false,
        type:"POST",
        url:"../Controller/controllerEstado_actividad.php",
        data:{
            option:"obtener",
            codigo_actividad:codigo_actividad
        },
        dataType:'json',
        success:function(msg){
            msg.forEach(function(elemento){
                let nombre_estado=elemento['nombre_estado_actividad'];
                let id_estado=elemento['id_estado_actividad'];
                
                let rc=obtenerActividadPorCodigo(codigo_actividad);
                let estado_actividad_actual=rc[0]['nombre_estado_actividad'];

                if((nombre_estado!='INICIADA' && nombre_estado!='CREADA')&&(nombre_estado!=estado_actividad_actual)){
                    $("#edit_estado").append(`<option id='${nombre_estado}' value='${id_estado}'>${nombre_estado}</option>`);
                }
            });
        },error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }

    });
}