window.MostrarDetalles=function(codigo){
    $.ajax({
        type:"POST",
        url:"../Controller/controllerActividad.php",
        data:{
            option:"obtener",
            codigo_actividad:codigo
        },
        dataType:'json',
        success:function(msg){
            msg.forEach(function(elemento){
                $("#exampleModal").modal("show");
                let codigo=$("#p_codigo_actividad").text(elemento["codigo_actividad"]);
                $("#input_codigo_actividad").val(elemento["codigo_actividad"]);
                let nombre=$("#p_nombre_actividad").text(elemento["nombre_actividad"]);
                let fecha_inicio=$("#p_fecha_inicio").text(elemento["fecha_inicio"]);
                let dep_receptor=$("#p_dep_receptor").text(elemento["dep_receptor"]);
                let dep_emisor=$("#p_dep_emisor").text(elemento["dep_receptor"]);
                let tipo=$("#p_tipo").text(elemento["nombre_tipo"]);
                let estado=$("#p_estado_actividad").text(elemento["nombre_estado_actividad"]);
                let nom_responsable=$("#p_nom_responsable").text(`${elemento["nombre_personal"]} ${elemento["apellido_personal"]}`);
                let ced_responsable=$("#p_ced_responsable").text(elemento["cedula"]);
                let nom_atendido=$("#p_nom_atendido").text(`${elemento["nom_atendido"]} ${elemento["ape_atendido"]}`);
                let ced_atendido=$("#p_ced_atendido").text(elemento["ced_atendido"]);

                //Agrega informe,observacion o evidencia solo si no es nulo o esta vacio

                let observacion=elemento["observacion"];
                let informe=elemento["informe"];

                if(elemento["observacion"]!=""){
                    let div_observacion=$("#p_div_observacion");
                    div_evidencia.empty();
                    div_observacion.append('<label class="text-break col-md-12 form-label"><strong >Observacion:</strong></label>');
                    div_observacion.append(`<p style="text-align: justify;" id="observacion">${observacion}</p>`);
                }

                if((elemento["informe"]!="")){
                    let div_informe=$("#p_div_observacion");
                    div_evidencia.empty();
                    div_informe.append('<label class="col-md-12 form-label"><strong>Informe:</strong></label>');
                    div_informe.append(`<p style="text-align: justify;" id="informe">${informe}</p>`);
                }

                if((elemento["evidencia"]!="")&&(elemento["evidencia"]!=null)){
                    let div_evidencia=$("#p_evidencia");
                    div_evidencia.empty();
                    div_evidencia.append('<label class="col-md-12 form-label"><strong >Evidencia:</strong></label>');
                    div_evidencia.append(`<img id="imagen_evidencia" src='../../sca_cdce/uploads/${elemento["evidencia"]}' width="400px" height="300px">`);
                }

            });
        },error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }
    })
}