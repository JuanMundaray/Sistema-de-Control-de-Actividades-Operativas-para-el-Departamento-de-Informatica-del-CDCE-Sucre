$(document).ready(function(){
    
    $.ajax({
        type:"POST",
        url:"../controller/controllerTipo_actividad.php",
        data:"option=obtener",
        dataType:'json',
        success:function(msg){
            msg.forEach(function(elemento){
                let tabla=$("#tabla_tipo_actividad");;
                tabla.append(`<tr>
                <td>${elemento['id_tipo']}</td>
                <td>${elemento['codigo_tipo']}</td>
                <td>${elemento['nombre_tipo']}</td></tr>`)
            });
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }

    });

    $("#crear_tipo_act").click(function(){//Funcion ajax para crear un tipo de actividad------------------------
        let nombre_tipo=$("#nombre_tipo").val();
        let codigo=$("#codigo").val();
        let ok=confirm(`¿Desea Crear el tipo de Actividad "${nombre_tipo}"?`);
        if(ok){ 
            $.ajax({
                type:"POST",
                url:"../controller/controllerTipo_actividad.php",
                data:`option=crear&nombre_tipo=${nombre_tipo}&codigo=${codigo}`,
                dataType:'text',
                success:function(){
                    alert("Tipo de Actividad Agregada");
                    location.href="tipo-actividad.php";
                },
                error:function(jqXHR,textStatus,errorThrown){
                    alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
                }
        
            });
        }
    });

    $("#buscar_tipo_act").click(function(){ //Funcion ajax para buscar una actividad por su nombre o codigo
        let data=$("#data_busq").val();
        $.ajax({
            type:"GET",
            url:"../controller/controllerTipo_actividad.php",
            data:"option=buscar&data_busq="+data,
            dataType:'json',
            success:function(msg){
                let tabla=$("#tabla_tipo_actividad");
                tabla.empty();
                tabla.append(`<tbody><tr>
                    <th><label>ID</label></th>
                    <th><label>Codigo</label></th>
                    <th><label>Tipo de Actividad</label></th>
                </tr>`);
                msg.forEach(function(elemento){
                    tabla.append(`<tr>
                    <td>${elemento['id_tipo']}</td>
                    <td>${elemento['codigo_tipo']}</td>
                    <td>${elemento['nombre_tipo']}</td></tr>`)
                });
                tabla.append("</tbody>");
            },
            error:function(jqXHR,textStatus,errorThrown){
                alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
            }
    
        });
    });
});