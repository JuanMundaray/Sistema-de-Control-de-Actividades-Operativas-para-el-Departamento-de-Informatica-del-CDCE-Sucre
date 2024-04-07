$(document).ready(function(){
    $.ajax({
        type:"POST",
        url:"../Controller/controllerActividad.php",
        data:`option=buscarId&data_busq=${$("#id").val()}`,
        dataType:'json',
        success:function(msg){
            console.log(msg);
            msg.forEach(function(elemento){
                let codigo=$("#codigo").append(elemento["codigo"]);
                let nombre=$("#nombre").append(elemento["nombre"]);
                let dep_receptor=$("#dep_receptor").append(elemento["dep_receptor"]);
                let dep_emisor=$("#dep_emisor").append(elemento["dep_receptor"]);
                let tipo=$("#tipo").append(elemento["nombre_tipo"]);

                //Agrega informe,observacion o evidencia solo si no es nulo o esta vacio
                if(elemento["observacion"]!=""){
                    let div_observacion=$("#div_observacion");
                    div_observacion.append('<label class="col-md-12 form-label"><strong >Observacion:</strong></label>');
                    div_observacion.append(`<p id="observacion">${elemento["observacion"]}</p>`);
                }

                if((elemento["informe"]!="")&&(elemento["informe"]!=null)){
                    let div_informe=$("#div_informe");
                    div_informe.append('<label class="col-md-12 form-label"><strong >Informe:</strong></label>');
                    div_informe.append(`<p id="informe">${elemento["informe"]}</p>`);
                }
                if((elemento["evidencia"]!="")&&(elemento["evidencia"]!=null)){
                console.log(elemento['evidencia']);
                    let div_evidencia=$("#evidencia");
                    div_evidencia.append('<label class="col-md-12 form-label"><strong >Evidencia:</strong></label>');
                    div_evidencia.append(`<img id="imagen_evidencia" src='../../intranet/uploads_sca_cdce/${elemento["evidencia"]}' width="400px" height="300px">`);
                }
                let estado=$("#estado").append(elemento["estado"]);
                let nom_responsable=$("#nom_responsable").append(`${elemento["nom_responsable"]} ${elemento["ape_responsable"]}`);
                let ced_responsable=$("#ced_responsable").append(elemento["ced_responsable"]);
                let nom_atendido=$("#nom_atendido").append(`${elemento["nom_atendido"]} ${elemento["ape_atendido"]}`);
                let ced_atendido=$("#ced_atendido").append(elemento["ced_atendido"]);

                
            });
        },error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }
    })
});