<?php

$id = $_GET["id"] ?? 0;
$candle = Candle::filter_by_id($id);

// echo "<br><br><p><strong>Datos de la vela</strong></p>";
// echo "<pre>";
// print_r($candle);
// echo "</pre>";

?>
<h2 class="text-4xl font-medium mx-4 my-8">Editar "<?= $candle->getName() ?>"</h2>

<div class="p-4">
  <!--
  *********************************************************************************
                                        FORM
  *********************************************************************************
  -->
  <form class="grid gap-x-4 md:grid-cols-2" action="actions/edit-product-acc.php" method="post" enctype="multipart/form-data">
    <!-- Name, description, category -->
    <div>
      <input type="hidden" name="id" value="<?= $candle->getId() ?>">
      <div>
        <div class="mb-3">
          <label>
            Nombre <span class="text-red-500">*</span>
            <input type="text" name="name" value="<?= $candle->getName() ?>" placeholder="Preferiblemente que no sea muy largo" autocomplete="off" required>
          </label>
        </div>

        <div class="mb-3">
          <label>
            Descripción <span class="text-red-500">*</span>
            <textarea name="description" rows="6" placeholder="Descripción del producto" autocomplete="off" required><?= $candle->getDescription() ?></textarea>
          </label>
        </div>

        <div>
          <label for="selectCategory">Categoría <span class="text-red-500">*</span></label>
          <div class="mb-3 flex gap-4">

            <select id="selectCategory" class="py-2 px-4 bg-gray-100" name="category" required>
              <?php
              foreach (Category::get_all_categories() as $category) {
                $selected = $category->getId() == $candle->getCategory()->getId() ? "selected" : "";
              ?>
                <option name="category" value="<?= $category->getId() ?>" <?= $selected ?>><?= $category->getName() ?></option>
              <?php
              }
              ?>
              <option value="newCategory">Añadir nueva categoría</option>
            </select>
            <input id="inputCategory" type="hidden" name="newCategory" placeholder="Nombre de la nueva categoría" autocomplete="off" required>
          </div>
        </div>
      </div>

      <div class="grid gap-4 grid-cols-2">
        <div class="mb-3">
          <label>
            Precio <span class="text-red-500">*</span>
            <input type="number" min="0.01" max="99,99" step="0.01" name="price" value="<?= $candle->getPrice(false) ?>" placeholder="Ejemplo: 00,00" required>
          </label>
        </div>

        <div class="mb-3">
          <label>
            Descuento <span class="text-red-500">*</span>
            <input type="number" min="0" max="100" name="discount" value="<?= $candle->getDiscount() ?>" required>
          </label>
        </div>
      </div>

      <div>
        <label for="colorInput">Color <span class="text-red-500">*</span></label>
        <div class="input-group mb-3">
          <input id="colorInput" name="cssColor" type="text" value="<?= $candle->getCssColor() ?>" placeholder="Acepta rgb, hsl, hexadecimal o cualquier color nativo de css" autocomplete="off" required>
          <label class="has-focus-visible:ring-1">
            <input id="colorPicker" class="sr-only" type="color" value="#7f7f7f">
            <span class="p-2 icon icon--picker"></span>
          </label>
        </div>
        Preview del color:
        <div id="colorDiv" class="h-16 w-full mb-3"></div>
      </div>
    </div>

    <!-- Images -->
    <div>
      <div class="mb-3">
        <div class="mb-3 gap-x-4 grid grid-cols-[auto_1fr] grid-rows-[auto_1fr]">
          <img class="size-30 row-span-full" src="img/candles/<?= $candle->getMainImg() ?>" alt="Foto de portada">
          <label for="cover">Cambiar foto de portada</label>
          <input id="cover" class="p-4 block w-full rounded border-2 border-dashed" type="file" name="cover">
        </div>
        <input type="hidden" name="originalCover" value="<?= $candle->getMainImg() ?>">

        <div class="mb-[.80rem]">
          <p>Eliminar imágenes secundarias</p>
          <ul class="flex mb-3">
            <?php
            foreach ($candle->getExtraImg() as $i => $img) {
            ?>
              <label class="del-image">
                <input type="checkbox" class="sr-only" name="deleteExtraImages[]" value="<?= $img->getId() ?>">
                <img class="size-12" src="img/candles/carousel/<?= $img->getFilename() ?>" alt="Foto de producto <?= $i + 1 ?>" title="Eliminar">
              </label>
            <?php
            }
            ?>
          </ul>
          <label>
            Añadir imágenes secundarias
            <input class="p-4 block w-full rounded border-2 border-dashed" type="file" name="extra_images[]" multiple>
          </label>
        </div>
      </div>

      <div class="grid grid-cols-2 gap-x-4 gap-y-3 mb-3">
        <div>
          <label>
            Material <span class="text-red-500">*</span>
            <input type="text" name="material" value="<?= $candle->getMaterial() ?>" placeholder="Material de la vela" required>
          </label>
        </div>

        <div>
          <label>
            Duración <span class="text-red-500">*</span>
            <input type="text" name="duration" value="<?= $candle->getDuration() ?>" placeholder="Tiempo que dura encendida" required>
          </label>
        </div>

        <div>
          <label>
            Tamaño <span class="text-red-500">*</span>
            <input type="text" name="size" value="<?= $candle->getSize() ?>" placeholder="Alto x Ancho (en centímetros)" required>
          </label>
        </div>

        <div>
          <label>
            Peso <span class="text-red-500">*</span>
            <input type="text" name="weight" value="<?= $candle->getWeight() ?>" placeholder="Peso (en gramos)" required>
          </label>
        </div>

        <div>
          <label>
            Fragancia <span class="text-red-500">*</span>
            <input type="text" name="fragance" value="<?= $candle->getFragance() ?>" placeholder="Fragancia/s" required>
          </label>
        </div>
      </div>

      <div class="mb-3 grid grid-cols-3">
        <p class="col-span-full">Etiquetas</p>
        <?php
        $candleTags = $candle->getArrayOfTagsId();
        $tags = Tag::get_all_tags();

        foreach ($tags as $tag) {
          $checked = in_array($tag->getId(), $candleTags) ? "checked" : "";
        ?>
          <label>
            <input type="checkbox" name="tags[]" value="<?= $tag->getId() ?>" <?= $checked ?>>
            <?= $tag->getTag() ?>
          </label>
        <?php
        }
        ?>
      </div>
    </div>

    <div class="col-span-full my-3">
      <button class="btn">Actualizar producto</button>
    </div>
  </form>
</div>





<!--
*********************************************************************************
                                    SCRIPT
*********************************************************************************
-->
<script defer src="js/dashboard/add-product-script.js"></script>