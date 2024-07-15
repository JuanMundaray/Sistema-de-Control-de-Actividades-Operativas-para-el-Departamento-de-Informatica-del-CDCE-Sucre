import {FilterArrayActividades,contarActividades} from "./ContarRegistros.js"
import {ObtenerActividades} from "./ObtenerRegistros.js"

const actividades=ObtenerActividades();

const TIPO_ACTIVIDAD={
    CREADA:6,
    INICIADA:1,
    PROCESO:2,
    COMPLETADA:3,
    SUSPENDIDA:4,
    ELIMINADA:5
}

graficoActividadesMes();

function graficoActividadesMes(){
    const xValues=[
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agost",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre"];
    
    const yValues=[
        FilterArrayActividades(actividades,null,null,1),
        FilterArrayActividades(actividades,null,null,2),
        FilterArrayActividades(actividades,null,null,3),
        FilterArrayActividades(actividades,null,null,4),
        FilterArrayActividades(actividades,null,null,5),
        FilterArrayActividades(actividades,null,null,6),
        FilterArrayActividades(actividades,null,null,7),
        FilterArrayActividades(actividades,null,null,8),
        FilterArrayActividades(actividades,null,null,9),
        FilterArrayActividades(actividades,null,null,10),
        FilterArrayActividades(actividades,null,null,11),
        FilterArrayActividades(actividades,null,null,12)
    ];
    
    const colors=[
        "rgb(118,215,196)",
        "rgb(247,220,111)",
        "rgb(130,224,170)",
        "rgb(217,136,128)",
        "rgb(118,215,196)",
        "rgb(247,220,111)",
        "rgb(130,224,170)",
        "rgb(217,136,128)",
        "rgb(118,215,196)",
        "rgb(247,220,111)",
        "rgb(130,224,170)",
        "rgb(217,136,128)",
    ];
    
    
    new Chart("graficoBarras", {
        type: "bar",
        data: {
          labels: xValues,
          datasets: [{
            label:"actividades",
            backgroundColor: colors,
            borderWidth:2,
            data: yValues
          }]
        },
        options: {
          legend:{display:true},
          title:{
              display:true,
              text:"Actividades Por Mes"
          }
        }
      });

}

export function graficoActividadesAno(){

  const fecha=new Date();
  let years=[];
  let num_actividades_year=[];
  
  //desde aqui se obtienen los años desde el año de la actividad mas antigua
  for(let i=2023;i<=fecha.getFullYear();i++){
    years.push(i);
  }

  //desde aqui se obtienen los registros desde el año de la actividad mas antigua
  for(let i=2023;i<=fecha.getFullYear();i++){
    num_actividades_year.push(FilterArrayActividades(actividades,null,i));
  }

  const xValues = years;
  const yValues = num_actividades_year;

new Chart("graficoActividadesYear", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor:"rgba(0,0,255,1.0)",
      borderColor: "rgba(0,0,255,0.1)",
      data: yValues,
      pointRadius:3,
      fill:false
    }]
  },
  options:{
    legend:{display:false}
  }
});

}

export function graficoActividadesPorEstado(){
  
    const xValues=[
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre"  
    ];
    
    const yValuesIniciadas=[
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.INICIADA,null,1),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.INICIADA,null,2),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.INICIADA,null,3),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.INICIADA,null,4),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.INICIADA,null,5),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.INICIADA,null,6),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.INICIADA,null,7),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.INICIADA,null,8),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.INICIADA,null,9),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.INICIADA,null,10),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.INICIADA,null,11),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.INICIADA,null,12)
    ];
    const yValuesProceso=[
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.PROCESO,null,1),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.PROCESO,null,2),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.PROCESO,null,3),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.PROCESO,null,4),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.PROCESO,null,5),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.PROCESO,null,6),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.PROCESO,null,7),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.PROCESO,null,8),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.PROCESO,null,9),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.PROCESO,null,10),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.PROCESO,null,11),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.PROCESO,null,12)
    ];
    const yValuesCompletadas=[
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.COMPLETADA,null,1),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.COMPLETADA,null,2),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.COMPLETADA,null,3),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.COMPLETADA,null,4),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.COMPLETADA,null,5),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.COMPLETADA,null,6),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.COMPLETADA,null,7),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.COMPLETADA,null,8),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.COMPLETADA,null,9),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.COMPLETADA,null,10),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.COMPLETADA,null,11),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.COMPLETADA,null,12)
    ];
    const yValuesSuspendidas=[
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.SUSPENDIDA,null,1),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.SUSPENDIDA,null,2),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.SUSPENDIDA,null,3),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.SUSPENDIDA,null,4),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.SUSPENDIDA,null,5),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.SUSPENDIDA,null,6),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.SUSPENDIDA,null,7),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.SUSPENDIDA,null,8),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.SUSPENDIDA,null,9),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.SUSPENDIDA,null,10),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.SUSPENDIDA,null,11),
        FilterArrayActividades(actividades,TIPO_ACTIVIDAD.SUSPENDIDA,null,12)
    ];

    new Chart("graficoActividadesEstado", {
        type: "line",
        data: {
          labels: xValues,
          datasets: [{
            label:"Iniciadas",
            data: yValuesIniciadas,
            borderColor: "blue",
            pointRadius:1,
            fill: false,
            tension:0
          },
          {
            label:"Proceso",
            data: yValuesProceso,
            borderColor: "yellow",
            pointRadius:1,
            fill: false,
            tension:0
          },
          {
            label:"Completadas",
            data: yValuesCompletadas,
            borderColor: "green",
            pointRadius:1,
            fill: false,
            tension:0
          },
          {
            label:"Suspendidas",
            data: yValuesSuspendidas,
            borderColor: "red",
            pointRadius:1,
            fill: false,
            tension:0
          }]
        }
      });
}

function ActividadesRegistradaspie(){
  //graficas
  new Chart("graficaActividades", {
      type: "pie",
      resize: true,
      data: {
            labels: [
              `Iniciadas (${porcentaje(FilterArrayActividades(actividades,TIPO_ACTIVIDAD.INICIADA),actividades.length)})%`,
              `Proceso (${porcentaje(FilterArrayActividades(actividades,TIPO_ACTIVIDAD.PROCESO),actividades.length)})%`,
              `Completada (${porcentaje(FilterArrayActividades(actividades,TIPO_ACTIVIDAD.COMPLETADA),actividades.length)})%`,
              `Suspendida (${porcentaje(FilterArrayActividades(actividades,TIPO_ACTIVIDAD.SUSPENDIDA),actividades.length)})%`],
            datasets: [{
              backgroundColor: [
                  "rgb(118,215,196)",
                  "rgb(247,220,111)",
                  "rgb(130,224,170)",
                  "rgb(217,136,128)",
              ],
              data:  [
                  FilterArrayActividades(actividades,TIPO_ACTIVIDAD.INICIADA),
                  FilterArrayActividades(actividades,TIPO_ACTIVIDAD.PROCESO),
                  FilterArrayActividades(actividades,TIPO_ACTIVIDAD.COMPLETADA),
                  FilterArrayActividades(actividades,TIPO_ACTIVIDAD.SUSPENDIDA)
              ]
            }]
        },
        options: {
            title: {
                responsive:true,
                display: true,
                maintainAspectRatio : false,
                fontSize: 40,
                text: "Actividades Registradas"
            },
    
        legend:{
            labels:{
            fontSize:20
            }
        }
    
      }
    });
  }ActividadesRegistradaspie();


  function porcentaje(num,total){
      let valor_porcentual=parseInt(num/total*100);
      return valor_porcentual;
  }