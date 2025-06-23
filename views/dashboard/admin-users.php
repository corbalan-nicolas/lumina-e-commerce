<h2 class="text-4xl font-medium mx-4 my-8">Lista de Usuarios</h2>

<?php

$users = User::get_all_users();

?>

<div class="p-4">
  <table class="table">
    <thead>
      <tr>
        <th>#</th>
        <th>Nombre completo</th>
        <th>Email</th>
        <th>Rol</th>
        <th>Fecha de creación</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($users as $user) {
      ?>
        <tr>
          <td><?= $user->getId() ?></td>
          <td><?= $user->getFullName() ?></td>
          <td><?= $user->getEmail() ?></td>
          <td><?= ucfirst($user->getRol()) ?></td>
          <td><?= $user->getDateCreated() ?></td>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
</div>