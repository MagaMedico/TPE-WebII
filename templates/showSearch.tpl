{include file="header.tpl"}
<!--SELECTOR DE MARCA PARA FILTRAR-->
{include file="select-mark.tpl"}
<!--BUSCADOR-->
{include file="search.tpl"}
<!--TABLA CON TODOS LOS PRODUCTOS-->
<section class="contenedor_table">
    <table class="table">
        <caption class="titulo_table">{$title}</caption>
        <thead>
            <tr>
                <th class="excepcion"></th>
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
                    <td class="td_imag excepcion"><img class="img" src="{$product->imagen}"></td>
                    <td>{$product->nombre}</td>
                    <td>{$product->precio}</td>
                    <td>{$product->stock}</td>
                    <td>{$product->descripcion}</td>
                    {foreach from=$marks item=mark}
                        {if $mark->id_marca == $product->id_marca}
                            <td>{$mark->marca}</td>
                        {/if}
                    {/foreach}
                    <td class="excepcion"><button type="button"><a href="itemDetail/{$product->id}">ver más</a></button></td>
                </tr>
            {/foreach}
        </tbody>
    </table>
</section>
{include file="footer.tpl"}