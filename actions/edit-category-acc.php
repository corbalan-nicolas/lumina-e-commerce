<?php

require_once "../functions/autoload.php";
Authentication::verifyView(1, "../");

$formData = $_GET;

// echo "<pre>";
// print_r($formData);
// echo "</pre>";

try {
  $category = Category::filter_by_id($formData["id"]);
  $category->update($formData["category"]);
} catch (Exception $e) {
  die("No se pudo actualizar la categoría");
}

header("Location: ../dashboard.php?section=admin-categories");
