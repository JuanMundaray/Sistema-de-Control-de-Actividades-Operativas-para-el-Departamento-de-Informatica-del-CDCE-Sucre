$(document).ready(function(){
    
    $("#modificar_actividad").click(function(){//Boton de Modificar Actividad-------------------------------
        let ok=confirm("¿Esta seguro de Modificar esta actividad?");
        if(ok){
            let id=$("#id").val();
            let nombre=$("#nombre").val();
            let codigo=$("#codigo").val();
            let tipo=$("#tipo").val();
            let fecha=$("#fecha").val();
            let observacion=$("#observacion").val();
            let dep_receptor=$("#dep_receptor").val();
            let dep_emisor=$("#dep_emisor").val();
            let nom_responsable=$("#nom_responsable").val();
            let ape_responsable=$("#ape_responsable").val();
            let ced_responsable=$("#ced_responsable").val();
            let nom_atendido=$("#nom_atendido").val();
            let ape_atendido=$("#ape_atendido").val();
            let ced_atendido=$("#ced_atendido").val();
            $.ajax({
                type:"POST",
                url:"../controller/controllerActividad.php",
                data:`option=modificar&id=${id}
                &nombre=${nombre}
                &codigo=${codigo}
                &tipo=${tipo}
                &fecha=${fecha}
                &observacion=${observacion}
                &dep_receptor=${dep_receptor}
                &dep_emisor=${dep_emisor}
                &nom_responsable=${nom_responsable}
                &ape_responsable=${ape_responsable}
                &ced_responsable=${ced_responsable}
                &nom_atendido=${nom_atendido}
                &ape_atendido=${ape_atendido}
                &ced_atendido=${ced_atendido}`,
                dataType:'text',
                success:function(msg){
                        alert("Actividad Modificada","Notificacion");
                        location.href="actividades-registradas.php";
                },
                error:function(jqXHR,textStatus,errorThrown){
                    alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
                }
            });
        }else{
            alert("Actividad No Modificada","Notificacion");
            location.href="actividades-registradas.php";
        }
    });
    
    $("#buscar_act").click(function(){ //Funcion ajax para buscar una actividad por su nombre o codigo
        let data=$("#data_busq").val();         
        $.ajax({
            type:"POST",
            url:"../controller/controllerActividad.php",
            data:"option=buscar&data_busq="+data+"&parametro_busq=nombre",
            dataType:'json',
            success:function(msg){
                let tabla=$("#tabla_actividades");
                tabla.empty();
                tabla.append(`<tbody><tr>
                    <th><label>Codigo de Registro</label></th>
                    <th><label>Fecha de Registro</label></th>
                    <th><label>Actividad</label></th>
                    <th><label>Tipo de Actividad</label></th>
                    <th><label>Departamento Emisor</label></th>
                    <th><label>Nombre del Responsable</label></th>
                    <th><label>Apellido del Responsable</label></th>
                    <th><label>Cedula del Responsable</label></th>
                    <th><label>Funcionario Atendido</label></th>
                    <th><label>Cedula del Funcionario Atendido</label></th>
                    <th><label>Estado</label></th>
                    <th><label>Observacion</label></th>
                    <th colspan="2"><label>Accion</label></th>
                </tr>`);
                msg.forEach(function(elemento){ 
                    
                    tabla.append(`<tr>
                    <td>${elemento['codigo']}</td>
                    <td>${elemento['fecha']}</td>
                    <td>${elemento['nombre']}</td>
                    <td>${elemento['nombre_tipo']}</td>
                    <td>${elemento['dep_receptor']}</td>
                    <td>${elemento['dep_emisor']}</td>
                    <td>${elemento['nom_responsable']} ${elemento['ape_responsable']}</td>
                    <td>${elemento['ced_responsable']}</td>
                    <td>${elemento['nom_atendido']+" "+elemento['ape_atendido']}</td>
                    <td>${elemento['ced_funcionario_aten']}</td>
                    <td><button class="btn btn-warning">${elemento['estado']}</button></td>
                    <td>${elemento['observacion']}</td>
                    <td>
                        <a href="editar-actividad.php?id=${elemento['id']}"><button class="btn btn-outline-secondary">Modificar</button></a>
                    </td>

                    <td><button class="btn btn-outline-danger" onclick="alerta(${elemento['id']})">Eliminar</button></td></tr>`);
                });
                tabla.append("</tbody>");
            },
            error:function(jqXHR,textStatus,errorThrown){
                alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
            }
    
        });
    });
    
    $.ajax({

        type:"POST",
        url:"../controller/controllerTipo_actividad.php",
        data:"option=obtener",
        dataType:'json',
        success:function(msg){
            msg.forEach(function(elemento){
                let tipo=$("#tipo");
                tipo.append("<option value='"+elemento['id_tipo']+"'>"+elemento["nombre_tipo"]+"</option>");
            });
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }

    });
    
});