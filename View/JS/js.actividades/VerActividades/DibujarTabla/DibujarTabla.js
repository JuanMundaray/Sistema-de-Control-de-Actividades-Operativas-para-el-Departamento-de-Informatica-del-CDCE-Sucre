import { contenido } from "./ElementosConstantes.js" ;
export function RellenarTablaActividades(msg){

    let tabla1=$("#tabla_datos_actividad tbody");
    let tabla2=$("#tabla_datos_responsable tbody");
    let tabla3=$("#tabla_datos_atendido tbody");

    tabla1.empty();
    tabla2.empty();
    tabla3.empty();

    msg.forEach(function(elemento){
        //Estas son los botones de accion que estaran disponibles segun si la actividad a sido completada o no
        let accion=`
            <li>
                <button class="dropdown-item"  onclick="MostrarDetalles('${elemento['codigo_actividad']}')">Ver Detalles</button>
            </li>`;

        if($('#tipo_usuario').val()=='administrador'){
            accion+=`
            <li>
                <button class="dropdown-item" onclick=SeguimientoActividad("${elemento['codigo_actividad']}")>Seguimiento de Actividad</button>
            </li>`;

            if(elemento['nombre_estado_actividad']!='COMPLETADA'){
                accion+=`
                <li>
                    <button class="dropdown-item" onclick="EditarActividad('${elemento['codigo_actividad']}')">Modificar</button>
                </li>
    
                <li>
                    <button class="dropdown-item" onclick="eliminarActividad('${elemento['codigo_actividad']}')">Eliminar</button>
                </li>`;
            }
        }
        else{
    
        }
        

        tabla1.append(contenido(elemento,accion));

        tabla2.append(`
            <tr class='align-middle '>
                <td>${elemento['nombre_personal']} ${elemento['apellido_personal']}</td>
                <td>${elemento['cedula']}</td>
                <td>${elemento['dep_receptor']}</td> 
            </tr>
            
            `);

        tabla3.append(`
            <tr class='align-middle '>
                <td>${elemento['nom_atendido']} ${elemento['ape_atendido']}</td>
                <td>${elemento['ced_atendido']}</td> 
                <td>${elemento['dep_emisor']}</td> 
            </tr>
            
            `);
    });
    tabla1.append("</tbody>");
    tabla2.append("</tbody>");
    tabla3.append("</tbody>");
}

//Esta funcion hace apararecerlos botones para paginar los registros obtenidos
export function paginacion(num_resultados){
    let codigo_actividad=$("#data_busq_codigo").val();
    let nombre_actividad=$("#data_busq_nombre").val();
    let fecha_registro=$("#data_busq_fecha").val();
    let estado_actividad=$("#estado_actividad").val();
    let day=$("#day").val();
    let year=$("#year").val();
    let month=$("#month").val();
    let num_filas;
    
    $.ajax({ 
        async:false,
        type:"POST",
        url:"../Controller/controllerActividad.php",
        data:{
            option:'contarRegistros',
            codigo_actividad:codigo_actividad,
            nombre_actividad:nombre_actividad,
            fecha_registro:fecha_registro,
            estado_actividad:estado_actividad,
            day:day,
            month:month,
            year:year
        },
        dataType:'json',
        success:function(msg){
            num_filas=msg;
        },
        error:function(jqXHR,textStatus,errorThrown){
            alert("error"+jqXHR+" "+textStatus+" "+errorThrown);
        }

    });

    let num_paginas=Math.ceil((num_filas)/(num_resultados));
    $("#num_paginas").empty();

    for(let i=1;i<=num_paginas;i++){
        setNumeroPaginas(i);
    }

    function setNumeroPaginas(numero){
        $("#num_paginas").append(
            `<li class="page-item"><a class="page-link" href='#tabla_actividades' onclick="getActividades(${numero})"'>${numero}</a></li>`
        )
    }
} 
