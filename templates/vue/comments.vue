{literal}
    <h4>Comentarios</h4>
    <div id="vue-comments">
        <ul id="comments-table" class="list-group">
            <li class="list-group-item" v-for="comment in comments" :data-id-comment="comment.id_comentario">  
                {{comment.comentario}} - valoración: {{comment.valoracion}}
            </li>
        </ul>
    </div>
{/literal}