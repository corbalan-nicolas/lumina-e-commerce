<?php

$purchases = Purchase::filter_by_user($_SESSION["lumina-user"]["id"]);

?>

<div class="p-4">
  <h2 class="text-4xl font-medium mb-8 mt-4">Historial de compras</h2>





  <!--
  *********************************************************************************
                                      ALERTS
  *********************************************************************************
  -->
  <?php require_once "includes/alerts.php" ?>





  <!--
  *********************************************************************************
                                      PURCHASES
  *********************************************************************************
  -->
  <div>
    <?php if (!$purchases) { ?>
      <p>¡Todavía no hiciste ninguna compra!</p>
      <?php } else {
      foreach ($purchases as $purchase) {
      ?>
        <details class="purchase mb-2">
          <summary class="purchase__summary" title="Ver detalles">
            <?= "{$purchase->getPurchaseDate()}, x{$purchase->getQuantityOfItems()} items <strong>USD \${$purchase->getAmount()}</strong>" ?>
          </summary>


          <div class="purchase__content">
            <p>Lista de productos adquiridos:</p>

            <ol class="purchase__details">
              <?php foreach ($purchase->getItems() as $item) { ?>
                <li class="grid grid-cols-[auto_1fr_auto] items-center gap-4">

                  <img class="img-carousel" src="img/candles/<?= $item["main_img"] ?>" alt="Foto de producto">

                  <p>x<?= $item["quantity"] ?> <a href="index.php?section=product-detail&id=<?= $item["id_item"] ?>"><?= $item["name"] ?></a></p>

                  <?php if ($item["discount_applied"]) { ?>
                    <p>(-<?= $item["discount_applied"] ?>% off) <strong>USD $<?= $item["price"] ?></strong></p>
                  <?php } else { ?>
                    <strong>USD $<?= $item["price"] ?></strong>
                  <?php } ?>

                </li>
              <?php } ?>
            </ol>

          </div>
        </details>
      <?php
      }
      ?>
    <?php } ?>
  </div>
</div>