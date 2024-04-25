$(document).ready(function(){
        
    getHistorialActividades();//Se Dibujan todas las actividades registradas en la tabla de actividades
    tipo_usuario_sesion=$('#tipo_usuario_sesion').val();
    
    $("#buscar_actividad_boton").click(function(){ 
        //Funcion ajax para buscar una actividad por su codigo
        getHistorialActividades();
    });
    $("#buscar_actividad_boton").click(function(){ 
        //Funcion ajax para buscar una actividad por su codigo
        getHistorialActividades();
    });

});

function getHistorialActividades(pagina=1){
    let num_resultados=$("#num_resultados").val();
    let codigo_actividad=$("#data_busq_codigo").val();
    let nombre_actividad=$("#data_busq_nombre").val();
    let fecha_registro=$("#data_busq_fecha").val();
    let estado_actividad=$("#estado_actividad").val();

    $.ajax({
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
            todas:true
        },
        dataType:'json',
        success:function(msg){
            if(msg==""){
                alert('Sin Resultados');
            }
            RellenarTablaActividades(msg);
            paginacion(num_resultados);
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
        if(elemento=="ELIMINADA"){
            var btn_estilo="btn-danger";
        }
        return btn_estilo;
    }

    let tabla=$("#tabla_historial_actividades");
    tabla.empty();
    tabla.append(`<thead><tr>
            <th><label>Fecha de Registro</label></th>
            <th><label>Actividad</label></th>
            <th><label>Tipo de Actividad</label></th>
            <th><label>Departamento Receptor</label></th>
            <th><label>Departamento Emisor</label></th>
            <th><label>Nombre del Responsable</label></th>
            <th><label>Cedula del Responsable</label></th>
            <th><label>Funcionario Atendido</label></th>
            <th><label>Cedula del Funcionario Atendido</label></th>
            <th><label>Estado</label></th>
        </tr></thead>`);
    tabla.append('<tbody>');

    msg.forEach(function(elemento){
        //Estas son los botones de accion que estaran disponibles segun si la actividad a sido completada o no

        let btn_estilo=estilo_btn(elemento['estado_actividad']);
        tabla.append(`<tr class='align-middle'>
        <td>${elemento['fecha_registro']}</td>
        <td>${elemento['nombre_actividad']}</td>
        <td>${elemento['nombre_tipo']}</td>
        <td>${elemento['dep_receptor']}</td>
        <td>${elemento['dep_emisor']}</td>
        <td>${elemento['nombre_personal']} ${elemento['apellido_personal']}</td>
        <td>${elemento['cedula']}</td> 
        <td>${elemento['nom_atendido']+" "+elemento['ape_atendido']}</td>
        <td>${elemento['ced_atendido']}</td>
        <td><button class="btn ${btn_estilo} tamano_boton">${elemento['estado_actividad']}</button></td>`);
    });
    tabla.append("</tbody>");
}

function paginacion(num_resultados){//Esta funcion hace apararecerlos botones para paginar los registros obtenidos

    let codigo_actividad=$("#data_busq_codigo").val();
    let nombre_actividad=$("#data_busq_nombre").val();
    let fecha_registro=$("#data_busq_fecha").val();
    let estado_actividad=$("#estado_actividad").val();
    let num_filas;

    $.ajax({ 
        async:false,
        type:"POST",
        url:"../Controller/controllerActividad.php",
        data:{
            option:'contarRegistros',
            codigo_actividad:codigo_actividad,
            nombre_actividad:nombre_actividad,
            fecha_registro:fecha_registro,
            estado_actividad:estado_actividad,
            todas:true
        },
        dataType:'json',
        success:function(msg){
            num_filas=msg
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }

    });

    let num_paginas=Math.ceil((num_filas)/(num_resultados));
    $("#num_paginas").empty();

    for(let i=1;i<=num_paginas;i++){
        setNumeroPaginas(i);
    }

    function setNumeroPaginas(numero){
        $("#num_paginas").append(
            `<li class="page-item"><a class="page-link" href='#tabla_actividades' onclick="getHistorialActividades(${numero})"'>${numero}</a></li>`
        )
    }
}
function eliminarActividad(codigo_actividad){
    let ok=confirm("¿Seguro que desea eliminar esta actividad?");
    if(ok){
        $.ajax({
            type:"POST",
            url:"../Controller/controllerActividad.php",
            data:"option=eliminar&codigo_actividad="+codigo_actividad,
            dataType:'json',
            success:function(msg){
                alert("Actividad Eliminada Exitosamente");
                location.reload();
            }
    });
    }
}