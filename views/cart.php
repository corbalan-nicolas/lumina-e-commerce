<?php

$items = Cart::getItems();

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

?>

<div class="p-4">
  <h2 class="text-4xl font-medium mb-8 mt-4">Carrito de Compras</h2>

  <div class="cart lg:grid grid-cols-[1fr_minmax(300px,_auto)] gap-4">
    <div>
      <div class="cart__products flex flex-col gap-4 mb-4">
        <?php
        if (!$items) {
        ?>
          <p>Tu carrito está vacío</p>
          <?php
        } else {
          foreach ($items as $id_candle => $amount) {
            $candle = Candle::filter_by_id($id_candle);

          ?>
            <div class="cart__card">
              <div class="cart__card-cover">
                <img src="img/candles/<?= $candle->getMainImg() ?>" alt="Foto de portada del producto">
              </div>

              <div class="cart__card-name">
                <h3 class="font-bold"><a href="index.php?section=product-detail&id=<?= $candle->getId() ?>"><?= $candle->getName() ?></a></h3>
                <p title="Precio por unidad">$<?= $candle->getPrice() ?> p/u</p>
              </div>

              <p class="cart__card-subtotal"><strong>$<?= number_format(($candle->getPrice() * $amount), 2) ?></strong></p>

              <div class="cart__card-amount flex gap-2">
                <button class="icon icon--minus" data-function="subtract-item" data-id="<?= $candle->getId() ?>" aria-label="Restar 1">-</button>
                <button class="icon icon--plus" data-function="add-item" data-id="<?= $candle->getId() ?>" aria-label="Sumar 1">+</button>
                <p id="amountProd<?= $candle->getId() ?>"><?= $amount ?></p>
              </div>

              <a
                class="cart__card-remove icon icon--20 icon--close"
                href="actions/cart-remove-item-acc.php?id=<?= $candle->getId() ?>"
                title="Eliminar <?= $candle->getName() ?> del carrito"
                aria-label="Eliminar del carrito">
              </a>
            </div>
          <?php
          }
          ?>
      </div>

      <div class="mt-8 cart__actions flex justify-between items-center">
        <a class="btn btn--outlined" href="index.php?section=catalog">Seguir comprando</a>
        <a class="underline" href="actions/cart-clear-acc.php">Eliminar todos los productos</a>
      </div>
    </div>





    <div class="cart__checkout">
      <p class="flex justify-between"><span>Total estimado:</span> <strong>USD $<?= number_format(Cart::getTotal(), 2) ?></strong></p>

      <a href="index.php?section=checkout" class="btn btn--text-normal mt-4">Continuar al Pago</a>
    </div>
  <?php
        }
  ?>
  </div>
</div>

<script defer src="js/cart.js"></script>