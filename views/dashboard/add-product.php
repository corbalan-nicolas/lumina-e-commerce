<h2 class="text-4xl font-medium mx-4 my-8">Añadir nuevo producto</h2>

<div class="p-4">





  <!--
  *********************************************************************************
                                      ALERTS
  *********************************************************************************
  -->
  <?php require_once "includes/alerts.php" ?>





  <!--
  *********************************************************************************
                                        FORM
  *********************************************************************************
  -->
  <form class="grid gap-x-4 md:grid-cols-2" action="actions/add-product-acc.php" method="post" enctype="multipart/form-data">
    <!-- Name, description, category -->
    <div>
      <div>
        <div class="mb-3">
          <label>
            Nombre <span class="text-red-500">*</span>
            <input type="text" name="name" placeholder="Preferiblemente que no sea muy largo" autocomplete="off" required>
          </label>
        </div>

        <div class="mb-3">
          <label>
            Descripción <span class="text-red-500">*</span>
            <textarea name="description" rows="6" placeholder="Descripción del producto" autocomplete="off" required></textarea>
          </label>
        </div>

        <div>
          <label for="selectCategory">Categoría <span class="text-red-500">*</span></label>
          <div class="mb-3 flex gap-4">

            <select id="selectCategory" class="py-2 px-4 bg-gray-100" name="category" required>
              <option value="" selected hidden>Seleccione una categoría</option>
              <?php
              foreach (Category::get_all_categories() as $category) {
              ?>
                <option name="category" value="<?= $category->getId() ?>"><?= $category->getName() ?></option>
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
            <input type="number" min="0.01" max="99,99" step="0.01" name="price" placeholder="Ejemplo: 00,00" required>
          </label>
        </div>

        <div class="mb-3">
          <label>
            Descuento <span class="text-red-500">*</span>
            <input type="number" min="0" max="100" name="discount" value="0" required>
          </label>
        </div>
      </div>

      <div>
        <label for="colorInput">Color <span class="text-red-500">*</span></label>
        <div class="input-group mb-3">
          <input id="colorInput" name="cssColor" type="text" placeholder="Acepta rgb, hsl, hexadecimal o cualquier color nativo de css" autocomplete="off" required>
          <label class="has-focus-visible:ring-1">
            <input id="colorPicker" class="sr-only" type="color" value="#7f7f7f">
            <span class="p-2 icon icon--picker"></span>
          </label>
        </div>
        Preview del color:
        <div id="colorDiv" class="h-16 w-full mb-3 border"></div>
      </div>
    </div>

    <!-- Images -->
    <div>
      <div class="mb-3">
        <div class="mb-3">
          <label>
            Foto de portada <span class="text-red-500">*</span>
            <input class="px-4 py-2 block w-full rounded border-2 border-dashed" type="file" name="cover" required>
          </label>
        </div>

        <div class="mb-[.80rem]">
          <label>
            Fotos secundarias para el carrusel
            <input class="p-4 block w-full rounded border-2 border-dashed" type="file" name="extra_images[]" multiple>
          </label>
        </div>
      </div>

      <div class="grid grid-cols-2 gap-x-4 gap-y-3 mb-3">
        <div>
          <label>
            Material <span class="text-red-500">*</span>
            <input type="text" name="material" placeholder="Material de la vela" required>
          </label>
        </div>

        <div>
          <label>
            Duración <span class="text-red-500">*</span>
            <input type="text" name="duration" placeholder="Tiempo que dura encendida" required>
          </label>
        </div>

        <div>
          <label>
            Tamaño <span class="text-red-500">*</span>
            <input type="text" name="size" placeholder="Alto x Ancho (en centímetros)" required>
          </label>
        </div>

        <div>
          <label>
            Peso <span class="text-red-500">*</span>
            <input type="text" name="weight" placeholder="Peso (en gramos)" required>
          </label>
        </div>

        <div>
          <label>
            Fragancia <span class="text-red-500">*</span>
            <input type="text" name="fragance" placeholder="Fragancia/s" required>
          </label>
        </div>
      </div>

      <div class="mb-3 grid grid-cols-3">
        <p class="col-span-full">Etiquetas</p>
        <?php
        $tags = Tag::get_all_tags();

        foreach ($tags as $tag) {
        ?>
          <label>
            <input type="checkbox" name="tags[]" value="<?= $tag->getId() ?>">
            <?= $tag->getTag() ?>
          </label>
        <?php
        }
        ?>
      </div>
    </div>

    <div class="col-span-full">
      <div class="my-3">
        <label>
          <input type="checkbox" name="goBackToForm">
          Redireccionar de nuevo a esta página luego de añadir el producto
        </label>
      </div>

      <button class="btn">Añadir producto</button>
    </div>
  </form>
</div>





<!--
*********************************************************************************
                                    SCRIPT
*********************************************************************************
-->
<script defer src="js/dashboard/add-product-script.js"></script>