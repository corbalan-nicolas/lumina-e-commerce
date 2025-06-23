<h2 class="text-4xl font-medium mx-4 my-8">Administrar Productos</h2>

<?php

$candles = Candle::get_all_products();

?>

<div class="p-4">

  <a class="btn fixed bottom-4 right-4" href="dashboard.php?section=add-product">Agregar Nuevo Producto</a>

  <div>
    Mostrar / Ocultar atributos de la tabla

    <?php
    $values = [
      "id" => "Id",
      "cover" => "Portada de producto",
      "carrusel" => "Fotos del carrusel",
      "name" => "Nombre",
      "descr" => "Descripción",
      "category" => "Categoría",
      "price" => "Precio",
      "discount" => "Descuento",
      "details" => "Detalle de producto",
      "release" => "Fecha de publicación",
      "color" => "Color identificativo del producto",
    ];

    foreach ($values as $key => $value) {
    ?>
      <label class="flex">
        <input type="checkbox" name="<?= $key ?>">
        <?= $value ?>
      </label>
    <?php
    }
    ?>

  </div>

  <table class="table">
    <thead>
      <tr>
        <th>Id</th>
        <th>Cover</th>
        <th>Carrusel</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Categoría</th>
        <th>Etiquetas</th>
        <th>Precio</th>
        <th>Descuento</th>
        <th>Detalles</th>
        <th>Publicación</th>
        <th>Color</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($candles as $candle) {
      ?>
        <tr class="tr--parent">
          <td class="td--id"><?= $candle->getId() ?></td>
          <td><img src="<?= "img/candles/{$candle->getMainImg()}" ?>" alt="Foto de portada"></td>
          <td>
            <?php
            foreach ($candle->getExtraImg() as $i => $img) {
            ?>
              <img class="size-8" src="<?= "img/candles/carousel/{$img->getFilename()}" ?>" alt="Foto de producto <?= $i + 1 ?>">
            <?php
            }
            ?>
          </td>
          <td class="td--identifier"><a href="index.php?section=product-detail&id=<?= $candle->getId() ?>" title="Ir a la página del producto"><?= $candle->getName() ?></a></td>
          <td><?= $candle->getDescription() ?></td>
          <td><?= $candle->getCategory()->getName() ?></td>
          <td>
            <?php
            foreach ($candle->getTags() as $tag) {
            ?>
              <span><?= $tag->getTag() ?></span>
            <?php
            }
            ?>
          </td>
          <td>$<?= $candle->getPrice() ?></td>
          <td><?= $candle->getDiscount() ?>% off</td>
          <td>
            <div class="flex gap-2" title="Material">
              <span class="icon icon--box"></span>
              <?= $candle->getDetails()["material"] ?>
            </div>
            <div class="flex gap-2" title="Duración">
              <span class="icon icon--clock"></span>
              <?= $candle->getDetails()["duration"] ?>
            </div>
            <div class="flex gap-2" title="Tamaño">
              <span class="icon icon--ruler"></span>
              <?= $candle->getDetails()["size"] ?>
            </div>
            <div class="flex gap-2" title="Peso">
              <span class="icon icon--weight"></span>
              <?= $candle->getDetails()["weight"] ?>
            </div>
            <div class="flex gap-2" title="Fragancia">
              <span class="icon icon--plant"></span>
              <?= $candle->getDetails()["fragance"] ?>
            </div>
          </td>
          <td><?= $candle->getdateRelease() ?></td>
          <td class="bg-[<?= $candle->getCssColor() ?>] rounded" data-cpc="<?= $candle->getCssColor() ?>"></td>
          <td>
            <a href="dashboard.php?section=edit-product&id=<?= $candle->getId() ?>">Editar</a>
            <button class="btn--delete">Borrar</button>
          </td>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>

  <dialog id="modalDelete" class="modal">
    <p>¿Estás seguro de que querés borrar este producto?</p>
    <strong id="identifier"></strong>
    <form action="actions/delete-candle-acc.php" method="get">
      <input type="hidden" id="inputId" name="id">
      <div class="modal__footer">
        <button id="closeModal" class="btn btn--outlined" type="button">Cancelar</button>
        <button class="btn" type="submit">Confirmar</button>
      </div>
    </form>
  </dialog>
</div>

<script defer src="js/dashboard/modal-delete.js"></script>