/* Libreria de funciones propias para boostrat 3 y jquery 2.14 con template AdminLTE-2.3.0
 * @author Oswaldo Hernández
 * @version 2.0
 * @requires Boostrap 3
 * @requires Jquery  2.1.4
 */
var timeSlide = 1000;
var timeFadeOut = 10000;
var valores = [];
var indice = -1;

	/**
	 *	@author Oswaldo Hernández
	 *	@description Permite mostrar un mensaje de notificación en un objeto tipo box
	 *	@description 
	 *	@param {String} mensaje Mesaje texto a mostrar
	 *	@param {String} titulo: Titulo de la no notificación. Default: Notificaciones 
	 *	@param {String} estado Indica si el box se permanece fijo o se oculta automaticamente. estado 'fijo': box fijo; 'ocultar': oculta el box
	 *	@example MostrarNotificacion('Campo Obligarorio','Titulo del Mensaje','fijo');
	 *	@example MostrarNotificacion('Valor Incorrecto');
	 *	@returns Muestra el mensaje en el objeto #alertBoxes  #box-header #box-body
	 */
	function MostrarNotificacion(mensaje,ocultar,titulo,color) {
		//code
		mensaje || ( mensaje = 'Procesando por favor espere' );
		ocultar || ( ocultar = 0 );
		titulo || ( titulo = 'Notificaciones' );
		color || ( color = 'box box-danger' );
		if (color=='azul') { //box-primary'
			$('#alertBoxes').toggleClass('box-danger box-primary'); // azul
		}
		if (color=='verde') { //box-success'
			$('#alertBoxes').toggleClass('box-danger box-success'); // verde
		}
		//class="box box-danger"
		setTimeout(function(){
			//$('#alertBoxes').show();
			$('#box-header').html(titulo);
			$('#box-body').html('<span class="timer" id="timer"  style="margin-left: 5px;"></span>'+mensaje);
			//$('#alertBoxes').fadeIn(timeSlide);
			$('#alertBoxes').slideDown(timeSlide);
			//$('#alertBoxes').slideUp(timeSlide);
			//$('#alertBoxes').slideToggle(timeSlide);
		},500);
		if (ocultar==0) {		
			setTimeout(function(){
				OcultarNotificacion();
			},5000);
		}								
	}
	/*
	 * @author Oswaldo Hernández
	 *	@description Permite ocultar el mensaje de notificación en un objeto tipo box
	 */
	function OcultarNotificacion() {
		//code
		//setTimeout(function(){
			if ( $('#alertBoxes').hasClass('box-success') )
				$('#alertBoxes').toggleClass('box-success box-warning');
			if ( $('#alertBoxes').hasClass('box-primary') )
				$('#alertBoxes').toggleClass('box-primary box-warning');
			if ( $('#alertBoxes').hasClass('box-danger') )
				$('#alertBoxes').toggleClass('box-danger box-warning');	
			//$('#alertBoxes').fadeOut(500);
			$('#alertBoxes').slideToggle(timeSlide);
			console.log('ocultando notificación')
		//},timeFadeOut);
	}
	/*
	 * @author Oswaldo Hernández
	 * @description Permite mostrar mensaje de notificación que se cierra automaticamente
	 * @param title Titulo/Valor del mensaje
	 * @param type Tipo de diseño dle mensaje: default:success
	 */
	function showAlert(title, type) {
		time = 10000; // 20 segundos
        $alert.attr('class', 'alert alert-' + type || 'success')
              .html('<i class="glyphicon glyphicon-check"></i> ' + title).show();
        setTimeout(function () {
            $alert.hide();
        }, time);
    }

	
	/*
	 Retorna un mensaje preestablecido
	 @param {String} mensaje
	 @returns {String} texto
	 @example msj('ing_ced')
	 @argument
	 ing_val = Debe ingresar un Valor
	 ing_ced = Debe ingresar Cédula
	 ing_cam = Debe ingresar todos los Campos
	 ing_cod = Debe ingresar un Código
	 cam_obl = Debe ingresar todos los Campos
	 val_ent = Debe ingresar un valor entero
  fec_val = Fecha no Vá1lida
  no_exis = No existe
  si_exis = Registro ya existe
  sel_opc = Debe seleccionar una opción
  res_exi = Operación Satisfactoria
  res_fal = Operación No Completada
  con_asi = Desea asignar este recurso
  con_pen = Desea registrar como pendiente este recurso
  default = Procesando Información del Sistema			
 */
function msj(mensaje,mensaje2) {
	mensaje2 = mensaje2 || '';
	var texto;
	switch (mensaje)
	{
		case 'ing_val':
			texto = 'Debe ingresar un Valor'; //
			break;		
		case 'ing_ced':
			texto = 'Debe ingresar C\u00e9dula'; //Cédula
			break;
		case 'ing_cam':
			texto = 'Debe ingresar todos los Campos';
			break;
		case 'ing_cod':
			texto = 'Debe ingresar un C\u00f3digo';
			break;
		case 'cam_obl':
			texto = 'Debe ingresar todos los Campos Obligatorios';
			break;
		case 'val_ent':
			texto = 'Debe ingresar un valor entero';
			break;
		case 'fec_val':
			texto = 'Fecha no V\u00e1lida';	//Vá1lida
			break;
		case 'no_exis':
			texto = 'No existe';
			break;
		case 'si_exis':
			texto = 'Registro ya existe';
			break;
		case 'sel_opc':
			texto = 'Debe seleccionar una opci\u00f3n';
			break;
		case 'conf_add':
			texto = 'Desea registrar los datos';
			break;
		case 'conf_mod':
			texto = 'Desea modificar los datos';
			break;
		case 'conf_del':
			texto = 'Desea eliminar los datos';
			break;
		case 'conf_con':
			texto = 'Desea continuar';
			break;
		case 'res_exi':
			texto = 'Operaci\u00f3n Satisfactoria';
			break;
		case 'res_fal':
			texto = 'Operaci\u00f3n No Completada';
			break;
		case 'res_err':
			texto = 'Ha ocurrido un error durante la ejecuci\u00f3n';
			break;		
		case 'con_asi':
			texto = 'Desea asignar este recurso';
			break;
		case 'con_pen':
			texto = 'Desea registrar como pendiente este recurso';
			break;
		case 'car_lib':
			texto = 'Desea cargar este recurso al inventario';
			break;		
		case 'ing_log':
			texto = 'Debe ingresar Login de Usuario';
			break;
		case 'ing_pwd':
			texto = 'Debe ingresar Password de Usuario';
			break;
		case 'ing_sel':
			texto = 'Debe seleccionar un Valor'; //
			break;
		case 'conf_gen':
			texto = 'Desea generar Calendarios'; //
			break;
		case 'conf_avc':
			texto = 'Desea cargar Avances'; //
			break;
		case 'conf_pag':
			texto = 'Antes de Imprimir debe configurar la \nOrientaci\u00f3n del papel adecuadamente'; //
			break;
		case 'ini_ses':
			texto = 'Iniciar Sesi\u00f3n'; //
			break;
		case 'ini_err':
			texto = tildes_unicode('Inicio  de sesión no válido'); //
			break;
		case 'ini_sat':
			texto = tildes_unicode('Inicio  de sesión satisfactorio'); //
			break;
		case 'ini_fal':
			texto = tildes_unicode('Ha ocurrido un error durante la ejecución'); //
			break;
		case 'ini_out':
			texto = tildes_unicode('Cerrando la sesión'); //
			break;		
		default:
			texto = 'Procesando Informaci\u00f3n del Sistema';
			break;		
	}
	if (mensaje2 != '') {
		texto = texto + "\n" + mensaje2;	
	}
	return texto;
}

/**
 Permite mostrar un mensaje de confirmación 
 @param {String} mensaje
 @example confirmar('conf_add')
 @returns True/False
 Valores permitidos:
  - 'conf_add' = Desea registrar los datos
  - 'conf_mod' = Desea modificar los datos
  - 'conf_del' = Desea eliminar los datos
 Cualquier otro muestra
  - 'con_con' = Desea continuar
 */
function confirmar(mensaje1, mensaje2) {
	mensaje2 = mensaje2 || '';
	//alert (mensaje2);
	if ( mensaje2 == '' ) {
		//mensaje1 = mensaje1 + "\n" + mensaje2 ;		
		var answer = confirm (msj(mensaje1))
	}else{
		var answer = confirm (msj(mensaje1,mensaje2))
	}
	//var answer = confirm (msj(mensaje1))
	if (answer) return true	
	return false
}  


function rand_code(){
	chars = "0123456789abcdefABCDEF?¿¡!:;"; 
	lon = 20;
	code = "";
	for (x=0; x < lon; x++) 	{
		rand = Math.floor(Math.random()*chars.length);
		code += chars.substr(rand, 1);
	}
	return code;
}

function randomstring(L){
    var s= '';
    var randomchar=function(){
        var n= Math.floor(Math.random()*62);
        if(n<10) return n; //1-10
        if(n<36) return String.fromCharCode(n+55); //A-Z
        return String.fromCharCode(n+61); //a-z
    }
    while(s.length< L) s+= randomchar();
    return s;
}

function tildes_unicode(str){
	str = str.replace('á','\u00e1');
	str = str.replace('é','\u00e9');
	str = str.replace('í','\u00ed');
	str = str.replace('ó','\u00f3');
	str = str.replace('ú','\u00fa');

	str = str.replace('Á','\u00c1');
	str = str.replace('É','\u00c9');
	str = str.replace('Í','\u00cd');
	str = str.replace('Ó','\u00d3');
	str = str.replace('Ú','\u00da');

	str = str.replace('ñ','\u00f1');
	str = str.replace('Ñ','\u00d1');
	return str;
}
function acentos(str) {
	//alert(str)
	var map = {
	'á':'\u00e1', 
	'é':'\u00e9',
	'í':'\u00ed',
	'ó':'\u00f3',
	'ú':'\u00fa',
	'Á':'\u00c1',
	'É':'\u00c9',
	'Í':'\u00cd',
	'Ó':'\u00d3',
	'Ú':'\u00da',
	'ñ':'\u00f1',
	'Ñ':'\u00d1'
	}
	var res=''; //Está variable almacenará el valor de str, pero sin acentos y tildes
	for (var i=0;i<str.length;i++) {
		c=str.charAt(i);
		res+=map[c]||c;
	}
	return res;
}
function fecha_actual() {
	// alert('fecha_actual');
	// console.log('fecha_actual');
// 	var f = new Date();
// 	var fecha = new Date() + 3 ;
// 	// 
// 	var dia = fecha.getDate()
// 	var mes = fecha.getMonth() + 1 // getMonth -> 0-11
// 	var anio = fecha.getFullYear()
// // 
// 	if (dia < 10 ) { dia = "0" + dia}
// 	if (mes < 10 ) { mes = "0" + mes}
// // 
// 	var fecha_texto = dia + "/" + mes + "/" + anio;
// 	return(fecha_texto);
// 	// return(f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear());
// 	// 
}

function fecha_actual2() {
	// alert('fecha_actual');
	// console.log('fecha_actual');
	var f = new Date();
	var fecha = new Date() ;
	// 
	var dia = fecha.getDate()
	var mes = fecha.getMonth() + 1 // getMonth -> 0-11
	var anio = fecha.getFullYear()
	// console.log(dia,mes,anio);
// 
	if (dia < 10 ) { dia = "0" + dia}
	if (mes < 10 ) { mes = "0" + mes}
// 
	var fecha_texto = dia + "/" + mes + "/" + anio;
	return(fecha_texto);
	// return(f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear());
	// 
}


// function SumarFecha(){
// // Función que suma o resta días a la fecha indicada
 
sumaFecha = function(d, fecha)
{
	var Fecha = new Date();
	var sFecha = fecha || (Fecha.getDate() + "/" + (Fecha.getMonth() +1) + "/" + Fecha.getFullYear());
	var sep = sFecha.indexOf('/') != -1 ? '/' : '-'; 
	var aFecha = sFecha.split(sep);
	var fecha = aFecha[2]+'/'+aFecha[1]+'/'+aFecha[0];
	fecha= new Date(fecha);
	fecha.setDate(fecha.getDate()+parseInt(d));
	var anno=fecha.getFullYear();
	var mes= fecha.getMonth()+1;
	var dia= fecha.getDate();
	mes = (mes < 10) ? ("0" + mes) : mes;
	dia = (dia < 10) ? ("0" + dia) : dia;
	var fechaFinal = dia+sep+mes+sep+anno;
	return (fechaFinal);

}

function hora(){
	////console.info(elemento)
	//elemento = "'" + elemento + "'"
	////console.info(elemento)
	//objeto = document.getElementById(elemento);
	//objeto.style.display='';
	//objeto.innerHTML = ""
	////console.info(elemento)
	var fecha = new Date()
	var hora = fecha.getHours()
	var hora_corta = fecha.getHours()
	var minuto = fecha.getMinutes()
	var segundo = fecha.getSeconds()
	
	var dia = fecha.getDate()
	var mes = fecha.getMonth() + 1 // getMonth -> 0-11
	var anio = fecha.getFullYear()
	
	//dia = 11
	//mes = 6
	//anio = 2013
	if (dia < 10 ) { dia = "0" + dia}
	if (mes < 10 ) { mes = "0" + mes}
	
	if(hora>=12 && hora<=23) {
		if (hora==12) {
			hora_corta = hora
		}else{
			hora_corta = hora - 12
		}
		m="pm"
	}else{
		m="am"
		hora_corta = hora
	}	
	if (hora_corta < 10) {hora_corta = "0" + hora_corta}
	if (minuto < 10) {minuto = "0" + minuto}
	if (segundo < 10) {segundo = "0" + segundo}
	var fecha_texto = dia + "/" + mes + "/" + anio
	var nowhora = hora_corta + ":" + minuto + ":" + segundo + " " + m
	var reloj_total = fecha_texto + " - " + nowhora ;
	//var reloj_semana_total = fecha_texto + ' ' + nowhora + ' Semana ' + ( semanadelano(fecha_texto) +1 )
	
	document.getElementById('relojservidor').firstChild.nodeValue = reloj_total
	//document.getElementById('menuleft').firstChild.nodeValue = reloj_total
	tiempo = setTimeout('hora()',1000);
	return reloj_total;
}

function dia_actual_txt(){
	var Semana = new Array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
	var fecha = new Date()
	var dia = Semana[fecha.getDay()]
	return dia
}

function hora_actual(){
	var fecha = new Date()
	var hora = fecha.getHours()
	var hora_corta = fecha.getHours()
	var minuto = fecha.getMinutes()
	var segundo = fecha.getSeconds()
	
	//if(hora>=12 && hora<=23) {
	//	if (hora==12) {
	//		hora_corta = hora
	//	}else{
	//		hora_corta = hora - 12
	//	}
	//	m="pm"
	//}else{
	//	m="am"
	//	hora_corta = hora
	//}	
	if (hora_corta < 10) {hora_corta = "0" + hora_corta}
	if (minuto < 10) {minuto = "0" + minuto}
	if (segundo < 10) {segundo = "0" + segundo}
	//var fecha_texto = dia + "/" + mes + "/" + anio
	var nowhora = hora_corta + ":" + minuto + ":" + segundo
	//var reloj_total = fecha_texto + ' ' + nowhora
	return nowhora
}


// A esta funcion se le pasa el parametro en formato fecha
// dd/mm/yyyy o dd-mm-yyyy ambos son aceptados

function semanadelano($fecha){
	$const  =  [2,1,7,6,5,4,3]; 
	// Constantes para el calculo del primer dia de la primera semana del año
	 
	if ($fecha.match(/\//)){
	  $fecha   =  $fecha.replace(/\//g,"-",$fecha);
	};
	// Con lo anterior permitimos que la fecha pasada a la funcion este
	// separada por "/" al remplazarlas por "-" mediante .replace y el uso
	// de expresiones regulares
		
	$fecha  =  $fecha.split("-");
	// Partimos la fecha en trozos para obtener dia, mes y año por separado
	$dia    =  eval($fecha[0]);
	$mes    =  eval($fecha[1]);
	$ano       =  eval($fecha[2]);   
	if ($mes!=0) {
	  $mes--;
	};
	// Convertimos el mes a formato javascript 0=enero
	
	$dia_pri   =  new Date($ano,0,1); 
	$dia_pri   =  $dia_pri.getDay();
	// Obtenemos el dia de la semana del 1 de enero
	$dia_pri   =  eval($const[$dia_pri]);
	// Obtenemos el valor de la constante correspondiente al día
	$tiempo0   =  new Date($ano,0,$dia_pri);
	// Establecemos la fecha del primer dia de la semana del año
	$dia       =  ($dia+$dia_pri);
	// Sumamos el valor de la constante a la fecha ingresada para mantener 
	// los lapsos de tiempo
	$tiempo1   =  new Date($ano,$mes,$dia);
	// Obtenemos la fecha con la que operaremos
	$lapso     =  ($tiempo1 - $tiempo0)
	// Restamos ambas fechas y obtenemos una marca de tiempo
	$semanas   =  Math.floor($lapso/1000/60/60/24/7);
	// Dividimos la marca de tiempo para obtener el numero de semanas
	 
	if ($dia_pri == 1) {
	  $semanas++;
	};
	// Si el 1 de enero es lunes le sumamos 1 a la semana caso contrarios el
	// calculo nos daria 0 y nos presentaria la semana como semana 52 del 
	// año anterior
	 
	if ($semanas == 0) {
	  $semanas=52;
	  $ano--;
	};
	// Establecemos que si el resultado de semanas es 0 lo cambie a 52 y 
	// reste 1 al año esto funciona para todos los años en donde el 1 de 
	// Enero no es Lunes
	 
	if ($ano < 10) {
	  $ano = '0'+$ano;
	};
	// Por pura estetica establecemos que si el año es menor de 10, aumente 
	// un 0 por delante, esto para aquellos que ingresen formato de fecha
	// corto dd/mm/yy
	 
	//alert($semanas+" - "+$ano);
	return $semanas;
	// Con esta sentencia arrojamos el resultado. Esta ultima linea puede ser
	// cambiada a gusto y conveniencia del lector 
};

function archivo_existe(file) {
    // initialize ActiveXObject and create an object of Scripting.FileSystemObject.
    var fso = new ActiveXObject("Scripting.FileSystemObject");
	// if condition to check whether the specified file exists or not.  
    //if (fso.FileExists("C:\\Temp\\myFolder\\file.txt")) {
	if (fso.FileExists(file)) {  
        //document.write("File.txt exists.");
		fso = true
    }  
    else {  
        //document.write("File.txt does not exist.");
		fso = false
    }  
  
    fso = null;
	return fso;
}


// recupera un objeto con los datos en el formulario
// Como recuperar los valores de un formulario con jQuery
function procesarFormulario(idFormulario)
{
	//console.log(idFormulario);
	var datos = {};
	$(idFormulario).find("input, select, textarea").each(
	function()
	{
		var $me = $(this);
		
		var campo = $me.data("campo");
		//console.log(campo);
		// si no se especificó un campo, ignoramos el elemento
		if (!campo) return;
		
		// dependiendo de que tipo de control se trate
		var valor = undefined;
		switch ($me[0].nodeName.toUpperCase())
		{
			case "TEXTAREA":
			case "LABEL":
				valor = $me.text();
				break;
			case "INPUT":
				var type = $me.attr("type").toUpperCase();
				if (type == "CHECKBOX" || type == "RADIOBUTTON")
					valor = $me.prop("checked");
				else
					valor = $me.val();
				break;
			default:
				valor = $me.val();
		}
		
		// grabamos el valor en el objeto
		if (valor != undefined)
			datos[campo] = valor;
	});
	return datos;
}


jQuery.fn.resetear = function () {
  $(this).each (function() { this.reset(); });
}

// function Extrae_Fecha_From_Mysql(fecha){
// 	fecha1 =  fecha.split(' ');
// 	fecha2 = fecha1[0].split('-');  
// //     ani_ini = fecha2[0];
// //     mes_ini = fecha2[1];
// //     dia_ini = fecha2[2];
// //     fechafin =  dia_ini + '/' mes_ini + '/' + ani_ini;
// //     return (fechafin);
// 		alert(fecha1[0]);
// }
// 
function Extrae_Fecha_From_Mysql(fecha){
    // 2016-12-31 00:48:09
    fecha1 =  fecha.split(' ');
    fecha2 = fecha1[0].split('-');  
    ani_ini = fecha2[0];
    mes_ini = fecha2[1];
    dia_ini = fecha2[2];
    fechafin =  dia_ini + '/' + mes_ini + '/' + ani_ini;
    return (fechafin);
    // 31/12/2016
}
function Extrae_Hora_From_Mysql(fecha){
    // 2016-02-03 00:48:09
    fecha1 =  fecha.split(' ');
    hora1 = fecha1[1];  
    return (hora1);
    // 00:48:09
}
/**
 * Convierte un texto de la forma 2017-01-10 a la forma
 * 10/01/2017
 *
 * @param {string} texto Texto de la forma 2017-01-10
 * @return {string} texto de la forma 10/01/2017
 *
 */
function Fecha_to_Normal(texto){
  return texto.replace(/^(\d{4})-(\d{2})-(\d{2})$/g,'$3/$2/$1');
}
//#################################################
//#################################################
function LinkCheck(url){
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false);
    http.send();
    return http.status!=404;
}
//#################################################
//#################################################
function getAbsolutePath() {
    var loc = window.location;
    var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
    return loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
}