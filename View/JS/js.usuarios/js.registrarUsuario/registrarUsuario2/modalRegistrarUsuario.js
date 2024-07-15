export function funcionModal(){
    let mytoast = document.querySelector("#cancelar-usuario");
    let repetir = document.querySelector("#repetir-usuario");
    let Toast = new bootstrap.Toast(mytoast);
    let mensaje = new bootstrap.Toast(repetir);

    const ConfirmaRegistroUsuario=$("#ConfirmarRegistrarUsuario");
    ConfirmaRegistroUsuario.on("click",()=>{
        RegistrarUsuario();
    });
    
    const CancelarRegistroUsuario=$("#CancelarRegistrarUsuario");
    CancelarRegistroUsuario.on("click",()=>{
        CancelarRegistro();
    });

    function RegistrarUsuario(){
    
        $.ajax({
            data:$("#form_crear_usuario_part2").serialize(),
            url: "../Controller/controllerUsuario.php",
            type: 'post',
            success: function (response){
    
                if(response=='ERROR_UNICIDAD'){    
                    mensaje.show();
                }
    
                else{
                    var m=1;
                    sessionStorage.setItem('mensaje',m);
                    location.href='./usuarios-administrar.php';
                }
            }
            ,error:function(jqXHR,textStatus,errorThrown){
                alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
            }
        });
    }
    
    function CancelarRegistro(){
        Toast.show();
    }
}
