<?php

require_once "../functions/autoload.php";
Authentication::verifyView(2, "../");

try {
  Tag::insert($_POST["tag"]);

  Alert::addAlert('success', 'La etiqueta se agregó correctamente');
} catch (Exception $e) {
  Alert::addAlert('danger', 'No se puedo agregar la etiqueta, contacte con servicio técnico');
}

header("Location: ../dashboard.php?section=admin-tags");
