<?php

class Checkout
{

  /**
   * Interts a purchase data into the database
   * @param int $id_user Customer id
   * @param float $amount The total amount of the purchase
   * @param array $itemsData Array of associative arrays with the following params: id_item, quantity, price and discount_applied
   */
  public static function insertCheckoutData(int $id_user, float $amount, array $itemsData): void
  {
    $conn = Connection::getConnection();

    $query = "INSERT INTO purchases (id_user, amount) VALUES (?, ?)";

    $stmt = $conn->prepare($query);
    $stmt->execute([$id_user, $amount]);

    $id_purchase = $conn->lastInsertId();

    foreach ($itemsData as $item) {
      $query = "INSERT INTO items_x_purchase VALUES (NULL, :id_purchase, :id_item, :quantity, :price, :discount_applied)";

      $stmt = $conn->prepare($query);
      $stmt->execute([
        "id_purchase" => $id_purchase,
        "id_item" => $item["id_item"],
        "quantity" => $item["quantity"],
        "price" => $item["price"],
        "discount_applied" => $item["discount_applied"],
      ]);
    }

    Cart::clearItems();
  }
}
