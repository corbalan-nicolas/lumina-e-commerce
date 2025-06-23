<h2 class="hidden">Nuestros productos</h2>





<?php
$products = Candle::get_all_products();
$categories = Category::get_all_categories();

function mergeArrayOfClasses($arr1, $arr2)
{
  $result = $arr1;
  $compare = [];

  foreach ($arr2 as $obj) {
    $compare[] = serialize($obj);
  }

  echo "<pre>";
  print_r($compare);
  echo "<pre>";

  foreach ($arr1 as $obj) {
    $serialized = serialize($obj);
    if (in_array($serialized, $compare)) {
      echo "Coincide        $serialized<br>";
    } else {
      echo "No coincide     $serialized<br>";
    }
  }

  return $result;
}


$filters = $_POST;
if (array_key_exists("discount", $filters)) {
  $tmp = Candle::filter_by_discount();

  $products = mergeArrayOfClasses($products, $tmp);
}

if (array_key_exists("categories", $filters)) {
  $tmp = Candle::filter_by_categories($filters["categories"], $products);

  $products = mergeArrayOfClasses($products, $tmp);
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
      <!-- Button to CLOSE the filters -->
      <button id="btnFiltersClose" title=" Cerrar filtros">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-x">
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
      <div class="col-span-full border">
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