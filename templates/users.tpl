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
{if $message}
    <h2>{$message}</h2>
{/if}
<!--TABLA DE USUARIOS-->
<section class="contenedor_table">
    <table class="table_productos">
        <caption class="titulo_table">Tabla de usuarios</caption>
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Administrador</th>
            </tr>
        </thead>
        <tbody id="tabla">
            {foreach from=$users item=user}
                <tr>
                    <td>{$user->email}</td>
                    {if $user->admin == 1}
                        <td>Si</td>
                    {else}
                        <td>No</td>
                    {/if}
                    <td class="excepcion"><button type="button"><a href="editUser/{$user->id}"><i class="fas fa-edit"></i></a></button></td>
                    <td class="excepcion"><button id="btn_borrar" type="button"><a href="deleteUser/{$user->id}"><i class="fas fa-trash"></i></a></button></td>
                </tr>
            {/foreach}
        </tbody>
    </table>
</section>
{include file="footer.tpl"}