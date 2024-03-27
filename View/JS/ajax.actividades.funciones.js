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
    
    $("#buscar_act").click(function(){ //Funcion ajax para buscar una actividad por su nombre o codigo
        let data=$("#data_busq").val();
        buscarActividades(data,"nombre");

    });

    $("#buscar_act_fecha").click(function(){
        let data=$("#data_busq_fecha").val();
        buscarActividades(data,"fecha");
    });
    $("#buscar_act_codigo").click(function(){
        let data=$("#data_busq_codigo").val();
        buscarActividades(data,"codigo");
    });
    
    $("#modificar_actividad").click(function(){//Boton de Modificar Actividad-------------------------------
        let ok=confirm("¿Esta seguro de Modificar esta actividad?");
        if(ok){
                let id=$("#id").val();
                let observacion=$("#observacion").val();
                let informe=$("#informe").val();
                let estado=$("#estado").val();
                $.ajax({
                    type:"POST",
                    url:"../Controller/controllerActividad.php",
                    data:`option=modificar&id=${id}
                    &observacion=${observacion}
                    &informe=${informe}
                    &estado=${estado}`,
                    dataType:'text',
                    success:function(msg){
                            alert("Actividad Modificada");
                            location.href="actividades-registradas.php";
                    },
                    error:function(jqXHR,textStatus,errorThrown){
                        alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
                    }
                });
            }
        else{
            alert("Actividad No Modificada","Notificacion");
            location.href="actividades-registradas.php";
        }
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

function buscarActividades(data_busq,parametro_busq,pagina=1){

    let num_resultados=$("#num_resultados").val();
    $.ajax({
        type:"POST",
        url:"../Controller/controllerActividad.php",
        data:{option:"buscar",data_busq:data_busq,parametro_busq:parametro_busq,num_resultados:num_resultados,pagina:pagina},
        dataType:'json',
        success:function(msg){

            RellenarTablaActividades(msg);
            paginacionBusqueda(num_resultados,data_busq,parametro_busq);

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
        <th colspan="3"><label>Accion</label></th>
    </tr>`);
    msg.forEach(function(elemento){ 
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
            <a href="editar-actividad.php?id=${elemento['id']}"><button class="btn btn-outline-secondary">Modificar</button></a>
        </td>

        <td><button class="btn btn-outline-danger" onclick="eliminarActividad(${elemento['id']})">Eliminar</button></td>

        <td><a href="detalles-actividad.php?id=${elemento['id']}"><button class="btn btn-outline-secondary">Ver Detalles</button></a></td></tr>`);
    });
    tabla.append("</tbody>");
}

function paginacionBusqueda(num_resultados,data_busq,parametro_busq){//Esta funcion hace apararecerlos botones para paginar los registros obtenidos

    let num_filas;
    $.ajax({
        async:false,
        type:"POST",
        url:"../Controller/controllerActividad.php",
        data:{option:'contarRegistros',data_busq:data_busq,parametro_busq:parametro_busq},
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
    for(let i=1;i<=num_paginas;i++){
        setNumeroPaginas(i);
    }
    
    function setNumeroPaginas(numero){
        $("#num_paginas").append(
            `<li class="page-item"><a class="page-link" href='#' onclick="buscarActividades('${data_busq}','${parametro_busq}',${numero})"'>${numero}</a></li>`
        )
    }
}