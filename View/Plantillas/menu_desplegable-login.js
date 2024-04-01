centinela=true;

	function inicio(){
		//Creacion del menu lateral en html
		var nav_aside=document.querySelector("#menuLateral");
		nav_aside.innerHTML=`
		<ul>
            <li>
                <a href='Inicio.php'>Página de Inicio</a>
            </li>
			<li>
				<a href='login.php'>Iniciar Sesion</a>
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