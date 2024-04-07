$(document).ready(function(){

    $("#select_completada").click(function(){
        $("#div_estado").before(`
        <div class="col-md-12 div_input_form" id="div_evidencia">
            <label class="col-md-12 form-label">Evidencia:</label>
            <input class="form-control" type="file" size=100 name="evidencia" id="evidencia" required>
        </div>
        `);
    });

    $("#select_suspendida").click(function(){
        eliminarEvidenciaCampo();
    });

    $("#select_proceso").click(function(){
        eliminarEvidenciaCampo();
    });

    $.ajax({

        type:"POST",
        url:"../Controller/controllerActividad.php",
        data:`option=buscarId&data_busq=${$("#id").val()}`,
        dataType:'json',
        success:function(msg){
            msg.forEach(function(elemento){
                let codigo=$("#codigo").val(elemento["codigo"]);
                let nombre=$("#nombre").val(elemento["nombre"]);
                let observacion=$("#observacion").val(elemento["observacion"]);
                let informe=$("#informe").val(elemento["informe"]);
                let dep_receptor=$("#dep_receptor").val(elemento["dep_receptor"]);
                let dep_emisor=$("#dep_emisor").val(elemento["dep_emisor"]);
                let tipo=$("#tipo").val(elemento["nombre_tipo"]);
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

function eliminarEvidenciaCampo(){
    $("#div_evidencia").remove();
}