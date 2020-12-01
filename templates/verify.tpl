{include file="header.tpl"}

 <!--BARRA DE NAVEGACIÓN ADMINISTRADOR-->
<nav class="botoneratexto">
    <ul class="menu botones_admin">
        <li class="botones"><a class="link" href="admin">Productos</a></li>
        <li class="botones"><a class="link" href="adminUsers">Usuarios</a></li>
    </ul>
</nav>

<div class="div_logout">
    <p class="cerarSesion">cerrar sesión</p>
    <button class="btn_logout" type="button"><a href="logout"><i class="fa fa-sign-out" aria-hidden="true"></i></a></button>
</div>
<section class="contenedor_table">
    <table class="table_productos">
        <caption class="titulo_table">{$title}</caption>
        <thead>
            <tr>
                <th>producto</th>
                <th>precio</th>
                <th>stock</th>
                <th>descripción</th>
                <th>marca</th>
            </tr>
        </thead>
        <tbody id="tabla">
            {foreach from=$products item=product}
                <tr>
                    <td>{$product->nombre}</td>
                    <td>{$product->precio}</td>
                    <td>{$product->stock}</td>
                    <td>{$product->descripcion}</td>
                    <td>{$product->marca}</td>
                    <td class="excepcion"><button type="button"><a href="edit/{$product->id}"><i class="fas fa-edit"></i></a></button></td>
                    <td class="excepcion"><button id="btn_borrar" type="button"><a href="delete/{$product->id}"><i class="fas fa-trash"></i></a></button></td>
                </tr>
                <tr>
                    <td class="td_imag" colspan="4">
                        {foreach from=$images item=image}
                            {if $image->id_producto == $product->id}
                                <img class="img" src="{$image->imagen}">
                            {/if}
                        {/foreach}
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table>
</section>
<!--FORMULARIO PARA INSERTAR PRODUCTO-->
{include file="createProduct.tpl"}
<!--TABLA DE MARCAS-->
<section class="contenedor_table">
    <table class="table">
        <caption class="titulo_table">tabla de marcas</caption>
        <caption id="alert">al eliminar una marca también se eliminarán los productos relacionados a esta
            <button id="btn_alert" type="button" class="sowAlert">
                <span>&times;</span>
            </button>
        </caption>
        <thead>
            <tr>
                <th>marca</th>
                <th>categoria</th>
            </tr>
        </thead>
        <tbody id="tabla">
            {foreach from=$marks item=mark}
                <tr>
                    <td>{$mark->marca}</td>
                    <td>{$mark->categoria}</td>
                    <td class="excepcion"><button  type="button"><a href="editMark/{$mark->id_marca}"><i class="fas fa-edit"></i></a></button></td>
                    <td class="excepcion"><button  type="button"><a href="deleteMark/{$mark->id_marca}"><i class="fas fa-trash"></i></a></button></td>
                </tr>
            {/foreach}
        </tbody>
    </table>
</section>
<!--FORMULARIO PARA INSERTAR UNA MARCA-->
{include file="createMark.tpl"}

<script src="js/btn_alert.js"></script>
{include file="footer.tpl"}