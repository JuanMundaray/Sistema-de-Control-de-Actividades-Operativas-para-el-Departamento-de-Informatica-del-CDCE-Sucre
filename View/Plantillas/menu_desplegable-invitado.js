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
					<a class="row" href='peticiones-crear.php'>
						<figure class="col-md-1"><img src="./Resources/png/512/ios7-compose.png" class="icons-menudeslizante"></figure>
						<span class="col">Hacer Petición de Actividad</span>
					</a>
				</div>
			</li>

			<li>
				<div>
					<a class="row" href='peticiones-registradas-propias.php'>
						<figure class="col-md-1"><img src="./Resources/png/512/ios7-box.png" class="icons-menudeslizante"></figure>
						<span class="col">Mis Peticiones</span>
					</a>
				</div>
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