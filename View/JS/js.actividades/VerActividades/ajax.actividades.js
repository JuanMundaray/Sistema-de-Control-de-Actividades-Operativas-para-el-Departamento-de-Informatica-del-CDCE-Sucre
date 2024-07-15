import "./Modals/EditarActividad.js"
import "./Modals/EliminarActividad.js"
import "./Modals/SeguimientoActividad.js"
import "./Modals/VerDetallesActividad.js"
import {RellenarTablaActividades, paginacion} from "./DibujarTabla/DibujarTabla.js"


$(document).ready(function(){
    getActividades();

    window.tipo_usuario_sesion=$('#tipo_usuario_sesion').val();
    obtenerEstadosActividad();

    $("#data_busq_nombre").on('input',function(){
        getActividades();
    });

    $("#aplicar_filtro").click(function(){ 
        //Funcion ajax para buscar una actividad por su codigo
        getActividades();
    });
    
    $("#num_resultados option").click(function(){ 
        //Funcion ajax para buscar una actividad por su codigo
        getActividades();
    });
});

window.getActividades=function(pagina=1){
    let num_resultados=$("#num_resultados").val();
    let codigo_actividad=$("#data_busq_codigo").val();
    let nombre_actividad=$("#data_busq_nombre").val();
    let fecha_registro=$("#data_busq_fecha").val();
    let estado_actividad=$("#estado_actividad").val();
    let day=$("#day").val();
    let month=$("#month").val();
    let year=$("#year").val();
    $.ajax({
        async:false,
        type:"POST",
        url:"../Controller/controllerActividad.php",
        data:{
            option:'obtener',
            pagina:pagina,
            num_resultados:num_resultados,
            codigo_actividad:codigo_actividad,
            nombre_actividad:nombre_actividad,
            fecha_registro:fecha_registro,
            estado_actividad:estado_actividad,
            day:day,
            month:month,
            year:year
        },
        dataType:'json',
        success:function(msg){
            if(msg==""){
                $("#toastSinResultados").toast("show");
            }

            RellenarTablaActividades(msg);
            paginacion(num_resultados);
            
        },error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }
    });
}

function obtenerEstadosActividad(){
    $.ajax({
        async:false,
        type:"POST",
        url:"../Controller/controllerEstado_actividad.php",
        data:{
            option:"obtener"
        },
        dataType:'json',
        success:function(msg){
            msg.forEach(function(elemento){
                let nombre_estado=elemento['nombre_estado_actividad'];
                let id_estado=elemento['id_estado_actividad'];
                $("#estado_actividad").append(`<option value='${id_estado}'>${nombre_estado}</option>`);
            });
        },error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }

    });
}