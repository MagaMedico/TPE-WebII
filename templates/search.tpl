<form action="search" method="post">
    <p>Escribi un nombre y/o precio:
        <input type="text" name="input_name" placeholder="Nombre de producto">
        <select name="select_price">
            <option>0-200</option>
            <option>201-400</option>
            <option>401-600</option>
        </select>
        <!--<input type="number" name="input_price" placeholder="Precio" pattern="^[0-9]*\-[0-9]*$" title="Tiene que ser dos rangos numericos separado por un guion">-->
        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
    </P>
</form>
<!--<button class="btn" type="button"><a href="home">ver todo</a></button>-->