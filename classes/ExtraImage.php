<?php

class ExtraImage
{
  private $id;
  private $filename;
  private $id_candle;

  public static function filter_by_id(int $id): ?ExtraImage
  {
    $conn = Connection::getConnection();

    $query = "SELECT * FROM extra_images WHERE id = ?";

    $stmt = $conn->prepare($query);
    $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
    $stmt->execute([$id]);

    $res = $stmt->fetch();

    return $res ? $res : null;
  }

  public static function insert(string $filename, int $id_candle): void
  {
    $conn = Connection::getConnection();

    // echo "<h1>INSERT</h1>";
    // echo "<p>Filename: $filename</p>";
    // echo "<p>Id vela: $id_candle</p>";

    $query = "INSERT INTO extra_images VALUES (NULL, ?, ?)";

    $stmt = $conn->prepare($query);
    $stmt->execute([$filename, $id_candle]);

    // echo "<p>Id bla: " . $conn->lastInsertId() . "</p>";
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
   * Get the value of filename
   */
  public function getFilename()
  {
    return $this->filename;
  }

  /**
   * Set the value of filename
   *
   * @return  self
   */
  public function setFilename($filename)
  {
    $this->filename = $filename;

    return $this;
  }

  /**
   * Get the value of id_candle
   */
  public function getIdCandle()
  {
    return $this->id_candle;
  }

  /**
   * Set the value of id_candle
   *
   * @return  self
   */
  public function setIdCandle($id_candle)
  {
    $this->id_candle = $id_candle;

    return $this;
  }
}
