{include file="header.tpl"}
 <!--BARRA DE NAVEGACIÓN ADMINISTRADOR-->
   <nav class="botoneratexto">
        <ul class="menu botones_admin">
            <li class="botones"><a class="link" href="admin">Producto</a></li>
            <li class="botones"><a class="link" href="adminUsers">Usuarios</a></li>
        </ul>
    </nav>

<div>
    <p class="cerarSesion">cerrar sesión</p>
    <button class="btn_logout" type="button"><a href="logout"> Logout</a></button>
</div>
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
            {foreach from=$usuarios item=usuario}
                <tr>
                    <td>{$usuario->email}</td>
                    {if $usuario->admin == 1}
                        <td>Si</td>
                    {else}
                        <td>No</td>
                    {/if}
                    <td class="excepcion"><button type="button"><a href="editUser/{$usuario->id}">editar</a></button></td>
                    <td class="excepcion"><button id="btn_borrar" type="button"><a href="deleteUser/{$usuario->id}">borrar</a></button></td>
                </tr>   
            {/foreach}
        </tbody>
    </table>
</section> 
{include file="footer.tpl"}