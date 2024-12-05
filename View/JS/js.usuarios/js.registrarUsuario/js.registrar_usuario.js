$(document).ready(function(){
    InputCedula("#cedula");

    //impedir que en el campo nombre se le puedan agregar signos especiales o numeros
    $("#nombre").on('input',function(){
        var valor=$(this).val();
        var nuevo_valor=valor.replace(/[^a-zA-Z\s]/g,"");
        $(this).val(nuevo_valor);
    
    });

    //impedir que en el campo apellido se le puedan agregar signos especiales o numeros
    $("#apellido").on('input',function(){
        var valor=$(this).val();
        var nuevo_valor=valor.replace(/[^a-zA-Z\s]/g,"");
        $(this).val(nuevo_valor);
    
    });

    //impedir que en el campo username se le puedan agregar signos especiales o numeros
    $("#username").on('input',function(){
        var valor=$(this).val();
        var nuevo_valor=valor.replace(/[^\w\s]/g,"");
        $(this).val(nuevo_valor);
    
    });

    //impedir que en el campo username se le puedan agregar signos especiales o numeros
    $("#password").on('input',function(){
        var valor=$(this).val();
        var nuevo_valor=valor.replace(/[!@#$%^&*()_{}"'|<>?,.`~]/g,"");
        $(this).val(nuevo_valor);
    
    });

})

$.ajax({
    type:"POST",
    url:"../Controller/controllerDepartamentos.php",
    data:{option:"obtener"},
    dataType:'json',
    success:function(msg){
        msg.forEach(function(elemento){
            let departamento=$("#departamento");
            departamento.append("<option value='"+elemento['id_departamento']+"'>"+elemento["nombre_departamento"]+"</option>");
        });
    },
    error:function(jqXHR,textStatus,errorThrown){
        alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
    }
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