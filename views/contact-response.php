<?php

$formData = $_POST;

?>

<div class="p-4">
  <h2>¡Hola <?= $formData["firstName"] ?>! Gracias por ponerte en contacto con nosotros</h2>
  <p>En los próximos días estaremos respondiendo a tu pregunta al siguiente mail: <?= $formData["email"] ?></p>
</div>