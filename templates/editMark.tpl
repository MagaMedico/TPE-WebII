{include file="header.tpl"}
<!--HTML EDITAR MARCA-->
<h1>editar marca</h1>
<form action="updateMark/{$mark->id_marca}" method="post">

    <input class="input" type="text" name="edit_mark" placeholder="marca" value="{$mark->marca}" required>
    <input class="input" type="text" name="edit_category" placeholder="categoria" value="{$mark->categoria}" required>

    <button class="btn" type="submit">actualizar</button>
</form>

{include file="footer.tpl"}