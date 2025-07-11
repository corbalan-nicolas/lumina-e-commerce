<?php
require_once "../functions/autoload.php";
Authentication::verifyView(2, "../");

$id = $_GET["id"] ?? 0;

try {
  $category = Category::filter_by_id($id);
  $category->delete();

  Alert::addAlert("success", "Se eliminó correctamente la categoría");
} catch (Exception $e) {
  // echo "<pre>";
  // print_r($e);
  // echo "</pre>";
  // die("Error en el catch");

  switch ($e->getCode()) {
    case 23000:
      Alert::addAlert("danger", "Esta categoría no se puede borrar porque está siendo utilizada por algún producto");
      break;
    default:
      Alert::addAlert("danger", "Ocurrió un error desconocido, que vergüenza...");
      break;
  }
}

header("Location: ../dashboard.php?section=admin-categories");
