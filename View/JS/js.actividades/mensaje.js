$(document).ready(function(){     
    var w = sessionStorage.getItem('mensaje');
    if (w==1){
    	let mytoast = document.querySelector("#registrar-actividad");
    	let Toast = new bootstrap.Toast(mytoast);
        Toast.show();
        w=0;
        sessionStorage.setItem('mensaje',w);
    }else if (w==2){
    	let mytoast = document.querySelector("#eliminar-actividad");
    	let Toast = new bootstrap.Toast(mytoast);
        Toast.show();
        w=0;
        sessionStorage.setItem('mensaje',w);
    }else if (w==3){
    	let mytoast = document.querySelector("#modificar-actividad");
    	let Toast = new bootstrap.Toast(mytoast);
        Toast.show();
        w=0;
        sessionStorage.setItem('mensaje',w);
    }
});        
 
   