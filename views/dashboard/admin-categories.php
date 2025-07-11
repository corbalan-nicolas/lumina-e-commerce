<h2 class="text-4xl font-medium mx-4 my-8">Administrar Categorías</h2>

<?php

$categories = Category::get_all_categories();

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
                                FORM ADD NEW CATEGORY
  *********************************************************************************
  -->
  <form class="mb-4" action="actions/add-category-acc.php" method="get">
    <input type="text" name="category" placeholder="Nueva categoría" aria-label="Nombre de la categoría" required>
    <button class="btn">
      <span class="icon icon--plus-white"></span>
      Añadir nueva categoría
    </button>
  </form>





  <!--
  *********************************************************************************
                                TABLE OF CATEGORIES
  *********************************************************************************
  -->
  <div class="table__container">
    <table class="table">

      <thead class="table__header">
        <tr class="table__tr">
          <th class="table__th">#</th>
          <th class="table__th">Categoría</th>
          <th class="table__th sr-only">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($categories as $category) {
        ?>
          <tr class="table__tr">
            <td class="table__td"><?= $category->getId() ?></td>
            <td class="table__td"><?= $category->getName() ?></td>
            <td class="table__td flex justify-end gap-2">
              <button title="Editar" class="icon icon--pencil" data-function="open-modal-edit" data-id="<?= $category->getId() ?>" data-name="<?= $category->getName() ?>">Editar</button>
              <button title="Eliminar" class="icon icon--trash" data-function="open-modal-delete" data-id="<?= $category->getId() ?>" data-name="<?= $category->getName() ?>">Borrar</button>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>

    </table>
  </div>





  <!--
  *********************************************************************************
                              MODAL EDIT CATEGORY
  *********************************************************************************
  -->
  <dialog id="modalEdit" class="modal">
    <p>Editar categoría</p>
    <form action="actions/edit-category-acc.php" method="get">
      <input type="hidden" id="modalEditId" name="id">
      <input type="text" id="modalEditName" name="category" placeholder="Categoría" aria-label="Nombre de la categoría" required autofocus>

      <div class="modal__footer">
        <button id="modalEditClose" class="btn btn--outlined" type="button">Cancelar</button>
        <button class="btn" type="submit">Editar</button>
      </div>
    </form>
  </dialog>





  <!--
  *********************************************************************************
                              MODAL CONFIRM DELETE
  *********************************************************************************
  -->
  <dialog id="modalDelete" class="modal">
    <p>¿Estás seguro de que querés borrar esta etiqueta?</p>
    <strong id="modalDeleteName">Nombre de la etiqueta</strong>

    <form action="actions/delete-category-acc.php" method="get">
      <input type="hidden" id="modalDeleteId" name="id">
      <div class="modal__footer">
        <button id="modalDeleteClose" class="btn btn--outlined" type="button">Cancelar</button>
        <button class="btn btn--danger" type="submit">Confirmar</button>
      </div>
    </form>

  </dialog>
</div>





<!--
  *********************************************************************************
                                    SCRIPTS
  *********************************************************************************
  -->
<script defer src="js/dashboard/modal-edit.js"></script>
<script defer src="js/dashboard/modal-delete.js"></script>