{include file="header.tpl"}
<!--SELECTOR DE MARCA PARA FILTRAR-->
{include file="select-mark.tpl"}
<!--TABLA CON TODOS LOS PRODUCTOS-->
<section class="contenedor_table">
    <table class="table">
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
                </tr>   
            {/foreach}
        </tbody> 
    </table>
</section> 
{include file="footer.tpl"}