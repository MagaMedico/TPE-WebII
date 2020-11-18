
{literal}
    <h4>Comentarios</h4>
    <div id="vue-comments">
        <ul id="comments-table" class="list-group">
            <li class="list-group-item" v-for="(comment, key) in comments" :data-id-comment="comment.id_comentario">  
                {{comment.comentario}} - valoración: {{comment.valoracion}}
{/literal}  
            {if $admin == 1}
                <button @click="deleteComment(comment.id_comentario, comments, key)"><i class="fas fa-trash"></i></button>
            {/if}
            </li>
        </ul>
    </div>