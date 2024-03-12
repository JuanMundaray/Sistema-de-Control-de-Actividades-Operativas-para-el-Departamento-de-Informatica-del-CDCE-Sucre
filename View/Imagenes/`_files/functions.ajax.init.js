
var dato_usuario = ""
$modal = $('#modal_login').modal({show: false});
$('#modal_login').modal({show: false});

$(document).ready(function(){
	var timeSlide = 500;
	var timeFadeOut = 500;

	var timeLoginSucces = 5;
	var timeLoginFail = 3000;
	var timeLoadHtml = 50;
	var timeExitSession = 10;
	
	var login_cedula = $('#user_name').attr('oculto');
	var userced = $('#user_name').attr('ocultoced');
	
	var usernombre = $('#name_user').html();
	var cargouser = $('#cargo_user').html();
	var dptouser = $('#dep_receptor_user').html();
	var userestatus = $('#estatus_loading').attr('estatus');

	var login_cedula = $('#user_name').attr('oculto');
	
	// var userced = $('#user_name').attr('ocultoced');
	var sesionencode = $('#user_name').attr('sesionencode');
	// **********************
	var parametros_user = 'dptouser='+dptouser + '&cargouser='+cargouser + '&userestatus='+userestatus +  '&userced='+userced + '&sesionencode='+sesionencode+'&relleno=valor';

	hora();

	 // ######   ####   #####   #    #      #####   ######       ####   ######   ####   #   ####   #    # 
	 // #       #    #  #    #  ##  ##      #    #  #           #       #       #       #  #    #  ##   # 
	 // #####   #    #  #    #  # ## #      #    #  #####        ####   #####    ####   #  #    #  # #  # 
	 // #       #    #  #####   #    #      #    #  #                #  #            #  #  #    #  #  # # 
	 // #       #    #  #   #   #    #      #    #  #           #    #  #       #    #  #  #    #  #   ## 
	 // #        ####   #    #  #    #      #####   ######       ####   ######   ####   #   ####   #    # 
	                                                                                                   
	// INICIO DE SESI�N
	
	$('#iniciarsesion' ).on("click", function(event){

		var ced = $('#login_cedula').val();
		var pas = $('#login_passwd').val();

		$('#modal_login').modal('show');

	});

	// #  #    #  #   ####   #   ####        ####   ######   ####   #   ####   #    # 
	// #  ##   #  #  #    #  #  #    #      #       #       #       #  #    #  ##   # 
	// #  # #  #  #  #       #  #    #       ####   #####    ####   #  #    #  # #  # 
	// #  #  # #  #  #       #  #    #           #  #            #  #  #    #  #  # # 
	// #  #   ##  #  #    #  #  #    #      #    #  #       #    #  #  #    #  #   ## 
	// #  #    #  #   ####   #   ####        ####   ######   ####   #   ####   #    # 
	                                                                                		
	//	**** BOTON LOGIN USER (INGRESAR) EN index.php
	
    $('#login_userbttn').on("click", function(event){

    	// console.log("accion  ->  " + $(this).attr('id') + "  ->  " + $(this).text() );
    	//  
			var login_cedula = $('#login_cedula').val();
			// var login_plantel = $('#login_plantel').val();
			// var login_nomina = $('#login_nomina').val();
			var login_passwd = $('#login_passwd').val();

			if ( login_cedula != "" && login_passwd != "" ){
			// if ( $('#login_cedula').val() != "" || $('#login_plantel').val() != "" || $('#login_nomina').val() != ""  || $('#contrasenia').val() != "" ){
				$('#content').html('<span class="timer" id="timer"></span>Cargando por favor espere');
				$.ajax({
					type: 'POST',
					url: 'servicios/log.inout.ajax.php',
					// data: 'login_cedula=' + login_cedula + '&login_plantel=' + login_plantel + '&login_nomina=' + login_nomina  + '&login_passwd=' + login_passwd ,
					data: 'login_cedula=' + login_cedula + '&login_passwd=' + login_passwd ,
					success:function(response){
						console.log("response ");
						console.log(response);
						if ( response== 1 ){
							$('#content').html('<span class="timer" id="timer"></span> ' + msj('ini_sat'));
							redireccion(1,timeLoginSucces);
						}else{
							$('#content').html('<i id="timer" class="fa fa-user-times"></i> ' + msj('ini_err'));
							redireccion(0,timeLoginFail);
						}
					},
					error:function(){
						$('#content').html('<i id="timer" class="fa fa-warning"></i> ' + msj('ini_fal'));
						redireccion();
					}
				});
			}else{
				$('#content').html('<i id="timer" class="fa fa-user-times"></i> ' + msj('ing_cam'));
				alert("Debe ingresar todos los campos");
				redireccion(0,10);
			}
		//},timeSlide);
		return false;
	});


	// #  #    #  #   ####   #   ####        ####   ######   ####   #   ####   #    # 
	// #  ##   #  #  #    #  #  #    #      #       #       #       #  #    #  ##   # 
	// #  # #  #  #  #       #  #    #       ####   #####    ####   #  #    #  # #  # 
	// #  #  # #  #  #       #  #    #           #  #            #  #  #    #  #  # # 
	// #  #   ##  #  #    #  #  #    #      #    #  #       #    #  #  #    #  #   ## 
	// #  #    #  #   ####   #   ####        ####   ######   ####   #   ####   #    # 


    $('#login_admin_userbttn').on("click", function(event){

    	// console.log("accion  ->  " + $(this).attr('id') + "  ->  " + $(this).text() );

		//setTimeout(function(){
			// var login_cedula = $('#login_cedula').val();
			// var login_plantel = $('#login_plantel').val();
			// 
			var login_admin = $('#login_admin').val();
			var pass_admin  = $('#pass_admin').val();
			var login_capcha = rand_code();

			if ( login_admin != "" && pass_admin != "" ){
				$('#content').html('<span class="timer" id="timer"></span>Cargando por favor espere');
				$.ajax({
					type: 'POST',
					url: 'servicios/log.inout.admin.ajax.php',
					data: 'login_admin=' + login_admin + '&pass_admin=' + pass_admin + '&login_capcha=' + login_capcha ,
					success:function(response){
						console.log("response ");
						console.log(response);
						if ( response== 1 ){
							$('#content').html('<span class="timer" id="timer"></span> ' + msj('ini_sat'));
							redireccion(1,timeLoginSucces);
						}else{
							$('#content').html('<i id="timer" class="fa fa-user-times"></i> ' + msj('ini_err'));
							redireccion(0,timeLoginFail);
						}
					},
					error:function(){
						$('#content').html('<i id="timer" class="fa fa-warning"></i> ' + msj('ini_fal'));
						redireccion();
					}
				});
			}else{
				$('#content').html('<i id="timer" class="fa fa-user-times"></i> ' + msj('ing_cam'));
				alert("Debe ingresar todos los campos");
				redireccion(0);
			}
		//},timeSlide);
		return false;
	});

	
	
	//	Eventos asociados a la pagina main.php
	//	Eventos asociados a la pagina main.php
	//	Eventos asociados a la pagina main.php

	//* * * * * * * * * * * * * * * * * * *
	//* * * * * * * * * * * * * * * * * * *
	//* * * * * * * * * * * * * * * * * * *
	//* * * * * * * * * * * * * * * * * * *
	//* * * * * * * * * * * * * * * * * * *

	 // #######                                                                  #####                                                                  
	 // #        #    #  #    #   ####   #   ####   #    #  ######   ####       #     #  ######  #    #  ######  #####     ##    #       ######   ####  
	 // #        #    #  ##   #  #    #  #  #    #  ##   #  #       #           #        #       ##   #  #       #    #   #  #   #       #       #      
	 // #####    #    #  # #  #  #       #  #    #  # #  #  #####    ####       #  ####  #####   # #  #  #####   #    #  #    #  #       #####    ####  
	 // #        #    #  #  # #  #       #  #    #  #  # #  #            #      #     #  #       #  # #  #       #####   ######  #       #            # 
	 // #        #    #  #   ##  #    #  #  #    #  #   ##  #       #    #      #     #  #       #   ##  #       #   #   #    #  #       #       #    # 
	 // #         ####   #    #   ####   #   ####   #    #  ######   ####        #####   ######  #    #  ######  #    #  #    #  ######  ######   ####  
	                                                                                                                                                 
	                                                                                                                                                 
	// //	* * * * * * Funciones generales * * * * * *
	// //	* * * * * * Funciones generales * * * * * *
	// //	* * * * * * Funciones generales * * * * * *

	// /* @description Permite cargar una Vista HTML con su archivo JS
	//  * @param {String} vista URL de la vista html
	//  * @param {String} controlador URL del controlador JS
	//  * @param {String} nivel Valor del Breadcund Nivel
	//  * @param {String} subnivel Valor del Breadcund subnivel
	//  */
	// function CargarHtml(vista,controlador,contenedor,subnivel,parametros) {
	// 	//console.log(parametros);
	// 	controlador || ( controlador = null ) ;
	// 	contenedor || ( contenedor = '#content') ;
	// 	parametros || ( parametros = '') ;
	// 	//console.log(parametros);
	// 	var dato_usuario = parametros;
		
	// 	$(contenedor).html('<span class="timer" id="timer"></span>Cargando por favor espere');
	// 	// * * * * * * * * * * * * * * * * * * * * * * *
	// 	//Cargamos el Archivo HTML/PHP
	// 	$.ajax({
	// 		type: 'POST',
	// 		url: vista,
	// 		//encoding:"UTF-8",
	// 		//contentType: "charset=utf-8", 
	// 		//data: 'name_user='+name_user+'&foto_user='+foto_user+'&token1='+rand_code(),
	// 		data: parametros + 'token1='+rand_code(),
	// 		success:function(response){
	// 			$('#breadcrumb_subnivel').html(subnivel);
	// 			$('#header_principal').html(subnivel);
				
	// 			$(contenedor).html(response);
	// 			if (controlador!=null) {
	// 				CargarJS(controlador)
	// 			}
	// 		},
	// 		error:function(){
	// 			$(contenedor).html('<span class="timer" id="timer"></span>' + msj('res_err'));
	// 			MostrarNotificacion(msj('res_err'));
	// 			redireccion(1,5000);
	// 		}
	// 	});
	// }
	// /* @description Permite cargar una Vista HTML con su archivo JS
	//  * @param {String} vista URL de la vista html
	//  * @param {String} controlador URL del controlador JS
	//  * @param {String} contenedor Nombre del Contenedor
	//  * @param {String} parametro Parametros adicionales
	//  */
	// function CargarHtmlSencillaDiv1(vista,controlador,contenedor,parametros) {
	// 	// console.info(vista,controlador,contenedor,parametros);
	// 	alert(vista,controlador,contenedor,parametros);
	// 	$(contenedor).html('<span class="timer" id="timer"></span>Cargando por favor espere');
	// 	$.ajax({
	// 		type: 'POST',
	// 		url: vista,
	// 		data: parametros + 'token1='+rand_code(),
	// 		success:function(response){
	// 			$(contenedor).hide()
	// 			$(contenedor).html(response);
	// 			$(contenedor).fadeIn()
	// 			if (controlador!=null) {
	// 				CargarJS2(controlador)
	// 			}
	// 		},
	// 		error:function(){
	// 			$(contenedor).html('<span class="timer" id="timer"></span>' + msj('res_err'));
	// 			MostrarNotificacion(msj('res_err'));
	// 			// // redireccion(1,5000);
	// 		}
	// 	});
	// }
	// /* @description Permite cargar una Vista HTML con su archivo JS
	//  * @param {String} vista URL de la vista html
	//  * @param {String} controlador URL del controlador JS
	//  * @param {String} contenedor Nombre del Contenedor
	//  * @param {String} parametro Parametros adicionales
	//  */
	// function CargarHtmlSencilla(vista,controlador,contenedor,parametros) {
	// 	controlador || ( controlador = null ) ;
	// 	contenedor || ( contenedor = '#content') ;
	// 	parametros || ( parametros = '') ;
	// 	$(contenedor).html('<span class="timer" id="timer"></span>Cargando por favor espere');
	// 	// * * * * * * * * * * * * * * * * * * * * * * *
	// 	//Cargamos el Archivo HTML/PHP
	// 	$.ajax({
	// 		type: 'POST',
	// 		url: vista,
	// 		data: parametros + 'token1='+rand_code(),
	// 		success:function(response){
	// 			$(contenedor).html(response);
	// 			if (controlador!=null) {
	// 				CargarJS(controlador)
	// 			}
	// 		},
	// 		error:function(){
	// 			$(contenedor).html('<span class="timer" id="timer"></span>' + msj('res_err'));
	// 			MostrarNotificacion(msj('res_err'));
	// 			// redireccion(1,5000);
	// 		}
	// 	});
	// }
	// /* @description Permite cargar una Vista HTML con su archivo JS
	//  * @param {String} vista URL de la vista html
	//  * @param {String} controlador URL del controlador JS
	//  * @param {String} nivel Valor del Breadcund Nivel
	//  * @param {String} subnivel Valor del Breadcund subnivel
	//  */
	// function CargarHtmlInicio(vista,controlador,contenedor,subnivel) {
	// 	controlador || ( controlador = null ) ;
	// 	var name_user = $('#name_user').text();
	// 	var foto_user    = $('#foto_user').attr('src');
	// 	$('#content').html('<span class="timer" id="timer"></span>Cargando por favor espere');
	// 	// * * * * * * * * * * * * * * * * * * * * * * *
	// 	//Cargamos el Archivo HTML/PHP
	// 	$.ajax({
	// 		type: 'POST',
	// 		url: vista,
	// 		//encoding:"UTF-8",
	// 		//contentType: "charset=utf-8", 
	// 		data: 'name_user='+name_user+'&foto_user='+foto_user+'&token1='+rand_code(),
	// 		success:function(response){
	// 			$('#breadcrumb_subnivel').html(subnivel);
	// 			$('#content').html(response);
	// 			if (controlador!=null) {
	// 				CargarJS(controlador)
	// 			}
	// 		},
	// 		error:function(){
	// 			$('#content').html('<span class="timer" id="timer"></span>' + msj('res_err'));
	// 			MostrarNotificacion(msj('res_err'));
	// 			redireccion(1,1000);
	// 		}
	// 	});
	// }
	
	// function Consulta_Ajax_Modal(accion,servicio,parametros,contenedor) {
	// 	//console.log("Consulta_Ajax");
	// 	accion || ( accion = null ) ;
	// 	servicio || ( servicio = null ) ;
	// 	parametros || ( parametros = '') ;
	// 	contenedor || ( contenedor = '#content') ;
	// 	//servicio = "servicios/servicios.admin.cargos.php?nocache=" + Math.random();
	// 	$(contenedor).html('<span class="timer" id="timer"></span>Enviando datos... por favor espere');
	// 	// * * * * * * * * * * * * * * * * * * * * * * *
	// 	//Cargamos el Archivo HTML/PHP    
	// 	$.ajax({
	// 		type: 'POST',
	// 		url: servicio,
	// 		//encoding:"UTF-8",
	// 		//contentType: "charset=utf-8", 
	// 		data: parametros + "&token1="+rand_code(),
	// 		success:function(response){
	// 			$(contenedor).html(response);
	// 		},
	// 		error:function(){
	// 			$(contenedor).html('<span class="timer" id="timer"></span>' + msj('res_err'));
	// 			MostrarNotificacion(msj('res_err'));
	// 			redireccion(1,10000);
	// 		}
	// 	});    
	// }

	// /* @description Permite cargar un archivo JS
	//  * @param {String} controlador URL del controlador JS
	//  */
	// function CargarJS(controlador) {
	// 	//code
	// 	// * * * * * * * * * * * * * * * * * * * * * * *
	// 	//Cargamos el Archivo JS
	// 	// console.info(controlador);
	// 	$.getScript(controlador)
	// 	.done(function( script, textStatus ) {
	// 		//console.log( textStatus );
	// 	})
	// 	.fail(function( jqxhr, settings, exception ) {
	// 		//$( "#div.log" ).text( "Triggered ajaxError handler." );
	// 		// console.log(jqxhr);
	// 		// console.log(settings);
	// 		// console.log(exception);
	// 		MostrarNotificacion('CargarJS Triggered ajax Error handler.');
	// 	});
	// }
	// /*
	// 	pruebafuncion
	//  */
	// function pruebafuncion() {
	// 	//code
	// 	console.log("pruebafuncion");
	// }
	// /*
	// 	redireccion
	//  */
	function redireccion(link,tiempo){
		//console.log('redireccionando ' + hora() );
		link || ( link = 0) ;
		tiempo || ( tiempo = 500 );
		if (link==0) {
			link='servicios/logout.php';
		}
		if (link==1) {
			link='main.php';
		}
		setTimeout(function(){
			window.location.href = link;
		},(timeSlide + tiempo));
	}

	// function SessionKiller() {
	// 	var mensajesalir = tildes_unicode('Cerrando la sesi�n');
	// 	$('#content').html('<span class="timer" id="timer"></span>' + msj('ini_out'));
	// 	$('#timer').fadeIn(300);
	// 	$('#alertBoxes').html('<div class="box-success"></div>');
	// 	$('.box-danger').hide(0).html('Espera un momento&#133;');
	// 	$('.box-danger').slideDown(timeSlide);
	// 	redireccion(0,10);
	// }
});

// *****************************************************************************************
// *****************************************************************************************
// *****************************************************************************************
//  ___            __     __        ___  __      ___     ___  ___  __             __
// |__  |  | |\ | /  ` | /  \ |\ | |__  /__`    |__  \_/  |  |__  |__) |\ |  /\  /__`     /\
// |    \__/ | \| \__, | \__/ | \| |___ .__/    |___ / \  |  |___ |  \ | \| /~~\ .__/    /~~\

//  __   __   __              ___      ___      __   ___       __
// |  \ /  \ /  ` |  |  |\/| |__  |\ |  |      |__) |__   /\  |  \ \ /
// |__/ \__/ \__, \__/  |  | |___ | \|  |  .   |  \ |___ /~~\ |__/  |
// 
// *****************************************************************************************
// *****************************************************************************************
// *****************************************************************************************


// function pruebafuncion2() {
// 	//code
// 	console.log("pruebafuncion2");
// }
// /* @description Permite cargar una Vista HTML con su archivo JS
//  * @param {String} vista URL de la vista html
//  * @param {String} controlador URL del controlador JS
//  * @param {String} contenedor Nombre del Contenedor
//  * @param {String} parametro Parametros adicionales
//  */
// function CargarHtmlSencillaDiv2(vista,controlador,contenedor,parametros) {
// 	// console.info(vista,controlador,contenedor,parametros);
// 	// alert(vista,controlador,contenedor,parametros);
// 	$(contenedor).html('<span class="timer" id="timer"></span>Cargando por favor espere');
// 	$.ajax({
// 		type: 'POST',
// 		url: vista,
// 		data: parametros + 'token1='+rand_code(),
// 		success:function(response){
// 			$(contenedor).hide()
// 			$(contenedor).html(response);
// 			$(contenedor).fadeIn()
// 			if (controlador!=null) {
// 				CargarJS2(controlador)
// 			}
// 		},
// 		error:function(){
// 			// $(contenedor).html('<span class="timer" id="timer"></span>' + msj('res_err'));
// 			MostrarNotificacion(msj('res_err'));
// 			// // redireccion(1,5000);
// 		}
// 	});
// }
// function CargarHtmldiv() {
// 	console.info('CargarHtmldiv');
// }
// /* @description Permite cargar un archivo JS
//  * @param {String} controlador URL del controlador JS
//  */
// function CargarJS2(controlador) {
// 	//code
// 	// * * * * * * * * * * * * * * * * * * * * * * *
// 	//Cargamos el Archivo JS
// 	$.getScript( controlador)
// 	.done(function( script, textStatus ) {
// 		//console.log( textStatus );
// 	})
// 	.fail(function( jqxhr, settings, exception ) {
// 		//$( "#div.log" ).text( "Triggered ajaxError handler." );
// 		MostrarNotificacion('CargarJS Triggered ajax Error handler.');
// 	});
// }
//  @description Consulta Ajax retorna arreglo en json
//  * @param {accion} valor del accion
//  * @param {servicio} url del sercvio php
//  * @param {parmetros} parametros adicionales 
 
// function Consulta_Ajax_JSON(accion,servicio,parametros) {
// 	//console.log("Consulta_Ajax");
// 	accion || ( accion = null ) ;
// 	servicio || ( servicio = null ) ;
// 	parametros || ( parametros = '') ;
// 	// console.log(accion,servicio);
// 	// console.log(parametros);
// 	//contenedor || ( contenedor = '#content') ;
// 	//servicio = "servicios/servicios.admin.cargos.php?nocache=" + Math.random();
// 	//$(contenedor).html('<span class="timer" id="timer"></span>Enviando datos... por favor espere');
// 	// * * * * * * * * * * * * * * * * * * * * * * *
// 	//Cargamos el Archivo HTML/PHP    
// 	$.ajax({
// 		type: 'POST',
// 		url: servicio,
// 		//encoding:"UTF-8",
// 		//contentType: "charset=utf-8", 
// 		data: parametros + "&token1="+rand_code(),
// 		success:function(response){
// 			//console.log(response);
// 			//var objeto = JSON.parse(response);
// 			//console.log(objeto);
// 			return(response)
// 			//$('#content').html(JSON.parse(response));
// 		},
// 		error:function(){
// 			//$(contenedor).html('<span class="timer" id="timer"></span>' + msj('res_err'));
// 			MostrarNotificacion(msj('res_err'));
// 			//redireccion(1,10000);
// 		}
// 	});    
// }
// // 
// function existeUrl(url) {
// 	var http = new XMLHttpRequest();
// 	http.open('HEAD', url, false);
// 	http.send();
// 	return http.status!=404;
// }
// // * * * * * * Chuletarios * * * * * * * * *
// // * * * * * * Chuletarios * * * * * * * * *
// // * * * * * * Chuletarios * * * * * * * * *

// //    class="content' 	-> $('.content')
// //    id="content' 	-> $('#content')

// //var valorInput = $("#unInput").val();
// //var valorSpan = $("#unSpan").text();
// //var valorDiv = $("#unDiv").html();

//  __        __                  ___  __  ___
// /__` |__| /  \ |  |  /\  |    |__  |__)  |
// .__/ |  | \__/ |/\| /~~\ |___ |___ |  \  |
// 
function showAlert(title, type) {
    $alert.attr('class', 'alert alert-' + type || 'success')
          .html('<i class="glyphicon glyphicon-check"></i> ' + title).show();
    setTimeout(function () {
        $alert.hide();
    }, 5000);
}

function showModalName(ventana,title,row) {
  ventana.find('.modal-title').html(title);
  ventana.modal('show');
}