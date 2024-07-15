$(document).ready(function(){
    //Generar Codigo Aleatorio y colocarlo en un input
    var timestamp=new Date().getTime();
    var codigo=timestamp.toString(36);
    codigo+=Math.floor(Math.random()*10);
    codigo='cdce'+codigo;
    $("#codigo_actividad").val(codigo);
    
    //obtener fecha actual
    objeto_fecha=new Date();
    let ano=objeto_fecha.getFullYear();
    let dia=objeto_fecha.getDate();
    if(dia<10){
        dia='0'+dia;
    }
    let mes=objeto_fecha.getMonth()+1;
    if(mes<10){
        mes='0'+mes;
    }
    
    $("#fecha_inicio").val(ano+'-'+mes+'-'+dia);

    //Obtener tipos de actividades y agregarlos a un select
    $.ajax({
        type:"POST",
        url:"../Controller/controllerTipo_actividad.php",
        data:{
            option:"obtener"
        },
        dataType:'json',
        success:function(msg){
            let tipo=$("#id_tipo_actividad");
            msg.forEach(function(elemento){
                tipo.append("<option value='"+elemento['id_tipo']+"'>"+elemento["nombre_tipo"]+"</option>");
            });
            tipo.append(`<option id="agregarTipoActividad" value="">+ Agregar Tipo de Actividad</option>`);
            $("#agregarTipoActividad").on("click",()=>{
                $("#modalTipoActividad").modal("show");
            });

        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }
    });

    //Obtener Todos los Departamentos y agregarlos a un select
    $.ajax({
        type:"POST",
        url:"../Controller/controllerDepartamentos.php",
        data:{
            option:"obtener"
        },
        dataType:'json',
        success:function(msg){
            let dep_emisor=$("#dep_emisor");
            let dep_receptor=$("#dep_receptor");
            msg.forEach(function(elemento){
                dep_emisor.append("<option value='"+elemento['nombre_departamento']+"'>"+elemento["nombre_departamento"]+"</option>");
                dep_receptor.append("<option value='"+elemento['nombre_departamento']+"'>"+elemento["nombre_departamento"]+"</option>");
            });
            dep_emisor.append(`<option id="agregarDepartamento" value=''>+Agregar Departamento</option>`);
            
            $("#agregarDepartamento").on("click",()=>{
                $("#modal-departamento").modal("show");
            });
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }
    });

    //Rellenar el dato de Departamento del usuario responsable de registrar la actividad
    $.ajax({
        type:"POST",
        url:"../Controller/controllerUsuario.php",
        data:{
            option:"obtener",
            id_usuario:$('#id_usuario_sesion').val()
        },
        dataType:'json',
        success:function(msg){
            msg.forEach(function(elemento){
                $('#dep_receptor').val(elemento.nombre_departamento );
            });
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }
    });
    
    //impedir que en el campo nombre de Actividad se le puedan agregar signos especiales o numeros
    $("#nombre_actividad").on('input',function(){
        var valor=$(this).val();
        var nuevo_valor=valor.replace(/[!@#$%^&*()_{}"´'¡¿°:|<>?,.`~+=/;[]/g,"");
        $(this).val(nuevo_valor);

    });
    

});