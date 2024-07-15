import {FilterArrayPeticiones} from "./ContarRegistros.js"

export function graficaBarraPeticion(data){

    const num_peticion_espera=FilterArrayPeticiones(data,"ESPERA");
    const num_peticion_aceptada=FilterArrayPeticiones(data,"ACEPTADA");

    const yValues = [`ESPERA (${porcentaje(num_peticion_espera,data.length)}%)`,
                    `ACEPTADAS (${porcentaje(num_peticion_aceptada,data.length)})%`];
    const xValues = [num_peticion_espera,num_peticion_aceptada];
    const barColors = [
      "rgb(127,179,213)",
      "rgb(241,148,138)",
      ];
    
    new Chart("grafica_peticiones", {
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
                text: "Peticiones Registradas"
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