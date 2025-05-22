<?php

class View
{
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
    $JSON = file_get_contents("db/views.json");
    $JSONData = json_decode($JSON);

    foreach ($JSONData as $item) {
      if ($item->name == $view) {

        if ($item->active) {

          if ($item->restricted) {
            $view403 = new self;

            $view403->name = "403";
            $view403->title = "Acceso no autorizado";
            $view403->active = 1;
            $view403->restricted = 0;

            return $view403;
          } else {
            $objView = new self();

            $objView->name = $item->name;
            $objView->title = $item->title;
            $objView->active = $item->active;
            $objView->restricted = $item->restricted;

            return $objView;
          }
        }

        $viewNoActive = new self;

        $viewNoActive->name = "maintenance";
        $viewNoActive->title = "Página no encontrada";
        $viewNoActive->active = 1;
        $viewNoActive->restricted = 0;

        return $viewNoActive;
      }
    }

    $view404 = new self();

    $view404->name = "404";
    $view404->title = "Página no encontrada";
    $view404->active = 1;
    $view404->restricted = 0;

    return $view404;
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
