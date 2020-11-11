"use strict";

let app = new Vue({
    el: '#vue-comments',
    data: {
        comments: []  
    }
});

document.addEventListener("DOMContentLoaded", function(){
    
    getComments();

    document.querySelector("#btn_comment").addEventListener('click', function(e){
        e.preventDefault();
        addComment();
    });
});

function getComments() {
    fetch('api/comments')
    .then(response => response.json())
    .then(comments => app.comments = comments)
    .catch(error => console.log(error));
}

function addComment(){

    const comment = {
        comentario: document.querySelector('#input_comentario').value,
        valoracion: document.querySelector('#input_valoracion').value,
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
}