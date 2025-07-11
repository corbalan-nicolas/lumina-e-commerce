<?php

require_once "../functions/autoload.php";

$cartItems = Cart::getItems();
$idUser = $_SESSION["lumina-user"]["id"] ?? 0;

try {
  if (!$idUser) {
    // It's not logged in
    throw new Exception("", 1);
  } else if (!$cartItems) {
    // Cart is empty
    throw new Exception("", 2);
  } else {
    $itemsData = [];

    foreach ($cartItems as $id => $quantity) {
      $item = Candle::filter_by_id($id);

      if ($item) {
        $itemsData[] = [
          "id_item" => $id,
          "quantity" => $quantity,
          "price" => $item->getPrice(),
          "discount_applied" => $item->getDiscount()
        ];
      }
    }

    Checkout::insertCheckoutData($idUser, Cart::getTotal(), $itemsData);

    Alert::addAlert("success", "Su compra se realizó exitosamente");
  }
} catch (Exception $e) {

  switch ($e->getCode()) {
    case 1:
      Alert::addAlert("info", "Tu sesión expiró, por favor iniciá sesión nuevamente");
      header("Location: ../index.php?section=login");
      break;
    case 2:
      Alert::addAlert("info", "Tu carrito no tiene items, es posible que se haya expirado la sesión");
      break;
    default:
      Alert::addAlert("danger", "Algo salió mal durante el proceso de compra");
      break;
  }
}

header("Location: ../index.php?section=user-panel");
