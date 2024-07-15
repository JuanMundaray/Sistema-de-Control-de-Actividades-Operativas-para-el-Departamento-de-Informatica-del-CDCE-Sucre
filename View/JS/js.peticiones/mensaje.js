$(document).ready(function(){     
    var w = sessionStorage.getItem('mensaje');
    if (w==1){
    	let mytoast = document.querySelector("#registrar-peticion");
    	let Toast = new bootstrap.Toast(mytoast);
        Toast.show();
        w=0;
        sessionStorage.setItem('mensaje',w);
    }else if (w==2){
    	let mytoast = document.querySelector("#rechazar-peticion");
    	let Toast = new bootstrap.Toast(mytoast);
        Toast.show();
        w=0;
        sessionStorage.setItem('mensaje',w);
    }else if (w==3){
    	let mytoast = document.querySelector("#cancelar-peticion");
    	let Toast = new bootstrap.Toast(mytoast);
        Toast.show();
        w=0;
        sessionStorage.setItem('mensaje',w);
    }else if (w==4){
    	let mytoast = document.querySelector("#aceptar-peticion");
    	let Toast = new bootstrap.Toast(mytoast);
        Toast.show();
        w=0;
        sessionStorage.setItem('mensaje',w);
    }
});