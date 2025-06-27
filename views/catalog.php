<h2 class="hidden">Nuestros productos</h2>





<?php
$products = Candle::get_all_products();
$categories = Category::get_all_categories();

$filters = $_POST;
if (array_key_exists("discount", $filters)) {
  $tmp = Candle::filter_by_discount();
  $products = Candle::mergeArrays($products, $tmp);
}

if (array_key_exists("categories", $filters)) {
  $tmp = Candle::filter_by_categories($filters["categories"], $products);
  $products = Candle::mergeArrays($products, $tmp);
}

// echo "serialize:" . serialize($products[1]) . "<br><br><br><br><br><br>";

// echo "<p>Filtros a aplicar:</p><pre>";
// print_r($filters);
// echo "</pre>";

// echo "<p>Productos:</p><pre>";
// print_r($products);
// echo "</pre>";

// echo "<p>Categorías:</p><pre>";
// print_r($categories);
// echo "</pre>";
?>





<!-- Container of the entire section -->
<div class="ignore-smoke-overlap p-4 grid gap-4 md:grid-cols-[minmax(11rem,_0.25fr)_1fr]">
  <!--
  *********************************************************************************
                                      FILTERS
  *********************************************************************************
  -->
  <aside>
    <!-- Button to OPEN filters on mobile devices -->
    <button id="btnFilters" class="over-smoke btn btn--outlined">
      <span class="icon icon--filters"></span>
      Ver filtros
    </button>

    <div class="filters__container">
      <!-- Button to CLOSE the filters -->
      <button id="btnFiltersClose" title="Cerrar filtros">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M18 6l-12 12" />
          <path d="M6 6l12 12" />
        </svg>
      </button>
      <!-- All the FILTERS -->
      <form class="filters over-smoke" id="filtersForm" action="index.php?section=catalog" method="post">

        <div class="filters__body">
          <input id="inputScrollY" type="text" name="scrollY" value="<?= $_POST["scrollY"] ?? 0 ?>" hidden>

          <div> <!-- Filters by price -->
            <strong class="filters__title">Por precio</strong>
            <label class="filters__label">
              <?php
              $checked = array_key_exists("discount", $filters) ? "checked" : "";
              ?>
              <input class="filters__checkbox sr-only" type="checkbox" name="discount" value="true" <?= $checked ?>>
              Descuento
            </label>
          </div>

          <div> <!-- Filters by category -->
            <strong class="filters__title">Por categoría</strong>
            <ul>
              <?php
              foreach ($categories as $category) {
                $checked = (array_key_exists("categories", $filters) && in_array($category->getId(), $filters["categories"])) ? "checked" : "";
              ?>
                <li>
                  <label class="filters__label">
                    <input class="filters__checkbox sr-only" type="checkbox" name="categories[]" value="<?= $category->getId() ?>" <?= $checked ?>>
                    <?= $category->getName() ?>
                  </label>
                </li>
              <?php
              }
              ?>
            </ul>
          </div>
        </div>

        <div class="filters__footer">
          <button id="btnResetFilters" class="btn btn--outlined filters__footer-btn" type="reset">Resetear Filtros</button>
          <button class="btn filters__footer-btn">Aplicar Filtros</button>
        </div>
      </form>

    </div>
  </aside>





  <!--
  *********************************************************************************
                                      PRODUCTS
  *********************************************************************************
  -->
  <section id="products" class="over-smoke grid grid-cols-[repeat(auto-fill,_minmax(180px,_1fr))] grid-rows-[auto_1fr] gap-4 items-start">
    <?php
    $productsLength = count($products);

    if ($productsLength <= 0) {
    ?>
      <div class="col-span-full">
        <p>No se encontraron productos</p>
      </div>
    <?php
    } else {
    ?>
      <div class="col-span-full hidden">
        <p>Mostrando <?= $productsLength ?> productos</p>
      </div>
      <?php
      foreach ($products as $candle) {
      ?>
        <article class="card relative border-b-6 border-b-[<?= $candle->getCssColor() ?>]" data-cpc="<?= $candle->getCssColor() ?>">
          <img class="card__cover" src="img/candles/<?= $candle->getMainImg() ?>" alt="">
          <div class="card__body">
            <a href="index.php?section=product-detail&id=<?= $candle->getId() ?>">
              <span class="card__link-expand"></span> <!-- Una solución medio pirata, pero funcional (expande el <a> para que ocupe todo el espacio de la card) -->
              <h3 class="card__title"><?= $candle->getName() ?></h3>
            </a>
            <?php
            $candle->show_price("card__price");

            if ($candle->getDiscount()) {
            ?>
              <div class="card__discount">
                <strong><?= $candle->getDiscount() ?>% off</strong>
              </div>
            <?php
            }
            ?>
          </div>
        </article>
    <?php
      }
    }
    ?>
  </section>
</div>





<!--
*********************************************************************************
                                    SCRIPTS
*********************************************************************************
-->
<script defer src="js/view-catalog.js"></script>