$(document).ready(function(){
    var timestamp=new Date().getTime();
    var codigo=timestamp.toString(36);
    codigo+=Math.floor(Math.random()*10000000000000000);
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
    
    $("#fecha").val(ano+'-'+mes+'-'+dia);

    $.ajax({
        type:"POST",
        url:"../Controller/controllerTipo_actividad.php",
        data:{option:"obtener"},
        dataType:'json',
        success:function(msg){
            msg.forEach(function(elemento){
                let tipo=$("#id_tipo_actividad");
                tipo.append("<option value='"+elemento['id_tipo']+"'>"+elemento["nombre_tipo"]+"</option>");
            });
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }
    });
    
    $.ajax({
        type:"POST",
        url:"../Controller/controllerDepartamentos.php",
        data:{option:"obtener"},
        dataType:'json',
        success:function(msg){
            msg.forEach(function(elemento){
                let dep_emisor=$("#dep_emisor");
                dep_emisor.append("<option value='"+elemento['nombre_departamento']+"'>"+elemento["nombre_departamento"]+"</option>");
                let dep_receptor=$("#dep_receptor");
                dep_receptor.append("<option value='"+elemento['nombre_departamento']+"'>"+elemento["nombre_departamento"]+"</option>");
            });
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }
    });
    
    $.ajax({
        type:"POST",
        url:"../Controller/controllerUsuario.php",
        data:{option:"buscar",columna:'id_usuario',useLIKE:false,data_busq:$('#id_usuario_sesion').val()},
        dataType:'json',
        success:function(msg){
            msg.forEach(function(elemento){
                $('#nom_responsable').val(elemento.nombre_personal);
                $('#ape_responsable').val(elemento.apellido_personal);
                $('#ced_responsable').val(elemento.cedula);
            });
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }
    });
    
});