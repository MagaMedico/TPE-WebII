{literal}
<div id="vue-comments">

    <ul id="comments-table">
        <li v-for="comment in comments" :data-id-comment="comment.id_comentario"> 
            {{comment.comentario}} - {{comment.valoracion}}
        </li>
    </ul>

</div>
{/literal}