$(document).ready(function(){
        
    getActividades();//Se Dibujan todas las actividades registradas en la tabla de actividades
    tipo_usuario_sesion=$('#tipo_usuario_sesion').val();
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

function getActividades(pagina=1){

    let num_resultados=$('#num_resultados').val();
    let codigo_actividad=$("#data_busq_codigo").val();
    let nombre_actividad=$("#data_busq_nombre").val();
    let fecha_registro=$("#data_busq_fecha").val();
    let estado_actividad=$("#estado_actividad").val();
    let id_usuario_responsable=$("#id_usuario_sesion").val();
    let day=$("#day").val();
    let year=$("#year").val();
    let month=$("#month").val();


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
            id_usuario_responsable:id_usuario_responsable,
            day:day,
            month:month,
            year:year
        },
        dataType:'json',
        success:function(msg){
            if(msg==""){
                alert('Sin Resultados');
            }
            RellenarTablaActividades(msg);
            paginacion(num_resultados);
            
        },error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }

    });
}

function RellenarTablaActividades(msg){
    
    function bg_estilo(elemento){
        if(elemento=="INICIADA"){
            var bg_estilo="bg-primary";
        }
        if(elemento=="CREADA"){
            var bg_estilo="bg-primary";
        }
        if(elemento=="PROCESO"){
            var bg_estilo="bg-warning";
        }
        if(elemento=="COMPLETADA"){
            var bg_estilo="bg-success";
        }
        if(elemento=="SUSPENDIDA"){
            var bg_estilo="bg-danger";
        }
        return bg_estilo;
    }

    let tabla=$("#tabla_actividades");
    tabla.empty();
    tabla.append(`<thead><tr>
            <th><label>Fecha de Registro</label></th>
            <th><label>Accion</label></th>
            <th><label>Actividad</label></th>
            <th><label>Tipo de Actividad</label></th>
            <th><label>Departamento Receptor</label></th>
            <th><label>Estado</label></th>
        </tr></thead>`);


    tabla.append("<tbody>");
    msg.forEach(function(elemento){
        //Estas son los botones de accion que estaran disponibles segun si la actividad a sido completada o no
        let accion;

        if(elemento['nombre_estado_actividad']=='COMPLETADA'){
            accion=`
            <li><a class="dropdown-item" href="actividades-detalles.php?codigo_actividad=${elemento['codigo_actividad']}">Ver Detalles</a></li>

            <li><a class="dropdown-item" href="actividades-seguimiento.php?codigo_actividad=${elemento['codigo_actividad']}">Seguimiento de Actividad</a></li>`
        }
        else{
            accion=`<li><a class="dropdown-item" href="actividades-editar.php?codigo_actividad=${elemento['codigo_actividad']}">Modificar</a></li>

            <li><button class="dropdown-item" onclick="eliminarActividad('${elemento['codigo_actividad']}')">Eliminar</button></li>

            <li><a class="dropdown-item" href="actividades-detalles.php?codigo_actividad=${elemento['codigo_actividad']}">Ver Detalles</a></li>

            <li><a class="dropdown-item" href="actividades-seguimiento.php?codigo_actividad=${elemento['codigo_actividad']}">Seguimiento de Actividad</a></li>`
        }

        let bg_estilo_bage=bg_estilo(elemento['nombre_estado_actividad']);

        tabla.append(`<tr class='align-middle'>
        <td>${elemento['fecha_registro']}</td>
        <td>
            <div class="btn-group">
                <button type="button" class="btn btn-success rounded-pill dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                    Seleccione...
                </button>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    ${accion}    
                </ul>
            </div>
        </td>
        <td>${elemento['nombre_actividad']}</td>
        <td>${elemento['nombre_tipo']}</td>
        <td>${elemento['dep_receptor']}</td>
        <td><h5><span class="badge rounded-pill  ${bg_estilo_bage}" style="width: 120px;">${elemento['nombre_estado_actividad']}</span><h5></td>
        </tr>`);
    });
    tabla.append("</tbody>");
}

function paginacion(num_resultados){//Esta funcion hace apararecerlos botones para paginar los registros obtenidos

    
    let codigo_actividad=$("#data_busq_codigo").val();
    let nombre_actividad=$("#data_busq_nombre").val();
    let fecha_registro=$("#data_busq_fecha").val();
    let estado_actividad=$("#estado_actividad").val();
    let id_usuario_responsable=$("#id_usuario_sesion").val();
    let num_filas;
    let day=$("#day").val();
    let year=$("#year").val();
    let month=$("#month").val();

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
            id_usuario_responsable:id_usuario_responsable,
            day:day,
            month:month,
            year:year
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
            `<li class="page-item"><a class="page-link" href='#tabla_actividades' onclick="getActividades(${numero})"'>${numero}</a></li>`
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
                $("#estado_actividad").append(`<option id='${nombre_estado}' value='${id_estado}'>${nombre_estado}</option>`);
            });
        },error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }

    });
}