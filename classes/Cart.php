<?php

class Cart
{

  /**
   * Adds a candle to the shopping cart or updates its quantity if it already exists
   * 
   * @param int $id_candle The ID of the candle to add.
   * @param int $quantity    (Optional) The quantity to add (default is 1).
   *
   * @return void
   */
  public static function addItem(int $id_candle, int $quantity = 1): void
  {
    $candle = Candle::filter_by_id($id_candle);

    if ($candle) {
      $_SESSION["lumina-cart"][$id_candle] = $quantity += ($_SESSION["lumina-cart"][$id_candle] ?? 0);
    }
  }

  /**
   * Subtracts a quantity of a candle from the shopping cart.
   * Removes the item if the resulting quantity is zero or less.
   *
   * @param int $id_candle The ID of the candle to subtract.
   * @param int $quantity    The quantity to subtract (default is 1).
   *
   * @return void
   */
  public static function subtractItem(int $id_candle, int $quantity = 1): void
  {
    $candle = Candle::filter_by_id($id_candle);

    if ($candle) {
      $newValue = ($_SESSION["lumina-cart"][$id_candle] ?? 0) - $quantity;
      $_SESSION["lumina-cart"][$id_candle] = $newValue;

      if ($newValue <= 0) {
        unset($_SESSION["lumina-cart"][$id_candle]);
      }
    }
  }

  /**
   * Removes a candle from the shopping cart completely.
   *
   * @param int $id The ID of the candle to remove.
   *
   * @return void
   */
  public static function removeItem(int $id): void
  {
    if (isset($_SESSION["lumina-cart"][$id])) {
      unset($_SESSION["lumina-cart"][$id]);
    }
  }

  /**
   * Empties the entire shopping cart.
   *
   * @return void
   */
  public static function clearItems(): void
  {
    $_SESSION["lumina-cart"] = [];
  }

  /**
   * Retrieves all items currently stored in the shopping cart.
   *
   * @return array An associative array of candle IDs and their quantities.
   */
  public static function getItems(): array
  {
    if (!empty($_SESSION["lumina-cart"])) {
      return $_SESSION["lumina-cart"];
    }
    return [];
  }

  /**
   * Calculates the total cost of all items in the shopping cart.
   *
   * @return float The total price based on candle price and quantity.
   */
  public static function getTotal(): float
  {
    $total = 0;

    if (!empty($_SESSION["lumina-cart"])) {
      foreach ($_SESSION["lumina-cart"] as $id_candle => $quantity) {
        $candle = Candle::filter_by_id($id_candle);

        if ($candle) {
          $total += $candle->getPrice() * $quantity;
        }
      }
    }

    return $total;
  }
}
