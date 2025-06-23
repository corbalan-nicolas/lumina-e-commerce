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
} catch (Exception $e) {
  die("No se pudo actualizar la categoría");
}

header("Location: ../dashboard.php?section=admin-tags");
