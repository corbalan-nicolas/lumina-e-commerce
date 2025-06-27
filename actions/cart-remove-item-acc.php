<?php

require_once "../functions/autoload.php";

$id = $_GET["id"] ?? false;

if ($id) {
  Cart::removeItem($id);
}

header("Location: ../index.php?section=cart");
