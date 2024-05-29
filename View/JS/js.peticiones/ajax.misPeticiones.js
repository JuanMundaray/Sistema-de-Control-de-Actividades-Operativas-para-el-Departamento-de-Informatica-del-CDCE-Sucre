
$(document).ready(function(){
    obtener_estado_peticion();
    getPeticiones();
    
    $("#data_busq_nombre").on('input',function(){ //Funcion ajax para buscar una actividad por su nombre o codigo
        getPeticiones();
    });
    $('#aplicar_filtro').click(function(){
        getPeticiones();
    });
    
    $("#num_resultados option").click(function(){ 
        //Funcion ajax para buscar una actividad por su codigo
        getActividades();
    });

});

function getPeticiones(pagina=1){
    let num_resultados=$("#num_resultados").val();
    let nombre_peticion=$("#data_busq_nombre").val();
    let fecha_peticion=$("#data_busq_fecha").val();
    let estado_peticion=$("#data_busq_estado").val();
    let departamento_peticion=$("#data_busq_estado").val();
    let id_usuario=$("#id_usuario_sesion").val();
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
            departamento_peticion:departamento_peticion,
            estado_peticion:estado_peticion,
            id_usuario:id_usuario,
            day:day,
            montn:month,
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
    let tabla=$("#tabla_peticiones");
    let tipo_usuario=$('#tipo_usuario').val();

    tabla.empty();
    tabla.append(`<tbody><tr>
        <th><label>Nombre de Peticion</label></th>
        <th><label>Usuario que registro la peticion</label></th>
        <th><label>Departamento de la Peticion</label></th>
        <th><label>Fecha de Peticion</label></th>
        <th><label>Tipo de Actividad de la Peticion</label></th>
        <th><label>Estado de la Peticion</label></th>
        <th><label>Estado de Actividad Originada</label></th>
        <th colspan="1"><label>Accion</label></th>
    </tr>`);

    msg.forEach(function(elemento){
        let estado_actividad=estado_actividad_originada(elemento);
        let bg_estilo=estilo_bg(elemento['nombre_estado_peticion']);
        let bg_estilo_actividad=estilo_bg(estado_actividad);
        if(elemento['nombre_estado_peticion']=='ESPERA'){
            boton_desplegable_accion=`<button class="dropdown-item" onclick="eliminarPeticion(${elemento['id_peticion']},'¿Seguro que desea cancelar esta peticion?')">Cancelar</button>`;
        }
        if(elemento['nombre_estado_peticion']=='RECHAZADA'){
            boton_desplegable_accion=`<button class="dropdown-item" onclick="eliminarPeticion(${elemento['id_peticion']},'¿Seguro que desea eliminar esta peticion?')">Eliminar</button>`;
        }
        else{
            boton_desplegable_accion=`<button class="dropdown-item">OK</button>`;
        }

        //Dibujar la Tabla de Peticiones por medio del DOM de JavaScripts
            tabla.append(`<tr>
                <td>${elemento['nombre_peticion']}</td>
                <td>${elemento['nombre_usuario']}</td>
                <td>${elemento['nombre_departamento']}</td>
                <td>${elemento['fecha_peticion']}</td>
                <td>${elemento['nombre_tipo']}</td>
                <td>
                    <h5><span class='badge rounded-pill ${bg_estilo}' style="width: 120px;">${elemento['nombre_estado_peticion']}</span></h5>
                </td>
                <td>
                    <h5><span class="badge rounded-pill  ${bg_estilo_actividad}" style="width: 120px;">${estado_actividad}</span><h5>
                </td>
                <td>
                    <div class="btn-group rounded-pill">
                        <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                            Seleccione...
                        </button>

                        <ul class="dropdown-menu dropdown-menu-lg-end">
                            ${boton_desplegable_accion}
                        </ul>
                    </div>
                </td>
            </tr>`);
    });
    tabla.append("</tbody>");

    function estilo_bg(estado){
        if(estado=="ESPERA"){
            var bg_estilo="bg-warning";
        }if(estado=="RECHAZADA"){
            var bg_estilo="bg-danger";
        }if(estado=="ACEPTADA"){
            var bg_estilo="bg-success";
        }
        if(estado=="CREADA"){
            var bg_estilo="bg-primary";
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

    function estado_actividad_originada(elemento){
        let nombre_estado_actividad;
        $.ajax({
            async:false,
            type:"POST",
            url:"../Controller/controllerActividad.php",
            data:{
                option:'obtener',
                codigo_actividad:elemento['actividad_originada']
            },
            dataType:'json',
            success:function(msg){
                nombre_estado_actividad=msg[0]['nombre_estado_actividad']
            },error:function(jqXHR,textStatus,errorThrown){
                alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
            }
    
        });
        if(nombre_estado_actividad!=null){
            return nombre_estado_actividad
        }
        else{
            return '------';

        }
    }
}

function paginacion(num_resultados){//Esta funcion hace apararecerlos botones para paginar los registros obtenidos

    let nombre_peticion=$("#data_busq_nombre").val();
    let fecha_peticion=$("#data_busq_fecha").val();
    let id_usuario=$("#id_usuario_sesion").val();
    let estado_peticion=$("#data_busq_estado").val();
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
            estado_peticion:estado_peticion,
            id_usuario:id_usuario,
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

    

function eliminarPeticion(id_peticion,texto){
    let ok=confirm(texto);
    if(ok){
        $.ajax({
            type:"POST",
            url:"../Controller/controllerPeticion.php",
            data:{
                option:'eliminar',
                id_peticion:id_peticion
            },
            dataType:'json',
            success:function(msg){
                alert("Peticion Eliminada Exitosamente");
                location.reload();
            }
        });
    }
}
//funcion para obtener los estado de peticiones y colocarlos en el select de estados de peticion
function obtener_estado_peticion(){
    let resultado;

    $.ajax({
        async:false,
        type:"POST",
        url:"../Controller/controllerEstado_peticion.php",
        data:{
            option:'obtener'
        },
        dataType:'json',
        success:function(msg){
            resultado=msg;
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }
    });

    resultado.forEach(function(elemento){
        estado_peticion=$("#data_busq_estado");
        estado_peticion.append("<option value='"+elemento['id_estado_peticion']+"'>"+elemento["nombre_estado_peticion"]+"</option>");
    });
}