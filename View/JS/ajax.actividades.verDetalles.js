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
                let observacion=$("#observacion").append(elemento["observacion"]);
                let informe=$("#informe").append(elemento["informe"]);
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