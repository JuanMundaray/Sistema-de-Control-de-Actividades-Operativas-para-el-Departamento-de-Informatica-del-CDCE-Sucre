$(document).ready(function(){
        
    getRegistrosModificacion();//Se Dibujan todas las actividades registradas en la tabla de actividades
});

function getRegistrosModificacion(pagina=1){

    let codigo_actividad=$("#codigo_actividad").val();
    let num_resultados=5;

    $.ajax({
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

function RellenarTablaActividades(msg){
    
    function estilo_btn(elemento){
        if(elemento=="INICIADA"){
            var btn_estilo="btn-primary";
        }if(elemento=="PROCESO"){
            var btn_estilo="btn-warning";
        }if(elemento=="COMPLETADA"){
            var btn_estilo="btn-success";
        }
        if(elemento=="SUSPENDIDA"){
            var btn_estilo="btn-danger";
        }
        return btn_estilo;
    }

    let tabla=$("#tabla_actividades_registro_modificacion");
    tabla.empty();
    tabla.append(`<thead><tr>
            <th><label>Nombre de Actividad</label></th>
            <th><label>Fecha de Modificacion</label></th>
            <th><label>Hora de Modificacion</label></th>
            <th><label>Tipo de Actividad</label></th>
            <th><label>Estado de Modificacion</label></th>
            <th><label>Estado de Actual</label></th>
        </tr></thead>`);
    tabla.append('<tbody>');


    msg.forEach(function(elemento){
        let btn_estilo=estilo_btn(elemento['nombre_estado_actividad']);
        tabla.append(`
        <tr class='align-middle'>
            <td>${elemento['nombre_actividad']}</td>
            <td>${elemento['fecha_modificacion']}</td>
            <td>${elemento['hora_modificacion']}</td>
            <td>${elemento['nombre_tipo']}</td>
            <td>${elemento['estado_modificado']}</td>
            <td>${elemento['nombre_estado_actividad']}</td>
        </tr>`);
    tabla.append("</tbody>");
    });
}