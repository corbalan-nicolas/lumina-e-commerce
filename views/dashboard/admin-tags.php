<h2 class="text-4xl font-medium mx-4 my-8">Administrar Etiquetas</h2>

<?php

$tags = Tag::get_all_tags();

?>

<div class="p-4">





  <!--
  *********************************************************************************
                                      ALERTS
  *********************************************************************************
  -->
  <div class="mb-4">
    <?= Alert::getAlerts() ?>
  </div>





  <!--
  *********************************************************************************
                                FORM ADD NEW TAG
  *********************************************************************************
  -->
  <form action="actions/add-tag-acc.php" method="post">
    <input type="text" name="tag" placeholder="Etiqueta" autofocus>
    <button class="btn">Añadir nueva etiqueta</button>
  </form>





  <!--
  *********************************************************************************
                                  TABLE OF TAGS
  *********************************************************************************
  -->
  <div class="table__container">
    <table class="table">

      <thead class="table__header">
        <tr class="table__tr">
          <th class="table__th">#</th>
          <th class="table__th">Etiqueta</th>
          <th class="table__th sr-only">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($tags as $tag) {
        ?>
          <tr class="table__tr">
            <td class="table__td"><?= $tag->getId() ?></td>
            <td class="table__td"><?= $tag->getTag() ?></td>
            <td class="table__td flex justify-end gap-2">
              <button class="icon icon--pencil" data-function="open-modal-edit" data-id="<?= $tag->getId() ?>" data-name="<?= $tag->getTag() ?>">Editar</button>
              <button class="icon icon--trash" data-function="open-modal-delete" data-id="<?= $tag->getId() ?>" data-name="<?= $tag->getTag() ?>">Borrar</button>
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
                                    MODAL EDIT
  *********************************************************************************
  -->
  <dialog id="modalEdit" class="modal">
    <p>Editar etiqueta</p>
    <form action="actions/edit-tag-acc.php" method="get">
      <input type="hidden" id="modalEditId" name="id">
      <input type="text" id="modalEditName" name="tag" placeholder="Nombre de la etiqueta" autofocus>

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

    <form action="actions/delete-tag-acc.php" method="get">
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