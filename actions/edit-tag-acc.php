<?php

require_once "../functions/autoload.php";
Authentication::verifyView(1, "../");

$formData = $_GET;

// echo "<pre>";
// print_r($formData);
// echo "</pre>";

try {
  $tag = Tag::filter_by_id($formData["id"]);
  $tag->update($formData["tag"]);

  Alert::addAlert('success', 'La etiqueta se editó correctamente');
} catch (Exception $e) {
  Alert::addAlert('danger', 'No se pudo editar la etiqueta');
}

header("Location: ../dashboard.php?section=admin-tags");
