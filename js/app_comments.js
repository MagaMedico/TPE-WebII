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

    let valoracion = 0;
    let input_radio =  document.getElementsByName("estrellas");

    for (var i = 0; i < input_radio.length; i++) {
        if (input_radio[i].checked == true) {
            valoracion = input_radio[i].value;
        }
    }

    const comment = {
        comentario: document.querySelector('#input_comentario').value,
        //valoracion: document.querySelector('#input_valoracion').value,
        valoracion: valoracion,        
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