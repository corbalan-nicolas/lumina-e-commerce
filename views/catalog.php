<h2>Nuestros productos</h2>
<a href="#">Link de prueba</a>
<a href="#">Link de prueba 2</a>

<?php
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
?>
<aside class="ignore-smoke-overlap">
  <button id="btnFilters" class="flex gap-2 py-2 px-4 border rounded">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-adjustments-horizontal">
      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
      <path d="M14 6m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
      <path d="M4 6l8 0" />
      <path d="M16 6l4 0" />
      <path d="M8 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
      <path d="M4 12l2 0" />
      <path d="M10 12l10 0" />
      <path d="M17 18m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
      <path d="M4 18l11 0" />
      <path d="M19 18l1 0" />
    </svg>
    Ver filtros
  </button>

  <div class="filters__container">
    <button id="btnFiltersClose" title=" Cerrar filtros">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-x">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M18 6l-12 12" />
        <path d="M6 6l12 12" />
      </svg>
    </button>
    <form class="filters" action="index.php?section=catalog" method="post">
      <input id="inputScrollY" type="text" name="scrollY" value="<?= $_POST["scrollY"] ?? 0 ?>" hidden>
      <div class="filters__body">
        <strong class="filters__title">Por precio</strong>
        <label>
          <input type="checkbox" name="discount" value="true">
          Descuento
        </label>
      </div>

      <div class="filters__footer">
        <button class="filters__footer-btn" type="reset">Resetear Filtros</button>
        <button class="filters__footer-btn">Aplicar Filtros</button>
      </div>
    </form>
  </div>
</aside>

<a href="#">OTRO LINK DE PRUEBA</a>

<script defer src="js/view-catalog.js"></script>