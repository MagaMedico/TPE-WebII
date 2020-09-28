{include file="header.tpl"}
<!--HTML EDITAR PRODUCTO-->
<form action="update" method="post">

    <input class="input" type="text" name="input_product" placeholder="producto" value="{$producto->nombre}" required>
    <input class="input" type="number" name="input_price" placeholder="precio" value="{$producto->precio}" required>
    <input class="input" type="number" name="input_stock" placeholder="stock" value="{$producto->stock}" required>
    <input class="input" type="text" name="input_description" placeholder="descripción" value="{$producto->descripcion}" required>

    <select name="select_brand">
        <option value="2">Donadonna</option>
        <option value="3">Lunera Acero</option>
        <option value="4">Gtergood</option>
        <option value="5">Rapsodia</option>
    </select>
   <!-- <button  type="submit"><a href="update/{$producto->id}">actualizar</a></button>-->
    <button class="btn" type="submit">actualizar</button>
</form>

{include file="footer.tpl"}