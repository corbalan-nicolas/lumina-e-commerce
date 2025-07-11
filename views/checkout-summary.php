<?php

$items = Cart::getItems();

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

// echo "<pre>";
// print_r($items);
// echo "</pre>";

?>

<div class="p-4">
  <h2 class="text-4xl font-medium mb-8 mt-4">Finalizar pago</h2>





  <!--
  *********************************************************************************
                                USER FULLNAME & GMAIL
  *********************************************************************************
  -->
  <div>
    <h3 class="text-2xl mb-2 font-regular">Datos del usuario</h3>
    <p>Nombre completo: <span class="font-medium"><?= $user["fullname"] ?></span></p>
    <p>Correo electrónico: <span class="font-medium"><?= $user["email"] ?></span></p>

    <h3 class="text-2xl mb-2 mt-4 font-regular">Productos a comprar</h3>





    <!--
  *********************************************************************************
                                      LIST OF PRODUCTS
  *********************************************************************************
  -->
    <div class="cart__products flex flex-col gap-4 mb-4">

      <?php if (!$items) { ?>

        <p>No hay productos en tu carrito, puede ser que la sesión haya expirado. Lamentamos las molestias que esto pueda ocasionar</p>

        <?php } else {
        foreach ($items as $id_candle => $quantity) {
          $candle = Candle::filter_by_id(intval($id_candle));

          if ($candle) { ?>

            <ul>
              <li class="grid grid-cols-[auto_1fr_auto] gap-4 items-center">
                <img class="img-carousel" src="img/candles/<?= $candle->getMainImg() ?>" alt="Foto de producto">
                <h3>x<?= $quantity ?> <?= $candle->getName() ?></h3>
                <strong>$<?= $candle->getPrice() * $quantity ?></strong>
              </li>
            </ul>

        <?php }
        } ?>

    </div>





    <!--
  *********************************************************************************
                                  FINAL BUTTON!!!
  *********************************************************************************
  -->
    <div>
      <p class="text-end">Total: <strong>USD $<?= Cart::getTotal() ?></strong></p>
      <div class="flex justify-end">
        <a href="actions/checkout-acc.php" class="btn btn--text-normal mt-4">Comprar</a>
      </div>
    </div>
  <?php } ?>
  </div>
</div>