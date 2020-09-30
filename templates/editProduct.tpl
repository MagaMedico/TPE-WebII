{include file="header.tpl"}
<!--HTML EDITAR PRODUCTO-->
<form action="update/{$producto->id}" method="get">

    <input class="input" type="text" name="edit_product" placeholder="producto" value="{$producto->nombre}" required>
    <input class="input" type="number" name="edit_price" placeholder="precio" value="{$producto->precio}" required>
    <input class="input" type="number" name="edit_stock" placeholder="stock" value="{$producto->stock}" required>
    <input class="input" type="text" name="edit_description" placeholder="descripción" value="{$producto->descripcion}" required>

    <select name="select_brand">
        {foreach from=$marks item=mark}
            <option value="{$mark->id_marca}">{$mark->marca}</option>
        {/foreach}
    </select>

    <!--<button  type="submit"><a href="update/{$producto->id}">actualizar</a></button>-->
    <button class="btn" type="submit">actualizar</button>
</form>

{include file="footer.tpl"}