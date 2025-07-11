<?php

require_once "../functions/autoload.php";
Authentication::verifyView(2, "../");

try {
  Category::insert($_GET["category"]);

  Alert::addAlert('success', 'La categoría se agregó correctamente');
} catch (Exception $e) {
  Alert::addAlert('danger', 'No se pudo agregar la categoría, contacte con servicio técnico');
}

header("Location: ../dashboard.php?section=admin-categories");
