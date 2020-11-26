{include file="header.tpl"}
<!--BARRA DE NAVEGACIÓN ADMINISTRADOR-->
<nav class="botoneratexto">
    <ul class="menu botones_admin">
        <li class="botones"><a class="link" href="admin">Productos</a></li>
        <li class="botones"><a class="link" href="adminUsers">Usuarios</a></li>
    </ul>
</nav>
<!--BOTON DE CERRAR SESIÓN-->
<div class="div_logout">
    <p class="cerarSesion">cerrar sesión</p>
    <button class="btn_logout" type="button"><a href="logout"><i class="fa fa-sign-out" aria-hidden="true"></i></a></button>
</div>
<!--CONTENIDO-->
<h1>Editar usuario</h1>
<h2>Usuario: {$user->email}</h2>
{if $message}
    <h2>{$message}</h2>
{/if}
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