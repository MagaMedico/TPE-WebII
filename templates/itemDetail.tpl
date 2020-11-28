{include file="header.tpl"}
<!--TABLA CON TODOS LOS PRODUCTOS-->
{if $user}
    <div class="contenedor_logout_user">
        <h3>{$user}</h3>
        <!--BOTON QUE CIERRA LA SESIÓN-->
        <div>
            <p class="cerar_sesion_user">cerrar sesión</p>
            <button class="btn_logout_user" type="button"><a href="logout"><i class="fa fa-sign-out" aria-hidden="true"></i></a></button>
        </div>
    </div>
{/if}
<section class="contenedor_table">
    <table class="table">
        <caption class="titulo_table">detalle de producto</caption>
        <thead>
            <tr>
                <th>producto</th>
                <th>precio</th>
                <th>stock</th>
                <th>descripción</th>
                <th>marca</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>{$product->nombre}</td>
                    <td>{$product->precio}</td>
                    <td>{$product->stock}</td>
                    <td>{$product->descripcion}</td>
                    <td>{$mark->marca}</td>
                </tr>
                <tr>
                    <td class="td_imag" colspan="5">
                        {foreach from=$images item=image}
                            <img class="img" src="{$image->imagen}">
                        {/foreach}
                    </td>
                </tr>
        </tbody>
    </table>
    <!--PROMEDIO DE VALORACIÓN-->
    <div>
        {include file="vue/average.vue"}
    </div>
    <!--TABLA DE LA MARCA DEL PRODUCTO-->
     <table class="table">
        <caption class="titulo_table">marca {$mark->marca}</caption>
        <thead>
            <tr>
                <th>marca</th>
                <th>categoria</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>{$mark->marca}</td>
                    <td>{$mark->categoria}</td>
                </tr>
        </tbody>
    </table>
</section>
<!--FORMULARIO PARA AGREGAR UN COMENTARIO-->
{include file="comment.tpl"}
<!--COMENTARIOS-->
<div>
    {include file="vue/comments.vue"}
</div>

<script src="js/app_comments.js"></script>
{include file="footer.tpl"}