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
        <caption class="titulo_table">{$title}</caption>
        <thead>
            <tr>
                <th>imagen</th>
                <th>producto</th>
                <th>precio</th>
                <th>stock</th>
                <th>descripción</th>
            </tr>
        </thead>
        <tbody id="tabla">
            {foreach from=$products item=product}
                <tr>
                    <td>
                        <img class="img" src="{$product->imagen}">
                        {if $product->imagen}
                            <button  type="button"><a href="deleteImg/{$product->id}"><i class="fas fa-trash"></i></a></button>
                        {/if}
                    </td>
                    <td>{$product->nombre}</td>
                    <td>{$product->precio}</td>
                    <td>{$product->stock}</td>
                    <td>{$product->descripcion}</td>
                    <td class="excepcion"><button type="button"><a href="edit/{$product->id}">editar</a></button></td>
                    <td class="excepcion"><button id="btn_borrar" type="button"><a href="delete/{$product->id}">borrar</a></button></td>
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
                    <td class="excepcion"><button  type="button"><a href="editMark/{$mark->id_marca}">editar</a></button></td>
                    <td class="excepcion"><button  type="button"><a href="deleteMark/{$mark->id_marca}">borrar</a></button></td>
                </tr>   
            {/foreach}
        </tbody>
    </table>
</section> 
<!--FORMULARIO PARA INSERTAR UNA MARCA-->
{include file="createMark.tpl"}

{include file="footer.tpl"}