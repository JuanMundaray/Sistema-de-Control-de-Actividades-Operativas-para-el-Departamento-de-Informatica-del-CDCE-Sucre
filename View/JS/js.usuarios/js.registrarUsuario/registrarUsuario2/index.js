import {SubmitUsuarioNuevo} from "./submit.form.registrar_usuario.part2.js"
import "./inputsConfigure.js"
import {funcionModal} from "./modalRegistrarUsuario.js"

$("#username").on("input",function(event){
    $("#username").removeClass("is-invalid");
});

SubmitUsuarioNuevo();
funcionModal();