<?php
require_once "../functions/autoload.php";
Authentication::verifyView(2, "../");

$id = $_GET["id"] ?? 0;

try {
  $tag = Tag::filter_by_id($id);
  $tag->delete();

  Alert::addAlert('success', 'La etiqueta se eliminó correctamente');
} catch (Exception $e) {
  // echo "<pre>";
  // print_r($e);
  // echo "</pre>";
  // die("Error en el catch");

  switch ($e->getCode()) {
    case 23000:
      Alert::addAlert("danger", "Esta etiqueta está siendo utilizada por algún producto");
      break;
    default:
      Alert::addAlert("danger", "Hubo un error desconocido, contacte con servicio técnico");
      break;
  }
}

header("Location: ../dashboard.php?section=admin-tags");
