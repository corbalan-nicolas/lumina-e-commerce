<?php

require_once "../functions/autoload.php";
Authentication::verifyView(2, "../"); // No sé si esto me sirve de algo, pero bueno jsj

$id = $_GET["id"] ?? 0;

$candle = Candle::filter_by_id($id);

try {
  if (!$candle) {
    throw new Exception("", 1);
  } else if (!$candle->isRemovable()) {
    throw new Exception("", 2);
  }

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

  switch ($e->getCode()) {
    case 1:
      Alert::addAlert("warning", "El producto no pudo ser encontrado");
      break;
    case 2:
    case 23000:
      Alert::addAlert("danger", "No se puede eliminar este producto porque ya fué comprado, y este es un mundo ideal en donde no borramos las cosas que están siendo utilizadas en otra tabla ¿verdad? (⌐■_■)");
      break;
    default:
      Alert::addAlert("danger", "Ocurrió un error desconocido, que vergüenza...");
      break;
  }
}

header("Location: ../dashboard.php?section=admin-products");
