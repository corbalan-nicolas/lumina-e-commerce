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
  <div class="p-4 grid lg:grid-cols-[1fr_1fr_1fr] gap-4">





    <!--
  *********************************************************************************
                                      CAROUSEL
  *********************************************************************************
  -->
    <?php
    if ($candle->getExtraImg()) { // Width extra images
    ?>
      <div class="grid col-span-2 grid-cols-[auto_1fr] grid-flow-col gap-4 col-2">
        <div class="grid col-[2_/_span_1] place-content-center">
          <img id="bigImg" class="max-h-[74dvh]" src="img/candles/<?= $candle->getMainImg() ?>" alt="Foto del producto principal">
        </div>
        <div>
          <ul id="carouselButtons" class="flex flex-col gap-4">
            <li class="grid place-content-center w-12">
              <button>
                <img class="max-w-12 max-h-12" src="img/candles/<?= $candle->getMainImg() ?>" alt="Foto del producto principal">
              </button>
            </li>
            <?php
            foreach ($candle->getExtraImg() as $i => $extraImage) {
            ?>
              <li class="grid place-content-center w-12">
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
      <div class="grid col-span-2 place-content-center">
        <img src="img/candles/<?= $candle->getMainImg() ?>" alt="Foto del producto principal">
      </div>
    <?php
    }
    ?>





    <!--
  *********************************************************************************
                                  BASIC INFO + CTA
  *********************************************************************************
  -->
    <div class="">
      <!-- Name + Category -->
      <div class="mb-2 flex gap-2 items-end">
        <h2 class="border-s-6 border-[<?= $candle->getCssColor() ?>] px-2 inline-block text-xl font-medium" data-cpc="<?= $candle->getCssColor() ?>">
          <?= $candle->getName() ?>
        </h2>

        <?php
        if ($user && $user["rol"] !== "customer") {
        ?>
          <a class="icon icon--pencil" href="dashboard.php?section=edit-product&id=<?= $candle->getId() ?>"></a>
        <?php
        }
        ?>

        <small class="badge"><?= $candle->getCategory()->getName() ?></small>
      </div>

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
        <div class="my-2 py-2 border-y border-gray-300/70">
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

      <!-- Details -->
      <div class="my-2 py-2 border-y border-gray-300/70">
        <ul>
          <?php foreach ($candle->getDetails() as $detail) { ?>
            <li class="flex gap-2 my-1" title="<?= $detail["title"] ?>">
              <span class="icon <?= $detail["icon"] ?>"></span>
              <?= $detail["value"] ?>
            </li>
          <?php } ?>
        </ul>
      </div>

      <!-- Cta (form) -->
      <form class="flex gap-4 justify-end" action="actions/cart-add-item-acc.php" method="get">
        <input type="hidden" name="id" value="<?= $candle->getId() ?>">

        <label>
          <span class="sr-only">Cantidad</span>
          <input type="number" name="amount" min="1" max="99" value="1" placeholder="Cantidad">
        </label>

        <button class="btn" type="submit">
          <span class="icon icon--cart-add-white"></span>
          Agregar al carrito
        </button>
      </form>
    </div>
  </div>
<?php
}
?>





<!--
*********************************************************************************
                                    SCRIPTS
*********************************************************************************
-->
<script defer src="js/view-product-detail.js"></script>