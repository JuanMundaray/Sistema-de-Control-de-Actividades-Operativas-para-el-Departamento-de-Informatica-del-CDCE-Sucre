centinela=true;

	function inicio(){
		//Creacion del menu lateral en html
		var nav_aside=document.querySelector("#menuLateral");
		nav_aside.innerHTML=`
		<ul>
			<li>
				<div>
					<a class="row" href='Dashboard.php'>
						<figure class="col-md-1"><img src="./Resources/png/512/ios7-briefcase.png" class="icons-menudeslizante"></figure>
						<span class="col">Dashboard</span>
					</a>
				</div>
			</li>

			<li>
				<div>
					<a class="row" href='actividades-registrar-actividad-1.php'>
						<figure class="col-md-1"><img src="./Resources/png/512/archive.png" class="icons-menudeslizante"></figure>
						<span class="col">Registrar Actividad</span>
					</a>
				</div>
			</li>
			
			<li>
				<div>
					<a class="row" href='actividades-registradas-propias.php'>
						<figure class="col-md-1"><img src="./Resources/png/512/folder.png" class="icons-menudeslizante"></figure>
						<span class="col">Mis Actividades Registradas</span>
					</a>
				</div>
			</li>
			
			<li>
				<div>
					<a class="row" href='actividades-registradas.php'>
						<figure class="col-md-1"><img src="./Resources/png/512/ios7-paper.png" class="icons-menudeslizante"></figure>
						<span class="col">Actividades Registradas</span>
					</a>
				</div>
			</li>

			<li>
				<div>
					<a class="row" href='peticiones-registradas.php'>
						<figure class="col-md-1"><img src="./Resources/png/512/ios7-box.png" class="icons-menudeslizante"></figure>
						<span class="col">Lista de Peticiones</span>
					</a>
				</div>
			</li>

			<li>
				<div>
					<a class="row" href='#'.php'>
						<figure class="col-md-1"><img src="./Resources/png/512/ios7-printer.png" class="icons-menudeslizante"></figure>
						<span class="col">Generar Reportes</span>
					</a>
				</div>

				<ul>
					<li>
						<a class="row" href='generar_reporte_actividad.php'><span class="col">Generar Reportes de Actividades</span></a>
					</li>
					<li>
						<a class="row" href='generar_reporte_peticiones.php'><span class="col">Generar Reportes de Peticiones</span></a>
					</li>
				</ul>
			</li>
			<li>
				<div>
					<a class="row" href='cerrar-sesion.php'>
						<figure class="col-md-1"><img src="./Resources/png/512/ios7-close.png" class="icons-menudeslizante"></figure>
						<span class="col">Cerrar Sesion</span>
					</a>
				</div>
			</li>
		</ul>`;
			boton_desplegar=document.querySelector("#boton_despliegue");
			boton_desplegar.addEventListener("click", () =>{//funcion arrow que determina las funciones del boton que
				
				//despliega el menu
				const contenido=document.querySelector("main");

				switch(centinela) {//Esto es lo que hara el boton para desplegar el menu y al cerrarlo
					
					case true://funcionalidad del boton al presionarlo sin desplegar el menu aun

						contenido.style.cssText=
						`-webkit-transition:1s;
						-o-transition:1s;
						-moz-transition:1s;
						-ms-transition:1s;
						left:-100px;`;

						nav_aside.style.cssText=
						"-webkit-transition:1s;-o-transition:1s;-moz-transition:1s;-ms-transition:1s;left:-250px;";
						centinela=false;
						break;
						
					case false://funcionalidad del boton al presionarlo con el menu desplegado
						contenido.style.cssText=
						"-webkit-transition:1s;-o-transition:1s;-moz-transition:1s;-ms-transition:1s;left:0px;";

						nav_aside.style.cssText=
						"-webkit-transition:1s;-o-transition:1s;-moz-transition:1s;-ms-transition:1s;left:0px;";
						centinela=true;
						break;
					}
						}	
							);}

window.addEventListener("load",inicio,false);