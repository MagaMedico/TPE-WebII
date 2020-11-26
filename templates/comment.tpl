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
        <textarea class="textarea_commet" id="input_comentario" placeholder="Escriba su comentario" rows="10" cols="50" maxlength="200"></textarea>

        <div class="clasificacion">
            <p>Valora el producto</p>
            {foreach from=$stars item=star}
                <input class="input_star" id="radio{$star}" type="radio" name="estrellas" value="{$star}">
                <label class="label_star" for="radio{$star}">★</label>
            {/foreach}
        </div>

        <button id="btn_comment" class="btn" type="submit">Comentar</button>
    </form>
{/if}