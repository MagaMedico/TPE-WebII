<!--FORMULARIO PARA INSERTAR PRODUCTO-->
<form action="insert" method="post">
    <input class="input" type="text" name="input_product" placeholder="producto" required>
    <input class="input" type="number" name="input_price" placeholder="precio" required>
    <input class="input" type="number" name="input_stock" placeholder="stock" required>
    <input class="input" type="text" name="input_description" placeholder="descripción" required>

    <select name="select_brand">
        <option value="2">Donadonna</option>
        <option value="3">Lunera Acero</option>
        <option value="4">Gtergood</option>
        <option value="5">Rapsodia</option>
    </select>
    
    <button class="btn" type="submit">agregar</button>
</form>
