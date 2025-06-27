<?php

class Tag
{
  private $id;
  private $tag;

  /**
   * Return all the tags from the DB
   * 
   * @return Tag[] Array fo Tag object
   */
  public static function get_all_tags(): array
  {
    $conn = Connection::getConnection();

    $query = "SELECT * FROM tags";

    $stmt = $conn->prepare($query);
    $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
    $stmt->execute();

    return $stmt->fetchAll();
  }

  /**
   * Retrieves a Tag object by its ID.
   *
   * @param int $id The ID of the tag to find.
   *
   * @return Tag|null Returns a Tag instance if found, or null if not.
   */
  public static function filter_by_id(int $id): ?Tag
  {
    $conn = Connection::getConnection();

    $query = "SELECT * FROM tags WHERE id = ?";

    $stmt = $conn->prepare($query);
    $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
    $stmt->execute([$id]);

    $res = $stmt->fetch();

    return $res ? $res : null;
  }

  /**
   * Updates the tag name in the database for this tag instance.
   *
   * @param string $tag The new tag name.
   *
   * @return void
   */
  public function update(string $tag): void
  {
    $conn = Connection::getConnection();

    $query = "UPDATE tags SET tag = ? WHERE id = ?";

    $stmt = $conn->prepare($query);
    $stmt->execute([$tag, $this->id]);
  }

  /**
   * Insert a new tag in the database
   * 
   * @param string $tag The tag's name
   */
  public static function insert(string $tag): void
  {
    $conn = Connection::getConnection();

    $query = "INSERT INTO tags VALUES (NULL, ?)";

    $stmt = $conn->prepare($query);
    $stmt->execute([$tag]);
  }

  /**
   * Deletes this tag from the database using its ID.
   *
   * @return void
   */
  public function delete(): void
  {
    $conn = Connection::getConnection();

    $query = "DELETE FROM tags WHERE id = ?";

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
   * Get the value of tag
   */
  public function getTag()
  {
    return $this->tag;
  }

  /**
   * Set the value of tag
   *
   * @return  self
   */
  public function setTag($tag)
  {
    $this->tag = $tag;

    return $this;
  }
}
