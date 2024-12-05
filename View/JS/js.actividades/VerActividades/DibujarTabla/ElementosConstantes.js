export const contenido=function(elemento,accion){
    let bg_estilo=estilo_bg(elemento['nombre_estado_actividad']);
    return `<tr class='align-middle '>
        <td>${elemento['fecha_inicio']}</td>
        <td>
            <div class="btn-group">
                <button type="button" class="btn btn-success rounded-pill dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                    Seleccione...
                </button>
                
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    ${accion}    
                </ul>
            </div>
        </td>
        <td>${elemento['nombre_actividad']}</td>
        <td><h5><span class="badge rounded-pill  ${bg_estilo}" style="width: 120px;">${elemento['nombre_estado_actividad']}</span><h5></td>
        <td>${elemento['nombre_tipo']}</td>
        <td>${elemento['fecha_registro']}</td>

    </tr>
        `;
        
    function estilo_bg(elemento){
        if(elemento=="INICIADA"){
            var bg_estilo="bg-primary";
        }
        if(elemento=="CREADA"){
            var bg_estilo="bg-primary";
        }
        if(elemento=="PROCESO"){
            var bg_estilo="bg-warning";
        }
        if(elemento=="COMPLETADA"){
            var bg_estilo="bg-success";
        }
        if(elemento=="SUSPENDIDA"){
            var bg_estilo="bg-danger";
        }
        return bg_estilo;
    }
}