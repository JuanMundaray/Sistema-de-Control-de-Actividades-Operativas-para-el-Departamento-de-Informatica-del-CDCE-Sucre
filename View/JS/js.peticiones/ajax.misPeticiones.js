

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
        getPeticiones();
    });

});
window.cancelarPeticion=function(id_peticion){
    $("#ModalCancelarPeticion").modal("show");
    console.log("Entra");
    $("#confirmarCancelarPeticion").on("click",()=>{
        $.ajax({
            type:"POST",
            url:"../Controller/controllerPeticion.php",
            data:{
                option:'eliminar',
                id_peticion:id_peticion
            },
            dataType:'json',
            success:function(msg){
                let m=3;
                sessionStorage.setItem('mensaje',m);
                location.reload();
            }
        });

    });
}

window.getPeticiones=function(pagina=1){
    let num_resultados=$("#num_resultados").val();
    let nombre_peticion=$("#data_busq_nombre").val();
    let fecha_registro=$("#data_busq_fecha").val();
    let estado_peticion=$("#data_busq_estado").val();
    let departamento_peticion=$("#data_busq_estado").val();
    let id_usuario=$("#id_usuario").val();
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
            fecha_registro:fecha_registro,
            departamento_peticion:departamento_peticion,
            estado_peticion:estado_peticion,
            id_usuario:id_usuario,
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
    let tabla_3=$("#tabla_3 tbody");
    let tipo_usuario=$('#tipo_usuario').val();

    tabla_1.empty();
    tabla_2.empty();
    tabla_3.empty();

    msg.forEach(function(elemento,index){
        index+=1;
        let estado_actividad=estado_actividad_originada(elemento['estado_actividad']);
        let bg_estilo=estilo_bg(elemento['nombre_estado_peticion']);
        let bg_estilo_actividad=estilo_bg(estado_actividad);


        if(elemento['nombre_estado_peticion']=='ESPERA'){
            boton_desplegable_accion=`<button class="dropdown-item" onclick="cancelarPeticion(${elemento['id_peticion']})">Cancelar</button>`;
        }

        if(elemento['nombre_estado_peticion']=='RECHAZADA'){
            boton_desplegable_accion=`<button class="dropdown-item" onclick="eliminarPeticion(${elemento['id_peticion']},'¿Seguro que desea eliminar esta peticion?')">Eliminar</button>`;
        }
        if(elemento['nombre_estado_peticion']=='ACEPTADA'){
            boton_desplegable_accion=`<button class="dropdown-item">OK</button>`;
        }

        //Dibujar la Tabla de Peticiones por medio del DOM de JavaScripts

        tabla_1.append(`
            <tr>
                <td>${index}</td>
                <td>${elemento['fecha_registro']}</td>

                <td>
                    <div class="btn-group rounded-pill">
                        <button type="button" class="btn btn-success dropdown-toggle rounded-pill" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                            Seleccione...
                        </button>

                        <ul class="dropdown-menu dropdown-menu-lg-end">
                            ${boton_desplegable_accion}
                        </ul>
                    </div>
                </td>

                <td>${elemento['nombre_peticion']}</td>


                <td><h5><span class='badge rounded-pill ${bg_estilo}' style="width: 120px;">${elemento['nombre_estado_peticion']}</span></h5>
                </td>

                <td>
                    <h5><span class="badge rounded-pill  ${bg_estilo_actividad}" style="width: 130px;">${estado_actividad}</span><h5>
                </td>
            </tr>`);


        tabla_2.append(`
            <tr>
                <td>${index}</td>
                <td>${elemento['nombre_usuario']}</td>
                <td>${elemento['nombre_personal']} ${elemento["apellido_personal"]}</td>
                <td>${elemento['cedula']}</td>
            </tr>
            `);

        tabla_3.append(`
            <tr>
                <td>${index}</td>
                <td>${elemento['nombre_departamento']}</td>
                <td>${elemento['nombre_tipo']}</td>
            </tr>
            `);
    });

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
        if(estado=="SIN ACTIVIDAD"){
            var bg_estilo="bg-secondary";
        }
        return bg_estilo;
    }

    function estado_actividad_originada(elemento){
        let resultado;
        const ESTADO_ACTIVIAD={
            INICIADA:1,
            PROCESO:2,
            COMPLETADA:3,
            SUSPENDIDA:4,
            ELIMINADA:5
        }
        if(elemento==ESTADO_ACTIVIAD.INICIADA){
            resultado="INICIADA";
        }
        if(elemento==ESTADO_ACTIVIAD.PROCESO){
            resultado="PROCESO";
        }
        if(elemento==ESTADO_ACTIVIAD.COMPLETADA){
            resultado="COMPLETADA";
        }
        if(elemento==ESTADO_ACTIVIAD.SUSPENDIDA){
            resultado="SUSPENDIDA";
        }
        if(elemento==ESTADO_ACTIVIAD.ELIMINADA){
            resultado="ELIMINADA";
        }
        if(elemento==null){
            resultado="SIN ACTIVIDAD";
        }

        return resultado;
    }
}

function paginacion(num_resultados){//Esta funcion hace apararecerlos botones para paginar los registros obtenidos

    let nombre_peticion=$("#data_busq_nombre").val();
    let fecha_registro=$("#data_busq_fecha").val();
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
            fecha_registro:fecha_registro,
            estado_peticion:estado_peticion,
            id_usuario:id_usuario,
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