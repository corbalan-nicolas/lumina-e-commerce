<?php

require_once "../functions/autoload.php";

$id_candle = $_GET["id"] ?? 0;
$quantity = $_GET["quantity"] ?? 1;

Cart::subtractItem($id_candle, $quantity);

header("Location: ../index.php?section=cart");
