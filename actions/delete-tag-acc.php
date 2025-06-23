<?php
require_once "../functions/autoload.php";
Authentication::verifyView(1, "../");

$id = $_GET["id"] ?? 0;

try {
  $tag = Tag::filter_by_id($id);
  $tag->delete();
} catch (Exception $e) {
  // echo "<pre>";
  // print_r($e);
  // echo "</pre>";
  die("No se puso eliminar la etiqueta");
}

header("Location: ../dashboard.php?section=admin-tags");
