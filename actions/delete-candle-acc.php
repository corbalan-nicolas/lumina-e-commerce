<?php

require_once "../functions/autoload.php";
Authentication::verifyView(1, "../");

$id = $_GET["id"] ?? 0;

$candle = Candle::filter_by_id($id);

try {
  $candle->clearTags();
  $candle->clearExtraImages();

  Image::delete("../img/candles/" . $candle->getMainImg());

  foreach ($candle->getExtraImg() as $img) {
    Image::delete("../img/candles/carousel" . $img->getFilename());
  }

  $candle->delete();

  Alert::addAlert("success", "El producto se eliminó correctamente");
} catch (Exception $e) {
  // echo "<pre>";
  // print_r($e);
  // echo "</pre>";
  // die("Error en el catch");

  Alert::addAlert('danger', 'No se pudo eliminar el producto, contacte con servicio técnico');
}

header("Location: ../dashboard.php?section=admin-products");
