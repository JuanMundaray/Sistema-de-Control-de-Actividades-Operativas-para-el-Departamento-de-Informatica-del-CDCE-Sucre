$(document).ready(function(){
    $("#filt_proceso").click(function(){
        let estado=$("#estado_filt").val();
        buscarActividades(estado,"estado");
    });

    $("#filt_iniciada").click(function(){
        let estado=$("#estado_filt").val();
        buscarActividades(estado,"estado");
    });
    $("#filt_suspendida").click(function(){
        let estado=$("#estado_filt").val();
        buscarActividades(estado,"estado");
    });
    $("#filt_completada").click(function(){ 
        let estado=$("#estado_filt").val();
        buscarActividades(estado,"estado");
    });
    
    $("#buscar_act").click(function(){ 
        //Funcion ajax para buscar una actividad por su nombre
        let data=$("#data_busq").val();
        buscarActividades(data,"nombre");

    });

    $("#buscar_act_fecha").click(function(){ 
        //Funcion ajax para buscar una actividad por su fecha de registro
        let data=$("#data_busq_fecha").val();
        buscarActividades(data,"fecha",false);
    });
    $("#buscar_act_codigo").click(function(){ 
        //Funcion ajax para buscar una actividad por su codigo
        let data=$("#data_busq_codigo").val();
        buscarActividades(data,"codigo");
    });
    
});

function eliminarActividad(id){
    let ok=confirm("¿Seguro que desea eliminar esta actividad?");
    if(ok){
        $.ajax({
            type:"POST",
            url:"../Controller/controllerActividad.php",
            data:"option=eliminar&id="+id,
            dataType:'json',
            success:function(msg){
                alert("Actividad Eliminada Exitosamente");
            }
    });
    location.reload();
    }
}

function buscarActividades(data_busq,columna,useLIKE=true,pagina=1){

    let num_resultados=$("#num_resultados").val();
    $.ajax({
        type:"POST",
        url:"../Controller/controllerActividad.php",
        data:{option:"buscar",data_busq:data_busq,columna:columna,
        num_resultados:num_resultados,
        pagina:pagina,useLIKE:useLIKE},
        dataType:'json',
        success:function(msg){

            RellenarTablaActividades(msg);
            paginacion(num_resultados,data_busq,columna,useLIKE);

        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("Sin Resultados");
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

    let tabla=$("#tabla_actividades");
    tabla.empty();
    tabla.append(`<tbody><tr>
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
        <th><label>Accion</label></th>
    </tr>`);
    msg.forEach(function(elemento){
        let accion;

        if(elemento['estado']=='COMPLETADA'){
            accion=`
            <li><a class="dropdown-item" href="detalles-actividad.php?id=${elemento['id']}">Ver Detalles</a></li>`
        }
        else{
            accion=`<li><a class="dropdown-item" href="editar-actividad.php?id=${elemento['id']}">Modificar</a></li>

            <li><button class="dropdown-item" onclick="eliminarActividad(${elemento['id']})">Eliminar</button></li>

            <li><a class="dropdown-item" href="detalles-actividad.php?id=${elemento['id']}">Ver Detalles</a></li>`
        }

        let btn_estilo=estilo_btn(elemento['estado']);
        tabla.append(`<tr>
        <td>${elemento['fecha']}</td>
        <td>${elemento['nombre']}</td>
        <td>${elemento['nombre_tipo']}</td>
        <td>${elemento['dep_receptor']}</td>
        <td>${elemento['dep_emisor']}</td>
        <td>${elemento['nom_responsable']} ${elemento['ape_responsable']}</td>
        <td>${elemento['ced_responsable']}</td> 
        <td>${elemento['nom_atendido']+" "+elemento['ape_atendido']}</td>
        <td>${elemento['ced_atendido']}</td>
        <td><button class="btn ${btn_estilo} tamano_boton">${elemento['estado']}</button></td>
        <td>
            <div class="btn-group">
                <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                    Seleccione...
                </button>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    ${accion}    
                </ul>
            </div>
        </td>
        </tr>`);
    });
    tabla.append("</tbody>");
}

function paginacion(num_resultados,data_busq=false,columna=false,useLIKE=true){
    //Esta funcion hace apararecerlos botones para paginar los registros obtenidos

    let num_filas;

    if(data_busq!=false){
        data_ajax={option:'contarRegistros',data_busq:data_busq,columna:columna,useLIKE:useLIKE};
    }
    else{
        data_ajax={option:'contarRegistros'};
    }

    $.ajax({
        async:false,
        type:"POST",
        url:"../Controller/controllerActividad.php",
        data:data_ajax,
        dataType:'json',
        success:function(msg){
            num_filas=msg;
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }

    });

    let num_paginas=Math.ceil((num_filas)/(num_resultados));
    $("#num_paginas").empty();

    if(data_busq!=false){
        for(let i=1;i<=num_paginas;i++){
            setNumeroPaginas(i,data_busq,columna,useLIKE);
        }
    }
    else{
        for(let i=1;i<=num_paginas;i++){
            setNumeroPaginas(i);
        }
    }
    
    function setNumeroPaginas(numero,data_busq=false,columna=false,useLIKE=true){

        if(data_busq!=false){
            $("#num_paginas").append(
                `<li class="page-item">
                    <a class="page-link" href='#' 
                    onclick="buscarActividades('${data_busq}','${columna}',${useLIKE},${numero})"'>
                        ${numero}
                    </a>
                </li>`
            )
        }
        else{
            $("#num_paginas").append(
                `<li class="page-item"><a class="page-link" href='#' onclick="getActividades(${numero})"'>${numero}</a></li>`
            )
        }
    }
}