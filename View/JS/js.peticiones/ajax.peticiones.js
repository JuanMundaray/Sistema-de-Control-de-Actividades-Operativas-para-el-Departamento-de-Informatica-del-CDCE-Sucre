import "./modals/RechazarPeticion.js"
import "./modals/verDetallesPeticion.js"
$(document).ready(function(){
    obtenerDepartamentosSelect();
    getPeticiones();
    
    $("#data_busq_nombre").on('input',function(){ //Funcion ajax para buscar una actividad por su nombre o codigo
        getPeticiones();
    });
    
    $("#aplicar_filtro").click(function(){
        getPeticiones();
    });
    
    $("#num_resultados option").click(function(){ 
        //Funcion ajax para buscar una actividad por su codigo
        getPeticiones();
    });

});

window.getPeticiones=function(pagina=1){
    let num_resultados=$("#num_resultados").val();
    let nombre_peticion=$("#data_busq_nombre").val();
    let fecha_registro=$("#data_busq_fecha").val();
    let id_usuario=$("#id_usuario_sesion").val();
    let departamento_peticion=$("#departamento_peticion").val();
    let day=$("#day").val();
    let month=$("#month").val();
    let year=$("#year").val();
    $.ajax({
        type:"POST",
        url:"../Controller/controllerPeticion.php",
        data:{
            option:'obtener',
            pagina:pagina,
            num_resultados:num_resultados,
            nombre_peticion:nombre_peticion,
            estado_peticion:1,
            fecha_registro:fecha_registro,
            id_usuario:id_usuario,
            departamento_peticion:departamento_peticion,
            day:day,
            month:month,
            year:year
        },
        dataType:'json',
        success:function(msg){
            RellenarTablaPeticiones(msg);
            paginacion(num_resultados);

        },error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }

    });
}

function RellenarTablaPeticiones(msg){
    let tabla_1=$("#tabla_1 tbody");
    let tabla_2=$("#tabla_2 tbody");
    let tipo_usuario=$('#tipo_usuario').val();
    
    function estilo_bg(estado){
        if(estado=="ESPERA"){
            var bg_estilo="bg-warning";
        }if(estado=="RECHAZADA"){
            var bg_estilo="bg-danger";
        }if(estado=="ACEPTADA"){
            var bg_estilo="bg-success";
        }
        if(estado=="INICIADA"){
            var bg_estilo="bg-primary";
        }if(estado=="PROCESO"){
            var bg_estilo="bg-warning";
        }if(estado=="COMPLETADA"){
            var bg_estilo="bg-success";
        }
        if(estado=="SUSPENDIDA"){
            var bg_estilo="bg-danger";
        }
        if(estado=="ELIMINADA"){
            var bg_estilo="bg-danger";
        }
        if(estado=="------"){
            var bg_estilo="bg-light";
        }
        return bg_estilo;
    }

    tabla_1.empty();
    tabla_2.empty();

    msg.forEach(function(elemento){
        let bg_estilo=estilo_bg(elemento['nombre_estado_peticion']);
        //Dibujar la Tabla de Peticiones por medio del DOM de JavaScripts

        tabla_1.append(`<tr>
        <td>${elemento['id_peticion']}</td>
        <td>${elemento['fecha_registro']}</td>

        <td>
            <div class="btn-group">
                <button type="button" class="btn btn-success rounded-pill dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                    Seleccione...
                </button>

                <ul class="dropdown-menu" dropdown-menu-lg-end>
                    <li>
                        <a class="dropdown-item" href='./peticiones-aceptar-1.php?id_peticion=${elemento['id_peticion']}'>Aceptar</a>
                    </li>
                    <li>
                        <button class="dropdown-item" onclick="rechazarPeticion(${elemento['id_peticion']})">Rechazar</button>
                    </li>
                    <li>
                        <button class="dropdown-item" onclick="MostrarDetalles(${elemento['id_peticion']})">Ver Datos</button>
                    </li>
                </ul>
            </div>
        </td>

        <td>${elemento['nombre_peticion']}</td>

        <td>
            <h5><span class='badge rounded-pill ${bg_estilo}' style="width: 120px;">${elemento['nombre_estado_peticion']}</span></h5>
        </td>
        </tr>`);

        tabla_2.append(`
            <tr>
                <td>${elemento["id_peticion"]}</td>
                <td>${elemento['nombre_usuario']}</td>
                <td>${elemento['nombre_personal']} ${elemento['apellido_personal']}</td>
                <td>${elemento['cedula']}</td>
            </tr>
            `);
    });

}

/*
    <li>
        
        <button class="dropdown-item" onclick="MostrarDetalles(${elemento['id_peticion']})">Ver Detalles</button>
    </li>
*/
function paginacion(num_resultados){//Esta funcion hace apararecerlos botones para paginar los registros obtenidos
    let nombre_peticion=$("#data_busq_nombre").val();
    let fecha_registro=$("#data_busq_fecha").val();
    let id_usuario=$("#id_usuario_sesion").val();
    let nombre_estado_peticion=$("#data_busq_estado").val();
    let day=$("#day").val();
    let month=$("#month").val();
    let year=$("#year").val();
    let num_filas;
    
    $.ajax({
        async:false,
        type:"POST",
        url:"../Controller/controllerPeticion.php",
        data:{
            option:'contarRegistros',
            estado_peticion:1,
            nombre_peticion:nombre_peticion,
            fecha_registro:fecha_registro,
            id_usuario:id_usuario,
            nombre_estado_peticion:nombre_estado_peticion,
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
            `<li class="page-item"><a class="page-link" href='#tabla_peticiones' onclick="getPeticiones(${numero})"'>${numero}</a></li>`
        )
    }
}


function obtenerDepartamentosSelect(){
    
    //Obtener Todos los Departamentos y agregarlos a un select
    $.ajax({
        type:"POST",
        url:"../Controller/controllerDepartamentos.php",
        data:{
            option:"obtener"
        },
        dataType:'json',
        success:function(msg){
            msg.forEach(function(elemento){
                let departamento_peticion=$("#departamento_peticion");
                departamento_peticion.append("<option value='"+elemento['id_departamento']+"'>"+elemento["nombre_departamento"]+"</option>");
            });
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }
    });
}