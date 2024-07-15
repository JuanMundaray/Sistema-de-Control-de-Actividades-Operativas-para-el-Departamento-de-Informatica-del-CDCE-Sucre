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
    
    $("#fecha_registro").val(ano+'-'+mes+'-'+dia);

    //Rellenar los datos del usuario responsable de registrar la actividad
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
                $('#nom_responsable').val(elemento.nombre_personal);
                $('#ape_responsable').val(elemento.apellido_personal);
                $('#ced_responsable').val(elemento.cedula);
                $('#dep_receptor').val(elemento.nombre_departamento );
            });
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }
    });

    //impedir que en el campo cedula no se puedan agregar letras
    InputCedula("#ced_atendido");
    
    //impedir que en el campo ape_atendido se le puedan agregar signos especiales o numeros
    $("#ape_atendido").on('input',function(){
        var valor=$(this).val();
        var nuevo_valor=valor.replace(/[0-9!@#$%^&*()_{}"´'¡¿°:|<>?,.`~+=/;[-]/g,"");
        $(this).val(nuevo_valor);

    });
    //impedir que en el campo nom_atendido se le puedan agregar signos especiales o numeros
    $("#nom_atendido").on('input',function(){
        var valor=$(this).val();
        var nuevo_valor=valor.replace(/[0-9!@#$%^&*()_{}"´'¡¿°:|<>?,.`~+=/;[-]/g,"");
        $(this).val(nuevo_valor);

    });
    

});

function InputCedula(input){
    //impedir que en el campo se le puedan agregar signos especiales o numeros
    const dom=document.querySelector(input);
    dom.addEventListener("input",function(event){
        var valor=this.value;
        var nuevo_valor=valor.replace(/[a-zA-Z!@#$%^&*()_{}"'|<>?,.`~=¿+_:;/]/g,"");
        this.value=nuevo_valor;
    });
    dom.addEventListener("keydown",(event)=>{
        if((dom.value.length===0)&&(event.key==='0')){
            event.preventDefault();
        }
        if((dom.value.charAt(0)==='0')){
            dom.value='';
        }
    });

}