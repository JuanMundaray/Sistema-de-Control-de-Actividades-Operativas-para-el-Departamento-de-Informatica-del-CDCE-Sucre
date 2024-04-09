$(document).ready(function(){
        
    getHistorialActividades();//Se Dibujan todas las actividades registradas en la tabla de actividades

});

function getHistorialActividades(pagina=1){

    let num_resultados=$("#num_resultados").val();

    $.ajax({
        type:"POST",
        url:"../Controller/controllerHistorialActividades.php",
        data:{option:'obtener',pagina:pagina,num_resultados:num_resultados},
        dataType:'json',
        success:function(msg){
            RellenarTablaHistorialActividades(msg);
            paginacion(num_resultados);
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }

    });
}

function paginacion(num_resultados){//Esta funcion hace apararecerlos botones para paginar los registros obtenidos

    let num_filas;
    $.ajax({
        async:false,
        type:"POST",
        url:"../Controller/controllerHistorialActividades.php",
        data:{option:'contarRegistros'},
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
            `<li class="page-item"><a class="page-link" href='#' onclick="getHistorialActividades(${numero})"'>${numero}</a></li>`
        )
    }
}

function RellenarTablaHistorialActividades(msg){
    
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

    let tabla=$("#tabla_historial_actividades");
    tabla.empty();
    tabla.append(`<tbody><tr>
        <th><label>Código de Actividad</label></th>
        <th><label>Id de Actividad</label></th>
        <th><label>Actividad</label></th>
        <th><label>Fecha de Registro</label></th>
        <th><label>Tipo de Actividad</label></th>
        <th><label>Departamento Receptor</label></th>
        <th><label>Departamento Emisor</label></th>
        <th><label>Nombre del Responsable</label></th>
        <th><label>Cedula del Responsable</label></th>
        <th><label>Funcionario Atendido</label></th>
        <th><label>Cedula del Funcionario Atendido</label></th>
        <th><label>Estado</label></th>
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
        <td>${elemento['codigo']}</td>
        <td>${elemento['id']}</td>
        <td>${elemento['nombre']}</td>
        <td>${elemento['fecha']}</td>
        <td>${elemento['nombre_tipo']}</td>
        <td>${elemento['dep_receptor']}</td>
        <td>${elemento['dep_emisor']}</td>
        <td>${elemento['nom_responsable']} ${elemento['ape_responsable']}</td>
        <td>${elemento['ced_responsable']}</td> 
        <td>${elemento['nom_atendido']+" "+elemento['ape_atendido']}</td>
        <td>${elemento['ced_atendido']}</td>
        <td><button class="btn ${btn_estilo} tamano_boton">${elemento['estado']}</button></td>
        </tr>`);
    });
    tabla.append("</tbody>");
}