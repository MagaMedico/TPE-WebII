{include file="header.tpl"}
<!--TABLA CON TODOS LAS CATEGORIAS-->
<section class="contenedor_table">
    <table class="table">
        <caption class="titulo_table">{$titulo}</caption>
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
                </tr>   
            {/foreach}
        </tbody>
    </table>
</section> 
{include file="footer.tpl"}