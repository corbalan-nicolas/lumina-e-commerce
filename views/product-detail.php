<?php

$candle = Candle::filter_by_id(intval($_GET["id"]) ?? 0);

$candle->getPrice();

if (!$candle) {
?>
  <div class="p-4">
    <h2 class="text-xl font-medium">Producto no encontrado</h2>
  </div>
<?php
} else {
?>
  <div class="p-4 grid grid-cols-[1fr_1fr_1fr] grid-flow-col gap-4">
    <!--
  *********************************************************************************
                                  BASIC INFO + CTA
  *********************************************************************************
  -->
    <div class="">
      <!-- Name + Category -->
      <h2 class="border-s-6 border-[<?= $candle->getCssColor() ?>] px-2 inline-block text-xl font-medium" data-cpc="<?= $candle->getCssColor() ?>">
        <?= $candle->getName() ?>
      </h2>
      <small class="px-4 rounded-full bg-gray-400/20"><?= $candle->getCategory()->getName() ?></small>

      <!-- Price + Discount -->
      <?php
      if ($candle->getDiscount()) {
      ?>
        <p class="card__price--line-through not-sr-only">$<?= $candle->getPrice(false) ?></p>
        <p class="text-4xl inline-block"><strong>USD $<?= $candle->getPrice() ?></strong></p>
        <span><?= $candle->getDiscount() ?>% OFF</span>
      <?php
      } else {
      ?>
        <p class="text-4xl"><strong>USD $<?= $candle->getPrice() ?></strong></p>
      <?php
      }
      ?>

      <!-- Tags -->
      <?php
      if ($candle->getTags()) {
      ?>
        <div class="my-2 border-y border-gray-300/70">
          <span>Etiquetas: </span>
          <?php
          foreach ($candle->getTags() as $tag) {
          ?>
            <span><?= $tag->getTag() ?></span>
          <?php
          }
          ?>
        </div>
      <?php
      }
      ?>

      <!-- Description -->
      <p><?= $candle->getDescription() ?></p>

      <!-- Cta (form) -->
      <form class="flex gap-4" action="#" method="post">
        <label>
          <span class="sr-only">Cantidad</span>
          <input type="number" min="1" max="99" value="1" placeholder="Cantidad">
        </label>

        <button class="btn" type="submit">
          <span class="icon icon--cart-add-white"></span>
          Agregar al carrito
        </button>
      </form>
    </div>





    <!--
  *********************************************************************************
                                      CAROUSEL
  *********************************************************************************
  -->
    <?php
    if ($candle->getExtraImg()) { // Width extra images
    ?>
      <div class="grid col-[1_/_span_1] grid-cols-[auto_1fr] grid-flow-col gap-4 col-2">
        <div class="grid col-[2_/_span_1] place-content-center size-100 bg-[var(--bg-main)]">
          <img id="bigImg" class="max-w-100 max-h-100" src="img/candles/<?= $candle->getMainImg() ?>" alt="Foto del producto principal">
        </div>
        <div>
          <ul id="carouselButtons" class="flex flex-col gap-4">
            <li class="grid place-content-center w-12 bg-[var(--bg-main)]">
              <button>
                <img class="max-w-12 max-h-12" src="img/candles/<?= $candle->getMainImg() ?>" alt="Foto del producto principal">
              </button>
            </li>
            <?php
            foreach ($candle->getExtraImg() as $i => $extraImage) {
            ?>
              <li class="grid place-content-center w-12 bg-[var(--bg-main)]">
                <button>
                  <img class="max-w-12 max-h-12" src="img/candles/carousel/<?= $extraImage->getFilename() ?>" alt="Foto de producto <?= $i ?>">
                </button>
              </li>
            <?php
            }
            ?>
          </ul>
        </div>
      </div>
    <?php
    } else { // Without extra images
    ?>
      <div>
        <div class="grid col-[1_/_span_1] place-content-center size-100 bg-[var(--bg-main)]">
          <img class="max-w-100 max-h-100" src="img/candles/<?= $candle->getMainImg() ?>" alt="Foto del producto principal">
        </div>
      </div>
    <?php
    }
    ?>





    <!--
  *********************************************************************************
                                    CANDLE DETAILS
  *********************************************************************************
  -->
    <div>
      <h3>Detalles del producto:</h3>
      <table class="w-full rounded overflow-hidden">
        <?php
        $dictionary = [
          "material" => "Material",
          "duration" => "Duración",
          "size" => "Tamaño",
          "weight" => "Peso",
          "fragance" => "Fragancia"
        ];
        foreach ($candle->getDetails() as $key => $value) {
        ?>
          <tr class="odd:bg-gray-200 even:bg-[var(--bg-main)]">
            <td class="px-4 py-2"><?= $dictionary[$key] ?></td>
            <td class="px-4 py-2"><?= $value ?></td>
          </tr>
        <?php
        }
        ?>
      </table>
    </div>





    <!--
    *********************************************************************************
                                        SCRIPTS
    *********************************************************************************
    -->
    <script defer src="js/view-product-detail.js"></script>
  </div>
<?php
}
?>