import {
    FilterArrayActividades,
    FilterArrayPeticiones,
    FilterArrayUsuarios

} from "./ContarRegistros.js"
import "./graficasActividades.js"
import {graficoActividadesAno,graficoActividadesPorEstado} from "./graficasActividades.js"
import { ObtenerActividades, ObtenerUsuarios,ObtenerPeticion} from "./ObtenerRegistros.js"
import {graficaDonaUsuarios} from "./js.grafica_usuarios.js"
import {graficaBarraPeticion} from "./js.graficas_peticion.js"

const TIPO_ACTIVIDAD={
    CREADA:6,
    INICIADA:1,
    PROCESO:2,
    COMPLETADA:3,
    SUSPENDIDA:4,
    ELIMINADA:5
}

const TIPO_USUARIO={
    ADMINISTRADOR:"administrador",
    TECNICO:"estandar",
    SOLICITANTE:"invitado",
}
const ESTADO_PETICION={
    ESPERA:'ESPERA',
    ACEPTADA:'ACEPTADA'
}

const dataActividades=ObtenerActividades();
const dataUsuarios=ObtenerUsuarios();
const dataPeticiones=ObtenerPeticion();


//contar numero de actividades
$("#num_actividades").html(FilterArrayActividades(dataActividades));
$("#num_actividades_iniciadas").html(FilterArrayActividades(dataActividades,TIPO_ACTIVIDAD.INICIADA));
$("#num_actividades_proceso").html(FilterArrayActividades(dataActividades,TIPO_ACTIVIDAD.PROCESO));
$("#num_actividades_completadas").html(FilterArrayActividades(dataActividades,TIPO_ACTIVIDAD.COMPLETADA));
$("#num_actividades_suspendidas").html(FilterArrayActividades(dataActividades,TIPO_ACTIVIDAD.SUSPENDIDA));

//contar numero de usuarios
$("#num_usuarios").html(FilterArrayUsuarios(dataUsuarios));
$("#num_usuarios_administradores").html(FilterArrayUsuarios(dataUsuarios,TIPO_USUARIO.ADMINISTRADOR));
$("#num_usuarios_solicitantes").html(FilterArrayUsuarios(dataUsuarios,TIPO_USUARIO.SOLICITANTE));
$("#num_usuarios_tecnicos").html(FilterArrayUsuarios(dataUsuarios,TIPO_USUARIO.TECNICO));

//contar numero de peticiones
$("#num_peticiones").html(FilterArrayPeticiones(dataPeticiones));
$("#num_peticiones_espera").html(FilterArrayPeticiones(dataPeticiones,ESTADO_PETICION.ESPERA));
$("#num_peticiones_aceptadas").html(FilterArrayPeticiones(dataPeticiones,ESTADO_PETICION.ACEPTADA));

graficoActividadesAno();
graficoActividadesPorEstado();
graficaDonaUsuarios(dataUsuarios);
graficaBarraPeticion(dataPeticiones);