"use strict";

document.addEventListener("DOMContentLoaded", function(){
    document.getElementById("btn_comment").addEventListener("click", validarFormulario);
    document.getElementById("form").reset();//no funciona
});

function validarFormulario(event){
    event.preventDefault();

    let valor = document.getElementById('input_comentario').value;

    let opciones = document.getElementsByName("estrellas");

    let seleccionado = false;
    for(let i=0; i<opciones.length; i++) {
        if(opciones[i].checked) {
            seleccionado = true;
            break;
        }
    }

    if(valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
        alert('No has escrito un comentario');
        return false;
    } else if(!seleccionado) {
        alert('No se ha seleccionado la valoracion');
        return false;
    }
}