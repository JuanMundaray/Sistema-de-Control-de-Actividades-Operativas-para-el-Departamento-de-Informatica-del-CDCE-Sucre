import {FilterArrayUsuarios} from "./ContarRegistros.js"

export function graficaDonaUsuarios(dataUsuarios){
    const num_administrador=FilterArrayUsuarios(dataUsuarios,"administrador");
    const num_tecnicos=FilterArrayUsuarios(dataUsuarios,"estandar");
    const num_solicitantes=FilterArrayUsuarios(dataUsuarios,"invitado");
    const yValues = [
        `Administrador (${porcentaje(num_administrador,dataUsuarios.length)})%`, 
        `Tecnicos (${porcentaje(num_tecnicos,dataUsuarios.length)})%`, 
        `Solicitantes (${porcentaje(num_solicitantes,dataUsuarios.length)})%`];
    const xValues = [num_administrador,num_tecnicos,num_solicitantes];
    const barColors = [
      "rgb(127,179,213)",
      "rgb(241,148,138)",
      "rgb(240,178,122)",
      ];
    
    new Chart("graficaUsuarios", {
      type: "doughnut",
      resize: true,
      data: {
            labels: yValues,
            datasets: [{
                backgroundColor: barColors,
                data: xValues
            }]
        },
        options: {
            title: {
                responsive:true,
                display: true,
                maintainAspectRatio : false,
                fontSize: 40,
                text: "Usuarios Registrados"
            },
    
        legend:{
            labels:{
            fontSize:20 
            }
        }
    
      }
    });
}

function porcentaje(num,total){
    let valor_porcentual=parseInt(num/total*100);
    return valor_porcentual;
}