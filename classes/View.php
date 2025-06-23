<?php

class View
{
  private $id;
  private $name;
  private $title;
  private $active;
  private $restricted;

  /**
   * Función que valida que la vista pasada por parámetro
   * esté dentro de la lista blanca, que sea activa, y que
   * no esté restringida. Caso contrario devuelve 404, 403
   * o página restringid
   * a
   * @param string $view EL "name" de la vista que quieras validar
   * 
   * @return View Objeto View con los datos de la vista corespondiente
   */
  public static function validate_view(?string $view): View
  {
    $conn = Connection::getConnection();

    $query = "SELECT * FROM views WHERE name = ?";

    $stmt = $conn->prepare($query);
    $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
    $stmt->execute([$view]);

    $view = $stmt->fetch();
    if (!$view) {
      // 404
      $view = new self();

      $view->name = "404";
      $view->title = "Error 404";
    } else if (!$view->active) {
      // Maintenance
      $view->name = "maintenance";
      $view->title = "Página en mantenimiento";
    }

    return $view;
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
    return $this->name;
  }

  /**
   * Set the value of name
   *
   * @return  self
   */
  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }

  /**
   * Get the value of title
   */
  public function getTitle()
  {
    return $this->title;
  }

  /**
   * Set the value of title
   *
   * @return  self
   */
  public function setTitle($title)
  {
    $this->title = $title;

    return $this;
  }

  /**
   * Get the value of active
   */
  public function getActive()
  {
    return $this->active;
  }

  /**
   * Set the value of active
   *
   * @return  self
   */
  public function setActive($active)
  {
    $this->active = $active;

    return $this;
  }

  /**
   * Get the value of restricted
   */
  public function getRestricted()
  {
    return $this->restricted;
  }

  /**
   * Set the value of restricted
   *
   * @return  self
   */
  public function setRestricted($restricted)
  {
    $this->restricted = $restricted;

    return $this;
  }
}
