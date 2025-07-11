<?php

require_once "../functions/autoload.php";
Authentication::verifyView(2, "../");

$id = $_GET["id"] ?? 0;

$candle = Candle::filter_by_id($id);

try {
  $candle->clearTags();
  $candle->clearExtraImages();

  // Image::delete("../img/candles/" . $candle->getMainImg());

  // foreach ($candle->getExtraImg() as $img) {
  //   Image::delete("../img/candles/carousel" . $img->getFilename());
  // }

  $candle->delete();

  Alert::addAlert("success", "El producto se eliminó correctamente");
} catch (Exception $e) {
  // echo "<pre>";
  // print_r($e);
  // echo "</pre>";
  // die("Error en el catch");

  switch ($e->getCode()) {
    case 23000:
      Alert::addAlert("danger", "No se puede eliminar este producto porque está siendo utilizado por otra entidad");
      break;
    default:
      Alert::addAlert("danger", "Ocurrió un error desconocido, que vergüenza...");
      break;
  }
}

header("Location: ../dashboard.php?section=admin-products");
