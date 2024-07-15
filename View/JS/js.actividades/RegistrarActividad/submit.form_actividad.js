$(document).ready(function(){
    let form=document.getElementById("form_registrar_actividad");
    form.addEventListener("submit",function(event){
        event.preventDefault();
        if(form.checkValidity()){

            $("#label_nom_atend").text(`
                ${$("#nom_atendido").val().toUpperCase()} ${$("#ape_atendido").val().toUpperCase()}
            `);

            $("#label_ced_atendido").text(`
                ${FormatearCedula($("#ced_atendido").val())}
            `);

            $("#label_nom_responsable").text(`
                ${$("#nom_responsable").val()} ${$("#ape_responsable").val()}
            `);

            $("#label_ced_responsable").text(`
                ${FormatearCedula($("#ced_responsable").val())}
            `);

            $("#confirmarRegistro").modal('show');
        }
    });

    $("#submitActividad").on("click",()=>{
        $.ajax({
            data:$("#form_registrar_actividad").serialize(),
            url: "../Controller/controllerActividad.php",
            type: 'post',
            success: function (response){
                let m=1;
                sessionStorage.setItem('mensaje',m);
                location.href='./actividades-registradas.php';
            }
        });

    });
});


//Obtener tipos de actividades y agregarlos a un select
$.ajax({
    type:"POST",
    url:"../Controller/controllerTipo_actividad.php",
    data:{
        option:"obtener",
        id_tipo:$("input[name='id_tipo_actividad']").val()
    },
    dataType:'json',
    success:function(msg){
        msg.forEach(function(elemento){
            let tipo=$("#label_tipo_actividad");
            tipo.text(elemento['nombre_tipo']);
        });
    },
    error:function(jqXHR,textStatus,errorThrown){
        alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
    }
});

//agregarle puntos a la cedula
function FormatearCedula(cedula){
    let cedulaConPunto='';
    let contador=0;
    for(let i=cedula.length-1;i>=0;i--){
        if((contador==3)){
            cedulaConPunto="."+cedulaConPunto;
            contador=0;
        }
        cedulaConPunto=cedula[i]+cedulaConPunto;
        contador++;
    }
    return cedulaConPunto;
}