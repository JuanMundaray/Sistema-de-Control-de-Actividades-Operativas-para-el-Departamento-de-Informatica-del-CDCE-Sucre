$(document).ready(function(){
    $.ajax({
        type:"POST",
        url:"../Controller/controllerActividad.php",
        data:{
            option:"obtener",
            codigo_actividad:$("#codigo_actividad").val()
        },
        dataType:'json',
        success:function(msg){
            console.log(msg);
            msg.forEach(function(elemento){
                let codigo=$("#codigo_actividad").append(elemento["codigo_actividad"]);
                let nombre=$("#nombre_actividad").append(elemento["nombre_actividad"]);
                let dep_receptor=$("#dep_receptor").append(elemento["dep_receptor"]);
                let dep_emisor=$("#dep_emisor").append(elemento["dep_receptor"]);
                let tipo=$("#tipo").append(elemento["nombre_tipo"]);

                //Agrega informe,observacion o evidencia solo si no es nulo o esta vacio

                let observacion=elemento["observacion"];
                let informe=elemento["informe"];

                if(elemento["observacion"]!=""){
                    let div_observacion=$("#div_observacion");
                    div_observacion.append('<label class="text-break col-md-12 form-label"><strong >Observacion:</strong></label>');
                    div_observacion.append(`<p style="text-align: justify;" id="observacion">${observacion}</p>`);
                }

                if((elemento["informe"]!="")){
                    let div_informe=$("#div_observacion");
                    div_informe.append('<label class="col-md-12 form-label"><strong>Informe:</strong></label>');
                    div_informe.append(`<p style="text-align: justify;" id="informe">${informe}</p>`);
                }

                if((elemento["evidencia"]!="")&&(elemento["evidencia"]!=null)){
                    let div_evidencia=$("#evidencia");
                    div_evidencia.append('<label class="col-md-12 form-label"><strong >Evidencia:</strong></label>');
                    div_evidencia.append(`<img id="imagen_evidencia" src='../../sca_cdce/uploads/${elemento["evidencia"]}' width="400px" height="300px">`);
                }
                let estado=$("#estado_actividad").append(elemento["nombre_estado_actividad"]);
                let nom_responsable=$("#nom_responsable").append(`${elemento["nombre_personal"]} ${elemento["apellido_personal"]}`);
                let ced_responsable=$("#ced_responsable").append(elemento["cedula"]);
                let nom_atendido=$("#nom_atendido").append(`${elemento["nom_atendido"]} ${elemento["ape_atendido"]}`);
                let ced_atendido=$("#ced_atendido").append(elemento["ced_atendido"]);

                
            });
        },error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }
    })
});