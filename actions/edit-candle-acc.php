<?php
require_once "../functions/autoload.php";
Authentication::verifyView(1, "../");

$id = $_GET["id"] ?? 0;


try {
} catch (Exception $e) {
  die("No se pudo editar el producto ;(");
}

header("Location: ../dashboard.php");
