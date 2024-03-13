$(document).ready(function(){
        
    getActividades();//Se Dibujan todas las actividades registradas en la tabla de actividades
    filtrar_estado();

});


function filtrar_estado(){//Esta funcion hace que las actividades aparezcan segun si se selecciono en cierto cuadro de select si quiere que se muestren las completadas o las que estan en proceso
    $("#filt_completadas").click(function(){
        alert("filt_completadas");  
    });
    $("#filt_proceso").click(function(){
        alert("filt_proceso");  
    });
    $("#filt_iniciada").click(function(){
        alert("filt_iniciada");  
    });
    $("#filt_suspendida").click(function(){
        alert("filt_suspendida");  
    });
    

}

function getActividades(){
    $.ajax({

        type:"POST",
        url:"../controller/controllerActividad.php",
        data:"option=ver",
        dataType:'json',
        success:function(msg){
            paginacion(msg);
            
            msg.forEach(function(elemento){
                if(elemento['estado']=="Iniciada"){
                    var btn_estilo="btn-primary";
                }if(elemento['estado']=="PROCESO"){
                    var btn_estilo="btn-warning";
                }if(elemento['estado']=="COMPLETADA"){
                    var btn_estilo="btn-success";
                }
                if(elemento['estado']=="SUSPENDIDA"){
                    var btn_estilo="btn-danger";
                }
    
                //Dibujar la Tabla de Actividades por medio del DOM de JavaScripts 
                let tabla=$("#tabla_actividades");
                tabla.append(`<tr>
                <td>${elemento['codigo']}</td>
                <td>${elemento['fecha']}</td>
                <td>${elemento['nombre']}</td>
                <td>${elemento['nombre_tipo']}</td>
                <td>${elemento['dep_receptor']}</td>
                <td>${elemento['dep_emisor']}</td>
                <td>${elemento['nom_responsable']} ${elemento['ape_responsable']}</td>
                <td>${elemento['ced_responsable']}</td>
                <td>${elemento['nom_atendido']+" "+elemento['ape_atendido']}</td>
                <td>${elemento['ced_atendido']}</td>
                <td><button class="btn ${btn_estilo}">${elemento['estado']}</button></td>
                    
                <td>
                    <a href="editar-actividad.php?id=${elemento['id']}"><button class="btn btn-outline-secondary">Modificar</button></a>
                </td>

                <td><button class="btn btn-outline-danger" onclick="eliminarActividad(${elemento['id']})">Eliminar</button></td>
                
                <td>
                    <a href="detalles-actividad.php?id=${elemento['id']}"><button class="btn btn-outline-info">Ver Detalles</button></a>
                </td></tr>
                `);
            });
        }

    });
}

function eliminarActividad(id){
    let ok=confirm("¿Seguro que desea eliminar esta actividad?");
    if(ok){
        $.ajax({
            type:"POST",
            url:"../controller/controllerActividad.php",
            data:"option=eliminar&id="+id,
            dataType:'json',
            success:function(msg){
                alert("Actividad Eliminada Exitosamente");
            }
    });
    location.reload();
    }
}

function paginacion(fil_query){//Esta funcion hace posible la paginacion de los registros de una consulta
    //fil_query se refiere al arreglo que contiene las filas de la consulta sql
    let contador=0;
    let num_paginas=(fil_query.length)/2;
    for(i=1;i<=num_paginas;i++){
        setNumeroPaginas(i);
    }

    function setNumeroPaginas(numero){
        $("#num_paginas").append(
            `<li class="page-item"><a class="page-link" href="${numero}">${numero}</a></li>`
        )
    }
}