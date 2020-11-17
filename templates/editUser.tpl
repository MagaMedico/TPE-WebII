{include file="header.tpl"}
<h1>Editar usuario</h1>
<h2>Usuario: {$user->email}</h2>
<form action="updateUser/{$user->id}" method="post">
    <p>Seleccione permiso: 
        <select name="selectAdmin">
            <option selected="{$user->admin}">
                {if $user->admin == 0}
                    No
                {else}
                    Si
                {/if}  
            </option>   
            <option value="
                {if $user->admin == 1}
                    0
                {else}
                    1
                {/if}">
                {if $user->admin == 1}
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