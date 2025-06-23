<h2 class="text-4xl font-medium mx-4 my-8">Administrar Etiquetas</h2>

<?php

$tags = Tag::get_all_tags();

?>

<div class="p-4">

  <form action="actions/add-tag-acc.php" method="post">
    <input type="text" name="tag" placeholder="Etiqueta" autofocus>
    <button class="btn">Añadir nueva etiqueta</button>
  </form>

  <table class="table">

    <thead>
      <tr>
        <th>#</th>
        <th>Etiqueta</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($tags as $tag) {
      ?>
        <tr class="tr--parent">
          <td class="td--id"><?= $tag->getId() ?></td>
          <td class="td--name td--identifier"><?= $tag->getTag() ?></td>
          <td>
            <button class="btn--edit">Editar</button>
            <button class="btn--delete">Borrar</button>
          </td>
        </tr>
      <?php
      }
      ?>
    </tbody>

  </table>

  <dialog id="modalEdit" class="modal">
    <p>Editar Etiqueta</p>
    <form action="actions/edit-tag-acc.php" method="get">
      <input type="hidden" id="inputId" name="id">
      <input type="text" id="inputName" name="tag" placeholder="Etiqueta" autofocus>

      <div class="modal__footer">
        <button id="closeModal" class="btn btn--outlined" type="button">Cancelar</button>
        <button class="btn" type="submit">Editar</button>
      </div>
    </form>
  </dialog>
</div>

<script defer src="js/dashboard/modal-edit.js"></script>