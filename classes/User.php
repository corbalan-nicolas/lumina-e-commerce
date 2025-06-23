<?php


class User
{
  private $id;
  private $full_name;
  private $email;
  private $password;
  private $rol;
  private $date_created;

  /**
   * Return all the users from the DB
   * 
   * @return User[] Array of User objects
   */
  public static function get_all_users(): array
  {
    $conn = Connection::getConnection();

    $query = "SELECT * FROM users";

    $stmt = $conn->prepare($query);
    $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
    $stmt->execute();

    return $stmt->fetchAll();
  }

  public static function filter_by_email(string $email): ?User
  {
    $conn = Connection::getConnection();

    $query = "SELECT * FROM users WHERE email = ?";

    $stmt = $conn->prepare($query);
    $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
    $stmt->execute([$email]);

    $res = $stmt->fetch();

    return $res ? $res : null;
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
   * Get the value of fullName
   */
  public function getFullName()
  {
    return $this->full_name;
  }

  /**
   * Set the value of fullName
   *
   * @return  self
   */
  public function setFullName($full_name)
  {
    $this->full_name = $full_name;

    return $this;
  }

  /**
   * Get the value of email
   */
  public function getEmail()
  {
    return $this->email;
  }

  /**
   * Set the value of email
   *
   * @return  self
   */
  public function setEmail($email)
  {
    $this->email = $email;

    return $this;
  }

  /**
   * Get the value of password
   */
  public function getPassword()
  {
    return $this->password;
  }

  /**
   * Set the value of password
   *
   * @return  self
   */
  public function setPassword($password)
  {
    $this->password = $password;

    return $this;
  }

  /**
   * Get the value of rol
   */
  public function getRol()
  {
    return $this->rol;
  }

  /**
   * Set the value of rol
   *
   * @return  self
   */
  public function setRol($rol)
  {
    $this->rol = $rol;

    return $this;
  }

  /**
   * Get the value of dateCreated
   */
  public function getDateCreated()
  {
    return $this->date_created;
  }

  /**
   * Set the value of dateCreated
   *
   * @return  self
   */
  public function setDateCreated($date_created)
  {
    $this->date_created = $date_created;

    return $this;
  }
}
