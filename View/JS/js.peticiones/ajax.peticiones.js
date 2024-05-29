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

function getPeticiones(pagina=1){
    let num_resultados=$("#num_resultados").val();
    let nombre_peticion=$("#data_busq_nombre").val();
    let fecha_peticion=$("#data_busq_fecha").val();
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
            fecha_peticion:fecha_peticion,
            id_usuario:id_usuario,
            departamento_peticion:departamento_peticion,
            day:day,
            montn:month,
            year:year
        },
        dataType:'json',
        success:function(msg){
            console.log(msg);
            RellenarTablaPeticiones(msg);
            paginacion(num_resultados);

        },error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }

    });
}

function RellenarTablaPeticiones(msg){
    let tabla=$("#tabla_peticiones");
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

    tabla.empty();
    tabla.append(`<tbody><tr>
        <th><label>Nombre de Peticion</label></th>
        <th colspan="1"><label>Accion</label></th>
        <th><label>Estado de la Peticion</label></th>
        <th><label>Fecha de la Peticion</label></th>
        <th><label>Tipo de Actividad de la Peticion</label></th>
        <th><label>Departamento de la Peticion</label></th>
        <th><label>Usuario que registro la peticion</label></th>
    </tr>`);
    msg.forEach(function(elemento){
        let bg_estilo=estilo_bg(elemento['nombre_estado_peticion']);
        if(elemento['nombre_estado_peticion']=='ESPERA'){
        //Dibujar la Tabla de Peticiones por medio del DOM de JavaScripts
            tabla.append(`<tr>
            <td>${elemento['nombre_peticion']}</td>
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
                            <a class="dropdown-item" href="peticiones-detalles.php?id_peticion=${elemento['id_peticion']}">Ver Detalles</a>
                        </li>
                    </ul>
                </div>
            </td>
            <td>
                <h5><span class='badge rounded-pill ${bg_estilo}' style="width: 120px;">${elemento['nombre_estado_peticion']}</span></h5>
            </td>
            <td>${elemento['fecha_peticion']}</td>
            <td>${elemento['nombre_tipo']}</td>
            <td>${elemento['nombre_departamento']}</td>
            <td>${elemento['nombre_usuario']}</td>
            </tr>`);
        }
    });
    tabla.append("</tbody>");
}

function paginacion(num_resultados){//Esta funcion hace apararecerlos botones para paginar los registros obtenidos
    let nombre_peticion=$("#data_busq_nombre").val();
    let fecha_peticion=$("#data_busq_fecha").val();
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
            nombre_peticion:nombre_peticion,
            fecha_peticion:fecha_peticion,
            id_usuario:id_usuario,
            nombre_estado_peticion:nombre_estado_peticion,
            day:day,
            montn:month,
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

function rechazarPeticion(id_peticion){
    let ok=confirm("¿Seguro que desea eliminar esta peticion?");
    if(ok){
        $.ajax({
            type:"POST",
            url:"../Controller/controllerPeticion.php",
            data:{option:"rechazar",id_peticion:id_peticion},
            dataType:'json',
            success:function(){
                alert("Peticion Rechazada");
                location.reload();
            },error:function(jqXHR,textStatus,errorThrown){
                alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
            }
    });
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