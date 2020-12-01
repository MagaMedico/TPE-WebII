<h1>Busca por marca, nombre o precio:</h1>
<form action="filterMark" method="post">
  <p>Seleciona una marca:
    <select name="select_brand">
        {foreach from=$marks item=mark}
          <option value="{$mark->id_marca}">{$mark->marca}</option>
        {/foreach}
    </select>
    <button class="btn" type="submit">filtrar</button>
  </p>
</form>