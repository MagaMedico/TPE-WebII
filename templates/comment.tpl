<!--DATOS NO VISIBLES:-->
<form>
    <input type="hidden" id="input_IdProducto" value="{$product->id}">
    <input type="hidden" id="input_IdUsuario" value="{$Iduser}">
    <input type="hidden" id="input_Admin" value="{$admin}">
</form>
<!--AGREGAR UN COMENTARIO-->
{if $user}
    <h1>Agregar un comentario: </h1>
    <form class="form_comentarios">
        <textarea class="textarea_commet" id="input_comentario" placeholder="Escriba su comentario" rows="10" cols="50" required></textarea>
        <input class="valoracion" type="number" id="input_valoracion" placeholder="valoración" value="3" min="1" max="5" required>

        <button id="btn_comment" class="btn" type="submit">Comentar</button>
    </form>
{/if}