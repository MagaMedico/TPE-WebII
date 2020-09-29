<h1>filtrá los productos por marca</h1>
<form action="filterMark" method="get">
  <p>Seleciona una marca:
    <select name="select_brand">
        {foreach from=$marks item=mark}
            <option value="{$mark->id_marca}">{$mark->marca}</option>
        {/foreach}
    </select>
    <button class="btn" type="submit">filtrar</button>
  </p>
</form>