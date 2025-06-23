<?php

require_once "../functions/autoload.php";
Authentication::verifyView(1, "../");

try {
  Tag::insert($_POST["tag"]);
} catch (Exception $e) {
  die("No se puso agregar la nueva etiqueta :c");
}

header("Location: ../dashboard.php?section=admin-tags");
