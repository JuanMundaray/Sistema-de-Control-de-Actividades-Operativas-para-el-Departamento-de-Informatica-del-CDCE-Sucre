$(document).ready(function(){
    obtenerListaDay();
    obtenerListaYear();
});

function obtenerListaDay(){
    let day=$("#day");
    for(i=1;i<32;i++){
        day.append(`<option value=${i}>${i}</option>`);
    }

}

function obtenerListaYear(){
    const date=new Date();
    let year=$("#year");
    const yearInicio=2023;
    const yearActual=date.getFullYear();
    for(i=yearInicio;i<=yearActual;i++){
        year.append(`<option value=${i}>${i}</option>`);
    }

}