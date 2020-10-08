{include file="header.tpl"}
<div>
    <p class="cerarSesion">cerrar sesión</p>
    <button class="btn_logout" type="button"><a href="logout"> Logout</a></button>
</div>
<section class="contenedor_table">
    <table class="table_productos">
        <caption class="titulo_table">{$titulo}</caption>
        <thead>
            <tr>
                <th>producto</th>
                <th>precio</th>
                <th>stock</th>
                <th>descripción</th>
            </tr>
        </thead>
        <tbody id="tabla">
            {foreach from=$productos item=producto}
                <tr>
                    <td>{$producto->nombre}</td>
                    <td>{$producto->precio}</td>
                    <td>{$producto->stock}</td>
                    <td>{$producto->descripcion}</td>
                    <td class="excepcion"><button type="button"><a href="edit/{$producto->id}">editar</a></button></td>
                    <td class="excepcion"><button id="btn_borrar" type="button"><a href="delete/{$producto->id}">borrar</a></button></td>
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