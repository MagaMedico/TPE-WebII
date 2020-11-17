{literal}
    <h4>Comentarios</h4>
    <div id="vue-comments">
        <ul id="comments-table" class="list-group">
            <li class="list-group-item" v-for="(comment, key) in comments" :data-id-comment="comment.id_comentario">  
                {{comment.comentario}} - valoración: {{comment.valoracion}}
               
                <button><i class="fas fa-trash"></i></button>

            </li>
        </ul>
    </div>
{/literal}