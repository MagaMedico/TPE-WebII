"use strict";

document.addEventListener("DOMContentLoaded", function(){
    document.getElementById("btn_comment").addEventListener("click", validarFormulario);
});

function validarFormulario(event){
    event.preventDefault();
    let valor = document.getElementById('input_comentario').value;
    if(valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
        alert('No has escrito un comentario');
        return;
    }
    this.submit();
}