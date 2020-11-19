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
        <textarea class="textarea_commet" id="input_comentario" placeholder="Escriba su comentario" rows="10" cols="50"></textarea>

        <div class="clasificacion">
            <p>Valora el producto</p>
            <input class="input_star" id="radio1" type="radio" name="estrellas" value="5">
            <label class="label_star" for="radio1">★</label>
            <input class="input_star" id="radio2" type="radio" name="estrellas" value="4">
            <label class="label_star" for="radio2">★</label>
            <input class="input_star" id="radio3" type="radio" name="estrellas" value="3">
            <label class="label_star" for="radio3">★</label>
            <input class="input_star" id="radio4" type="radio" name="estrellas" value="2">
            <label class="label_star" for="radio4">★</label>
            <input class="input_star" id="radio5" type="radio" name="estrellas" value="1">
            <label class="label_star" for="radio5">★</label>
        </div>

        <button id="btn_comment" class="btn" type="submit">Comentar</button>
    </form>
{/if}