<?php

require_once "../functions/autoload.php";
Authentication::verifyView(1, "../");

try {
  Category::insert($_GET["category"]);
} catch (Exception $e) {
  die("No se puso agregar la nueva categoría :c");
}

header("Location: ../dashboard.php?section=admin-categories");
