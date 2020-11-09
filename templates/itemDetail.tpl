{include file="header.tpl"}
<!--TABLA CON TODOS LOS PRODUCTOS-->
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
                    <td>{$producto->nombre}</td>
                    <td>{$producto->precio}</td>
                    <td>{$producto->stock}</td>
                    <td>{$producto->descripcion}</td>
                    <td>{$mark->marca}</td>
                </tr>
        </tbody>
    </table>
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
{include file="comment.tpl"}
{include file="footer.tpl"}