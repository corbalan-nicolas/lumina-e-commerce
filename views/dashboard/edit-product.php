<?php

$id = $_GET["id"] ?? 0;
$candle = Candle::filter_by_id($id);

// echo "<br><br><p><strong>Datos de la vela</strong></p>";
// echo "<pre>";
// print_r($candle);
// echo "</pre>";

?>

<div class="p-4">
  <h2>Editar producto</h2>





  <!--
  *********************************************************************************
                                        FORM
  *********************************************************************************
  -->
  <form action="actions/add-product-acc.php" method="post" enctype="multipart/form-data">
    <!-- Name, description, category -->
    <div>
      <div>
        <label>
          Nombre
          <input type="text" name="name" value="<?= $candle->getName() ?>" placeholder="Nombre del producto">
        </label>
      </div>

      <div>
        <label>
          Descripción
          <textarea name="description" placeholder="Descripción del producto"></textarea>
        </label>
      </div>

      <div>
        <select id="selectCategory" name="category">
          <option selected hidden>Selecciones una categoría</option>
          <?php
          foreach (Category::get_all_categories() as $category) {
          ?>
            <option name="category" value="<?= $category->getId() ?>"><?= $category->getName() ?></option>
          <?php
          }
          ?>
          <option value="newCategory">Añadir nueva categoría</option>
        </select>
        <input type="hidden" id="inputCategory" name="newCategory" placeholder="Nueva categoría">
      </div>
    </div>

    <!-- Images -->
    <div>
      <div>
        <label>
          Foto de portada
          <input type="file" name="cover">
        </label>
      </div>

      <div>
        <label>
          Fotos secundarias (carrusel)
          <input type="file" name="extra_images[]" multiple>
        </label>
      </div>
    </div>

    <div>
      <label>
        Precio
        <input type="text" name="price">
      </label>
    </div>

    <div>
      <label>
        Descuento
        <input type="text" name="discount">
      </label>
    </div>

    <div>
      Color
      <div class="grid grid-cols-[1fr_auto] grid-rows-[1fr]">
        <input id="colorInput" name="cssColor" type="text" placeholder="Acepta rgb, hsl, hexadecimal o cualquier color nativo de css, hay que tener en cuenta la sintaxis">
        <label>
          <input id="colorPicker" class="sr-only" type="color">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-color-picker">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M11 7l6 6" />
            <path d="M4 16l11.7 -11.7a1 1 0 0 1 1.4 0l2.6 2.6a1 1 0 0 1 0 1.4l-11.7 11.7h-4v-4z" />
          </svg>
        </label>
      </div>
      <div id="colorDiv" class="size-12 border"></div>
    </div>

    <div>
      Etiquetas
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

    <div>
      <label>
        Material
        <input type="text" name="material">
      </label>
    </div>

    <div>
      <label>
        Duración
        <input type="text" name="duration">
      </label>
    </div>

    <div>
      <label>
        Tamaño
        <input type="text" name="size">
      </label>
    </div>

    <div>
      <label>
        Peso
        <input type="text" name="weight">
      </label>
    </div>

    <div>
      <label>
        Fragancia
        <input type="text" name="fragance">
      </label>
    </div>

    <div>
      <label>
        <input type="checkbox" name="goBackToForm">
        Redireccionar de nuevo a esta página luego de añadir el producto
      </label>
    </div>

    <button>Añadir producto</button>
  </form>
</div>