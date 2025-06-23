<?php

require_once "../functions/autoload.php";

$formData = $_GET;

try {
  $result = Authentication::logIn($formData["email"], $formData["password"]);

  if (!$result) {
    // User doesn't exists || wrong password
    header("Location: ../index.php?section=login");
  } else if ($result == "customer") {
    // It's customer
    header("Location: ../index.php");
  } else {
    // It's admin or superadmin
    header("Location: ../dashboard.php");
  }
} catch (Exception $e) {
  die("Algo salió mal durante la validación D:");
}
