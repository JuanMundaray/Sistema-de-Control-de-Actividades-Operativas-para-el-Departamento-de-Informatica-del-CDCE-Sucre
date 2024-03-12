$(document).ready(function(){
        $.ajax({

            type:"POST",
            url:"../controller/controllerActividad.php",
            data:`option=buscarId&data_busq=${$("#id").val()}`,
            dataType:'json',
            success:function(msg){
                msg.forEach(function(elemento){
                    let codigo=$("#codigo").val(elemento["codigo"]);
                    let nombre=$("#nombre").val(elemento["nombre"]);
                    let observacion=$("#observacion").val(elemento["observacion"]);
                    let dep_receptor=$("#dep_receptor").val(elemento["dep_receptor"]);
                    let dep_emisor=$("#dep_emisor").val(elemento["dep_emisor"]);
                    let tipo=$("#tipo").val(elemento["tipo"]);
                    let nom_responsable=$("#nom_responsable").val(elemento["nom_responsable"]);
                    let ape_responsable=$("#ape_responsable").val(elemento["ape_responsable"]);
                    let ced_responsable=$("#ced_responsable").val(elemento["ced_responsable"]);
                    let nom_atendido=$("#nom_atendido").val(elemento["nom_atendido"]);
                    let ape_atendido=$("#ape_atendido").val(elemento["ape_atendido"]);
                    let ced_atendido=$("#ced_atendido").val(elemento["ced_atendido"]);

                    
                });
            },error:function(jqXHR,textStatus,errorThrown){
                alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
            }

        });
    });