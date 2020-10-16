{include file="header.tpl"}
<!--HTML EDITAR PRODUCTO-->
<h1>editar producto</h1>
<form action="update/{$producto->id}" method="post">

    <input class="input" type="text" name="edit_product" placeholder="producto" value="{$producto->nombre}" required>
    <input class="input" type="number" name="edit_price" placeholder="precio" value="{$producto->precio}" required>
    <input class="input" type="number" name="edit_stock" placeholder="stock" value="{$producto->stock}" required>
    <input class="input" type="text" name="edit_description" placeholder="descripción" value="{$producto->descripcion}" required>

    <select name="select_brand">
        {foreach from=$marks item=mark}
            {if $mark->id_marca == $producto->id_marca}
                <option selected="{$mark->id_marca}">{$mark->marca}</option>
            {else}
                <option value="{$mark->id_marca}">{$mark->marca}</option>
            {/if}
        {/foreach}
    </select>

    <button class="btn" type="submit">actualizar</button>
</form>

{include file="footer.tpl"}