<?php

class Purchase
{
  private int $id;
  private int $id_user;
  private float $amount;
  private string $purchase_date;
  private array $items;

  private static $createObjectValues = ["id", "id_user", "amount", "purchase_date"];

  /**
   * @return Purchase
   */
  public static function createObject(array $fetchData)
  {
    $purchase = new self();


    // Static values
    foreach (self::$createObjectValues as $key) {
      $purchase->{$key} = $fetchData[$key];
    }


    // Array of items
    $items = [];
    $itemsFromFetch = explode(",", $fetchData["items"]);
    foreach ($itemsFromFetch as $id) {
      $items[] = self::getPurchaseItemByItsId($id);
    }

    $purchase->items = $items;
    return $purchase;
  }

  /**
   * Obtains all the purchases from 1 specific user
   * @param int $id_user The user id
   * @return Purchase[] Array of Purchase objects
   */
  public static function filter_by_user($id_user)
  {
    $conn = Connection::getConnection();

    $query = "SELECT
                purchases.*,
                GROUP_CONCAT(pivot.id) as items
              FROM purchases
              JOIN items_x_purchase AS pivot ON purchases.id = pivot.id_purchase
              WHERE purchases.id_user = ?
              GROUP BY purchases.id
              ORDER BY purchases.id DESC;";

    $stmt = $conn->prepare($query);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute([$id_user]);


    $purchases = [];
    while ($res = $stmt->fetch()) {
      $purchases[] = self::createObject($res);
    }


    return $purchases;
  }

  public static function getPurchaseItemByItsId($id)
  {
    $conn = Connection::getConnection();

    $query = "SELECT 
                items_x_purchase.*,
                candles.name,
                candles.main_img
              FROM items_x_purchase
              JOIN candles ON items_x_purchase.id_item = candles.id
              WHERE items_x_purchase.id = ?";

    $stmt = $conn->prepare($query);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute([$id]);

    return $stmt->fetch();
  }

  /**
   * Calculates the total
   */
  public function getQuantityOfItems(): int
  {
    $res = 0;

    foreach ($this->items as $item) {
      // echo "<pre>";
      // print_r($item);
      // echo "</pre>";
      $res += $item["quantity"];
    }

    return $res;
  }

  /**
   * Get the value of id
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set the value of id
   *
   * @return  self
   */
  public function setId($id)
  {
    $this->id = $id;

    return $this;
  }

  /**
   * Get the value of id_user
   */
  public function getIdUser()
  {
    return $this->id_user;
  }

  /**
   * Set the value of id_user
   *
   * @return  self
   */
  public function setIdUser($id_user)
  {
    $this->id_user = $id_user;

    return $this;
  }

  /**
   * Get the value of amount
   */
  public function getAmount()
  {
    return $this->amount;
  }

  /**
   * Set the value of amount
   *
   * @return  self
   */
  public function setAmount($amount)
  {
    $this->amount = $amount;

    return $this;
  }

  /**
   * Get the value of purchase_date in the format DD-MM-YYYY
   */
  public function getPurchaseDate()
  {
    return date("d/m/Y", strtotime($this->purchase_date));;
  }

  /**
   * Set the value of purchase_date
   *
   * @return  self
   */
  public function setPurchaseDate($purchase_date)
  {
    $this->purchase_date = $purchase_date;

    return $this;
  }

  /**
   * Get the value of items
   */
  public function getItems()
  {
    return $this->items;
  }

  /**
   * Set the value of items
   *
   * @return  self
   */
  public function setItems($items)
  {
    $this->items = $items;

    return $this;
  }
}
