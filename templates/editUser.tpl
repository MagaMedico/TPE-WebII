{include file="header.tpl"}
<h1>Editar usuario</h1>
<h2>Usuario: {$usuario->email}</h2>
<form action="updateUser/{$usuario->id}" method="post">
    <p>Seleccione permiso: 
    <select name="selectAdmin">
        <option selected="{$usuario->admin}">
        {if $usuario->admin == 0}
            No
        {else}
            Si
        {/if}  
        </option>   
        <option value="{if $usuario->admin == 1}
            0
        {else}
            1
        {/if}">
        {if $usuario->admin == 1}
            No
        {else}
            Si
        {/if} 
        </option>       
    </select>
    </p>
    <button class="btn" type="submit">Cambiar</button>
</form>
{include file="footer.tpl"}