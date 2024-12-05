$(document).ready(function(){

    $("#nombre_tipo").on('input',function(){
        var valor=$(this).val();
        var nuevo_valor=valor.replace(/[^a-zA-Z\s]/g,"");
        $(this).val(nuevo_valor);
    });

    let w = sessionStorage.getItem('mensaje');
    if (w==2){
        let mytoast = document.querySelector("#registrar-tipo");
        let Toast = new bootstrap.Toast(mytoast);
        Toast.show();
        w=0;
        sessionStorage.setItem('mensaje',w);
    }

    let repetir = document.querySelector("#repetir-tipo");
    let mensaje = new bootstrap.Toast(repetir);
    const form=$("#formTipoActividad");
    form.on("submit",(event)=>{
    
        event.preventDefault();
        
        if(document.querySelector("#formTipoActividad").checkValidity()){        
    
            $.ajax({
                data:form.serialize(),
                url: "../Controller/controllerTipo_actividad.php",
                type: 'post',
                success: function (response){
                    if(response=="ERR_DUPLICADO"){
                        mensaje.show();
                    }else{
                        let m=2;
                        sessionStorage.setItem('mensaje',m);
                        location.reload();
                    }

                }
            });
    
        }
    })
});