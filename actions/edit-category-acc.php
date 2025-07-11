<?php

require_once "../functions/autoload.php";
Authentication::verifyView(2, "../");

$formData = $_GET;

// echo "<pre>";
// print_r($formData);
// echo "</pre>";

try {
  $category = Category::filter_by_id($formData["id"]);
  $category->update($formData["category"]);

  Alert::addAlert('success', 'La categoría se editó correctamente');
} catch (Exception $e) {
  Alert::addAlert('danger', 'No se pudo editar la categoría, contacte con servicio técnico');
}

header("Location: ../dashboard.php?section=admin-categories");
