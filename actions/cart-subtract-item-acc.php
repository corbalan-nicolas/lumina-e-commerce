<?php

require_once "../functions/autoload.php";

$id_candle = $_GET["id"] ?? 0;
$amount = $_GET["amount"] ?? 1;

Cart::subtractItem($id_candle, $amount);

header("Location: ../index.php?section=cart");
