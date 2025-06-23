<h2 class="text-4xl font-medium mx-4 my-8">Administrar Categorías</h2>

<?php

$categories = Category::get_all_categories();

?>

<div class="p-4">

  <form action="actions/add-category-acc.php" method="get">
    <input type="text" name="category" placeholder="Categoría" autofocus>
    <button class="btn">Añadir nueva categoría</button>
  </form>

  <table class="table">

    <thead>
      <tr>
        <th>#</th>
        <th>Categoría</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($categories as $category) {
      ?>
        <tr class="tr--parent">
          <td class="td--id"><?= $category->getId() ?></td>
          <td class="td--name"><?= $category->getName() ?></td>
          <td>
            <button class="btn--edit">Editar</button>
            <a href="actions/delete-category-acc.php?id=<?= $category->getId() ?>">Borrar</a>
          </td>
        </tr>
      <?php
      }
      ?>
    </tbody>

  </table>

  <dialog id="modalEdit" class="modal">
    <p>Editar categoría</p>
    <form action="actions/edit-category-acc.php" method="get">
      <input type="hidden" id="inputId" name="id">
      <input type="text" id="inputName" name="category" placeholder="Categoría" autofocus>

      <div class="modal__footer">
        <button id="closeModal" class="btn btn--outlined" type="button">Cancelar</button>
        <button class="btn" type="submit">Editar</button>
      </div>
    </form>
  </dialog>
</div>

<script defer src="js/dashboard/modal-edit.js"></script>