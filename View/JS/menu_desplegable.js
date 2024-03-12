centinela=true;

	function inicio(){
		//Creacion del menu lateral en html
		var nav_aside=document.querySelector("#menuLateral");
		nav_aside.innerHTML=`
		<ul>
			<li>
				<a href='Dashboard.php'>Dashboard</a>
			</li>
			<li>
				<a href='registrar-actividad.php'>Registrar Actividad</a>
			</li>
			<li>
				<a href='tipo-actividad.php'>Tipos de Actividad</a>
			</li>
			<li>
				<a href='Actividades-Registradas.php'>Actividades Registradas</a>
			</li>
			<li>
			<a href='#'>Salir</a>
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