"use strict";

let app = new Vue({
    el: '#vue-comments',
    data: {
        comments: []  
    },
    methods : {
        deleteComment(id, comments, key){
            fetch('api/comments/' + id, {
                "method": "DELETE",
            })
            .catch(error => console.log(error));
            this.$delete(comments, key);
        },
        stars(valoracion){
            let stars = [];
            for(let i= 0; i < valoracion; i++){
                stars[i] = i+1;
            }
            return stars;
        }
    }
});

document.addEventListener("DOMContentLoaded", function(){
    
    getComments();

    document.querySelector("#btn_comment").addEventListener('click', function(e){
        e.preventDefault();
        addComment();
    });
});

let id_producto = document.querySelector('#input_IdProducto').value;

function getComments() {
    fetch('api/comments/' + id_producto)
    .then(response => response.json())
    .then(comments => app.comments = comments)
    .catch(error => console.log(error));
}

function addComment(){

    let validacion = validarFormulario();

    if(validacion == true){

        let valoracion = 0;
        let input_radio =  document.getElementsByName("estrellas");

        for (var i = 0; i < input_radio.length; i++) {
            if (input_radio[i].checked == true) {
                valoracion = input_radio[i].value;
            }
        }

        const comment = {
            comentario: document.querySelector('#input_comentario').value,
            valoracion: parseInt(valoracion),        
            id_usuario: document.querySelector('#input_IdUsuario').value,
            id_producto: document.querySelector('#input_IdProducto').value
        }

        fetch('api/comments', {
            method: 'POST',
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(comment)
        })
        .then(response => response.json())
        .then(comment => app.comments.push(comment))
        .catch(error => console.log(error));

        resetInputs();
    }
}

function validarFormulario(){

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
    }else{
        return true;
    }
}

function resetInputs(){

    document.querySelector('#input_comentario').value = "";
    let input_radio =  document.getElementsByName("estrellas");

    for (var i = 0; i < input_radio.length; i++) {
        input_radio[i].checked = false;
    }
}