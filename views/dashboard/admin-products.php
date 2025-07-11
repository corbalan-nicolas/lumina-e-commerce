<h2 class="text-4xl font-medium mx-4 my-8">Administrar Productos</h2>

<?php

$candles = Candle::get_all_products();

?>

<div class="p-4">





  <!--
  *********************************************************************************
                                      ALERTS
  *********************************************************************************
  -->
  <?php require_once "includes/alerts.php" ?>






  <!--
  *********************************************************************************
                                      ADD NEW
  *********************************************************************************
  -->
  <div class="pb-4 flex justify-end">
    <a class="btn" href="dashboard.php?section=add-product">
      <span class="icon icon--plus-white"></span>
      Agregar Nuevo Producto
    </a>
  </div>







  <!--
  *********************************************************************************
                                ALL PRODUCTS (LIST)
  *********************************************************************************
  -->
  <div>
    <ul class="sm:grid grid-cols-[auto_1fr]">
      <?php
      foreach ($candles as $candle) {
      ?>
        <li class="mb-4 col-span-full sm:grid grid-cols-subgrid gap-4">
          <div>
            <!-- COVER -->
            <img class="sm:max-w-60 sm:max-h-60" title="Foto de portada" src="img/candles/<?= $candle->getMainImg() ?>" alt="Foto de portada del producto">


            <!-- EXTRA IMAGES -->
            <?php if (count($candle->getExtraImg())) { ?>

              <ul title="Imágenes del carrusel" class="flex">
                <?php foreach ($candle->getExtraImg() as $i => $img) { ?>
                  <li>
                    <img class="max-w-12 max-h-12" src="img/candles/carousel/<?= $img->getFilename() ?>" alt="Foto de producto <?= $i + 1 ?>">
                  </li>
                <?php } ?>
              </ul>

            <?php } ?>
          </div>


          <div>
            <!-- ID + NAME + CATEOGRY + ACTIONS -->
            <div class="flex gap-2">
              <p title="Id">#<?= $candle->getId() ?> </p>
              <h3 title="Nombre del producto"> | <a href="index.php?section=product-detail&id=<?= $candle->getId() ?>"><?= $candle->getName() ?></a></h3>
              <p title="Categoría"> | <?= $candle->getCategory()->getName() ?></p>
              <div class="flex grow-1 justify-end gap-4">
                <a class="icon icon--pencil" href="dashboard.php?section=edit-product&id=<?= $candle->getId() ?>">Editar</a>
                <button class="icon icon--trash" data-function="open-modal-delete" data-id="<?= $candle->getId() ?>" data-name="<?= $candle->getName() ?>">Eliminar</button>
              </div>
            </div>


            <!-- PRICE + DISCOUNT -->
            <div class="flex gap-2 items-end">
              <p class="text-xl font-bold">USD $<?= $candle->getPrice() ?></p>
              <?php if ($candle->getDiscount()) { ?>
                <small><?= $candle->getDiscount() ?>% off</small>
              <?php } ?>
            </div>


            <!-- TAGS -->
            <?php if ($candle->getTags()) { ?>
              <div class="my-2 py-2 border-y border-gray-300/70">
                <span>Etiquetas: </span>
                <?php foreach ($candle->getTags() as $tag) { ?>
                  <span><?= $tag->getTag() ?></span>
                <?php } ?>
              </div>
            <?php } ?>


            <!-- DESCRIPTION -->
            <p><?= $candle->getDescription() ?></p>


            <!-- DETAILS -->
            <ul class="grid grid-cols-2 grid-rows-3">
              <?php foreach ($candle->getDetails() as $detail) { ?>
                <li class="flex gap-2 my-1" title="<?= $detail["title"] ?>">
                  <span class="icon <?= $detail["icon"] ?>"></span>
                  <?= $detail["value"] ?>
                </li>
              <?php } ?>
              <li class="flex gap-2" title="Fecha de publicación">
                <span class="icon icon--calendar"></span>
                <?= $candle->getdateRelease() ?>
              </li>
            </ul>
          </div>
        </li>
      <?php
      }
      ?>
    </ul>
    <!-- Every card has to show the following params:
      - [x] Id
      - [x] Name
      - [x] Description
      - [x] Category
      - [ ] Tags
      - [x] Price
      - [x] Discount
      - [x] Cover
      - [x] Extra images 
      - [x] Details
      - [x] Date release
      - [x] Actions
    -->
  </div>
</div>






<!--
*********************************************************************************
                            MODAL CONFIRM DELETE
*********************************************************************************
-->
<dialog id="modalDelete" class="modal">
  <p>¿Estás seguro de que querés borrar este producto?</p>
  <strong id="modalDeleteName">nombre del producto</strong>

  <form action="actions/delete-candle-acc.php" method="get">
    <input type="hidden" id="modalDeleteId" name="id">
    <div class="modal__footer">
      <button id="modalDeleteClose" class="btn btn--outlined" type="button">Cancelar</button>
      <button class="btn btn--danger" type="submit">Confirmar</button>
    </div>
  </form>

</dialog>






<!--
*********************************************************************************
                                    SCRIPTS
*********************************************************************************
-->
<script defer src="js/dashboard/modal-delete.js"></script>