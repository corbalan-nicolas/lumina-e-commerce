<?php

require_once "../functions/autoload.php";
Authentication::verifyView(1, "../");

$id = $_GET["id"] ?? 0;

$candle = Candle::filter_by_id($id);

try {
  $candle->clearTags();
  $candle->clearExtraImages();
  $candle->delete();
} catch (Exception $e) {
  die("No se pudo eliminar el producto");
}

header("Location: ../dashboard.php?section=admin-products");
