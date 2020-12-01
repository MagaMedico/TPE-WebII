{include file="header.tpl"}
<!--HTML EDITAR PRODUCTO-->
<h1>editar producto</h1>
<form class="form_edit_product" action="update/{$product->id}" method="post" enctype="multipart/form-data">

    <div class="cont1_form_edit_product">
        <input class="input" type="text" name="edit_product" placeholder="producto" value="{$product->nombre}" required>
        <input class="input" type="number" name="edit_price" placeholder="precio" value="{$product->precio}" required>
        <input class="input" type="number" name="edit_stock" placeholder="stock" value="{$product->stock}" required>
        <input class="input" type="text" name="edit_description" placeholder="descripción" value="{$product->descripcion}" required>

        <select class="select_brand" name="select_brand">
            {foreach from=$marks item=mark}
                {if $mark->id_marca == $product->id_marca}
                    <option selected="{$mark->id_marca}" value="{$mark->id_marca}">{$mark->marca}</option>
                {else}
                    <option value="{$mark->id_marca}">{$mark->marca}</option>
                {/if}
            {/foreach}
        </select>
    </div>
    <div class="cont_file">
        {foreach from=$images item=image}
            <img class="img edit_img" src="{$image->imagen}">
            <button class="btn_delete_img" type="button"><a href="{$product->id}/deleteImg/{$image->id}"><i class="fas fa-trash"></i></a></button>
        {/foreach}
    </div>
    <div>
        <input type="file" name="input_file[]" id="imageToUpload" multiple/>
    </div>

    <button class="btn" type="submit">actualizar</button>
</form>

{include file="footer.tpl"}