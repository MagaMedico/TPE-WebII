<h1>Busca por marca, nombre o precio:</h1>
<form action="filterMark" method="post">
  <p>Seleciona una marca:
    <select name="select_brand">
        {foreach from=$marks item=mark}
          {if $mark->id_marca == $mark_id}
            <option selected="{$mark->id_marca}" value="{$mark->id_marca}">{$mark->marca}</option>
          {else}
            <option value="{$mark->id_marca}">{$mark->marca}</option>
          {/if}
        {/foreach}
    </select>
    <button class="btn" type="submit">filtrar</button>
  </p>
</form>