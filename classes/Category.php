<?php

class Category
{
  private $id;
  private $category;

  /**
   * Retuns all the categories from the DB
   * 
   * @return Category[] Array of Category objects
   */
  public static function get_all_categories(): array
  {
    $conn = Connection::getConnection();

    $query = "SELECT * FROM categories";

    $stmt = $conn->prepare($query);
    $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
    $stmt->execute();

    return $stmt->fetchAll();
  }

  /**
   * Return 1 single object based on the id
   * @param int $id The category_id
   * 
   * @return ?Category An object category (or null)
   */
  public static function filter_by_id(int $id): ?Category
  {
    $conn = Connection::getConnection();

    $query = "SELECT * FROM categories WHERE categories.id = ?";

    $stmt = $conn->prepare($query);
    $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
    $stmt->execute([$id]);

    $res = $stmt->fetch();

    return $res ? $res : null;
  }

  /**
   * Insert a new category into the database
   * @param string $name the category's name
   * @return int $id_category the new category's id
   */
  public static function insert(string $name): int
  {
    $conn = Connection::getConnection();

    $query = "INSERT INTO categories VALUES (NULL, ?)";

    $stmt = $conn->prepare($query);
    $stmt->execute([$name]);

    return $conn->lastInsertId();
  }

  public function update($category)
  {
    $conn = Connection::getConnection();

    $query = "UPDATE categories SET category = ? WHERE id = ?";

    $stmt = $conn->prepare($query);
    $stmt->execute([$category, $this->id]);
  }

  public function delete()
  {
    $conn = Connection::getConnection();

    $query = "DELETE FROM categories WHERE id = ?";

    $stmt = $conn->prepare($query);
    $stmt->execute([$this->id]);
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
   * Get the value of name
   */
  public function getName()
  {
    return $this->category;
  }

  /**
   * Set the value of name
   *
   * @return  self
   */
  public function setName($category)
  {
    $this->category = $category;

    return $this;
  }
}
