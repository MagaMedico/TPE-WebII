<!--FORMULARIO PARA INSERTAR PRODUCTO-->
<form action="insert" method="post" enctype="multipart/form-data">
    <input class="input" type="text" name="input_product" placeholder="producto" required>
    <input class="input" type="number" name="input_price" placeholder="precio" required>
    <input class="input" type="number" name="input_stock" placeholder="stock" required>
    <input class="input" type="text" name="input_description" placeholder="descripción" required>

    <input class="input" type="file" name="input_file[]" id="imageToUpload" multiple>

    <select name="select_brand">
        {foreach from=$marks item=mark}
            <option value="{$mark->id_marca}">{$mark->marca}</option>
        {/foreach}
    </select>

    <button class="btn" type="submit">agregar</button>
</form>