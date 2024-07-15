$(document).ready(function(){
    let repetird = document.querySelector("#repetir-departamento");
    let mensaje = new bootstrap.Toast(repetird);
    $("#nombre_departamento").on('input',function(){
        var valor=$(this).val();
        var nuevo_valor=valor.replace(/[0-9!@#$%^&*()_{}"´'¡¿°:|<>?,.`~+=/;[-]/g,"");
        $(this).val(nuevo_valor);

    });
    var w = sessionStorage.getItem('mensaje');
     if (w==3){
        let mytoast = document.querySelector("#registrar-departamento");
        let Toast = new bootstrap.Toast(mytoast);
        Toast.show();
        w=0;
        sessionStorage.setItem('mensaje',w);
    }

    const form=$("#form-departamento");
    form.on("submit",(event)=>{
    
        event.preventDefault();
        
        if(document.querySelector("#form-departamento").checkValidity()){        
            $.ajax({

                data:{
                    option:"contarRegistros",
                    nombre_departamento:$("#nombre_departamento").val()
                },
                url: "../Controller/controllerDepartamentos.php",
                type: 'post',

                success: function (response){
                    if(parseInt(response)===0){ 
                    
                        $.ajax({
                            data:form.serialize(),
                            url: "../Controller/controllerDepartamentos.php",
                            type: 'post',
                            success: function (response){
                                if(response=='ERROR_UNICIDAD'){    
                                    mensaje.show();
                                }
                                else{
                                let m=3;
                                sessionStorage.setItem('mensaje',m);
                                location.reload();
                                }
                            }
                            ,error:function(jqXHR,textStatus,errorThrown){
                                alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
                            }
                        });
                    }
                    else{
                        form.removeClass("was-validated");
                        $("#nombre_departamento").addClass("is-invalid");
                        mensaje.show();
                    }
                }
            });
        }
    });
});