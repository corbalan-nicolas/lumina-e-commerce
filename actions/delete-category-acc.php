<?php
require_once "../functions/autoload.php";
Authentication::verifyView(1, "../");

$id = $_GET["id"] ?? 0;

try {
  $category = Category::filter_by_id($id);
  $category->delete();
} catch (Exception $e) {
  echo "<pre>";
  print_r($e);
  echo "</pre>";
  die("No se puso eliminar la categoría");
}

header("Location: ../dashboard.php?section=admin-categories");
