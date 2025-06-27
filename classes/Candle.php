<?php

class Candle
{
  private $id;
  private $name;
  private $css_color;
  private $date_release;
  private $description;
  private $main_img;
  private $price;
  private $discount;
  private $material;
  private $duration;
  private $size;
  private $weight;
  private $fragance;
  private Category $category;
  private array $tags;
  private array $extraImages;

  private static $createValues = ["id", "name", "css_color", "date_release", "description", "main_img", "price", "discount", "material", "duration", "size", "weight", "fragance"];

  /**
   * Creates a complex object from a complex array
   * @param array $candleData An associative array with the params of Candle->createValues + id_category + tags[id] + extra_images[id]
   * @return ?Candle A beautiful Candle object
   */
  public static function createCandle(array $candleData): ?Candle
  {
    // Salvaguarda 🙏
    if ($candleData === false) {
      return null;
    }

    // echo "<pre>";
    // var_dump($candleData);
    // echo "</pre>";

    $candle = new self();

    foreach (self::$createValues as $key) {
      $candle->{$key} = $candleData[$key];
    }

    // CATEGORY
    $candle->category = Category::filter_by_id($candleData["id_category"]);

    // TAGS
    $candle->tags = [];
    $tags = $candleData["tags"] ?? [];
    $tags = !empty($tags) ? explode(",", $tags) : [];

    foreach ($tags as $idTag) {
      $candle->tags[] = Tag::filter_by_id($idTag);
    }

    // CAROUSEL IMAGES / EXTRA IMAGES
    $candle->extraImages = [];
    $extraImages = $candleData["extra_images"] ?? [];
    $extraImages = !empty($extraImages) ? explode(",", $extraImages) : [];

    foreach ($extraImages as $idImg) {
      $candle->extraImages[] = ExtraImage::filter_by_id($idImg);
    }

    return $candle;
  }

  /**
   * Merges two array of Candle objects by saving the matches in a new array
   * 
   * @param array $array1 Array 1 of Candle objects
   * @param array $array2 Array 2 of Candle objects
   * 
   * @return Candle[] A new array of Candle object
   */
  public static function mergeArrays(array $array1, array $array2): array
  {
    $result = [];

    foreach ($array1 as $i) {
      foreach ($array2 as $j) {
        if ($i->id == $j->id) {
          $result[] = $i;
        }
      }
    }

    return $result;
  }

  /**
   * Retrieves all Candle products from the Database.
   *
   * @return Candle[] List of Candle objects.
   */
  public static function get_all_products(): array
  {
    $conn = Connection::getConnection();

    $query = "SELECT candles.*, candles_details.*, GROUP_CONCAT(DISTINCT tags.id) as tags, GROUP_CONCAT(DISTINCT extra_images.id) as extra_images 
              FROM candles
              JOIN candles_details ON candles.id = candles_details.id
              LEFT OUTER JOIN extra_images ON candles.id = extra_images.id_candle
              LEFT OUTER JOIN candles_x_tags ON candles.id = candles_x_tags.id_candle
              LEFT OUTER JOIN tags ON candles_x_tags.id_tag = tags.id
              GROUP BY candles.id";

    $stmt = $conn->prepare($query);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();

    $catalog = [];

    while ($res = $stmt->fetch()) {
      $catalog[] = self::createCandle($res);
    }

    return $catalog;
  }

  /**
   * Filters and returns products that have a discount.
   *
   * @return Candle[] Array of Candle objects that have a discount applied.
   */
  public static function filter_by_discount(): array
  {
    $conn = Connection::getConnection();

    $query = "SELECT candles.*, candles_details.*, GROUP_CONCAT(DISTINCT tags.id) as tags, GROUP_CONCAT(DISTINCT extra_images.id) as extra_images 
              FROM candles
              JOIN candles_details ON candles.id = candles_details.id
              LEFT OUTER JOIN extra_images ON candles.id = extra_images.id_candle
              LEFT OUTER JOIN candles_x_tags ON candles.id = candles_x_tags.id_candle
              LEFT OUTER JOIN tags ON candles_x_tags.id_tag = tags.id
              WHERE discount > 0
              GROUP BY candles.id";

    $stmt = $conn->prepare($query);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();

    $catalog = [];

    while ($res = $stmt->fetch()) {
      $catalog[] = self::createCandle($res);
    }

    // echo "<pre>";
    // print_r($catalog);
    // echo "<pre>";

    return $catalog;
  }

  /**
   * Filters and returns products that match any of the given id_categories.
   *
   * @param string[] $categories Array of category ids to filter by.
   * @return Candle[] Array of Candle objects whose category matches the given list.
   */
  public static function filter_by_categories(array $categories): array
  {
    $holderString = "";
    $holderValues = [];

    foreach ($categories as $item) {
      $holderString = $holderString . "?, "; // ¿Es esta la única vez en la que está justificado concatenar un string en un query? 🤔
      $holderValues[] = $item;
    }

    $holderString = $holderString . "?";
    $holderValues[] = 0;

    $conn = Connection::getConnection();

    $query = "SELECT candles.*, candles_details.*, GROUP_CONCAT(DISTINCT tags.id) as tags, GROUP_CONCAT(DISTINCT extra_images.id) as extra_images 
              FROM candles
              JOIN candles_details ON candles.id = candles_details.id
              LEFT OUTER JOIN extra_images ON candles.id = extra_images.id_candle
              LEFT OUTER JOIN candles_x_tags ON candles.id = candles_x_tags.id_candle
              LEFT OUTER JOIN tags ON candles_x_tags.id_tag = tags.id
              WHERE id_category IN ($holderString)
              GROUP BY candles.id";

    $stmt = $conn->prepare($query);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute($holderValues);

    $catalog = [];

    while ($res = $stmt->fetch()) {
      $catalog[] = self::createCandle($res);
    }

    return $catalog;
  }

  /**
   * Searches for a product by its ID.
   *
   * @param int $id The ID of the product to search for.
   * @return ?Candle The matching Candle object, or null if not found.
   */
  public static function filter_by_id(int $id): ?Candle
  {
    $conn = Connection::getConnection();

    $query = "SELECT candles.*, candles_details.*, GROUP_CONCAT(DISTINCT tags.id) as tags, GROUP_CONCAT(DISTINCT extra_images.id) as extra_images 
              FROM candles
              JOIN candles_details ON candles.id = candles_details.id
              LEFT OUTER JOIN extra_images ON candles.id = extra_images.id_candle
              LEFT OUTER JOIN candles_x_tags ON candles.id = candles_x_tags.id_candle
              LEFT OUTER JOIN tags ON candles_x_tags.id_tag = tags.id
              WHERE candles.id = ?
              GROUP BY candles.id";

    $stmt = $conn->prepare($query);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute([$id]);

    // echo "<pre>";
    // print_r($stmt->fetch());
    // echo "</pre>";

    $res = self::createCandle($stmt->fetch());

    return $res ?? null;
  }

  /**
   * Inserts a new candle into the database
   * 
   * @param string $name
   * @param string $description
   * @param int $id_category
   * @param string $cover The filename of the cover
   * @param float $price
   * @param int $discount
   * @param string $css_color Any valid css color to the smoke effect
   * @param string $material
   * @param string $duration
   * @param string $size
   * @param string $weight
   * @param string $fragance
   * 
   * @return int The new Candle's ID
   */
  public static function insert(string $name, string $description, int $id_category, string $cover, float $price, int $discount, string $css_color, string $material, string $duration, string $size, string $weight, string $fragance): int
  {
    $conn = Connection::getConnection();

    $query = "INSERT INTO candles VALUES (NULL, :name, :description, :id_category, :cover, :price, :discount, :css_color, NULL)";

    $stmt = $conn->prepare($query);
    $stmt->execute([
      "name" => $name,
      "description" => $description,
      "id_category" => $id_category,
      "cover" => $cover,
      "price" => $price,
      "discount" => $discount,
      "css_color" => $css_color,
    ]);

    $candleId = $conn->lastInsertId();

    $query = "INSERT INTO candles_details VALUES(:id, :material, :duration, :size, :weight, :fragance)";

    $stmt = $conn->prepare($query);
    $stmt->execute([
      "id" => $candleId,
      "material" => $material,
      "duration" => $duration,
      "size" => $size,
      "weight" => $weight,
      "fragance" => $fragance
    ]);

    return $candleId;
  }

  /**
   * Modifies the params of the object in the database
   * 
   * @param string $name
   * @param string $description
   * @param int $id_category
   * @param string $cover The filename of the cover
   * @param float $price
   * @param int $discount
   * @param string $css_color Any valid css color to the smoke effect
   * @param string $material
   * @param string $duration
   * @param string $size
   * @param string $weight
   * @param string $fragance
   * 
   * @return void
   */
  public function edit(string $name, string $description, int $id_category, string $cover, float $price, int $discount, string $css_color, string $material, string $duration, string $size, string $weight, string $fragance): void
  {
    $conn = Connection::getConnection();
    $query = "UPDATE candles SET 
              name = :name,
              description = :description,
              id_category = :id_category,
              main_img = :cover,
              price = :price,
              discount = :discount,
              css_color = :css_color
              WHERE id = :id;

              UPDATE candles_details SET
              material = :material,
              duration = :duration,
              size = :size,
              weight = :weight,
              fragance = :fragance
              WHERE id = :id_detail";

    $stmt = $conn->prepare($query);
    $stmt->execute([
      "id" => $this->id,
      "id_detail" => $this->id,
      "name" => $name,
      "description" => $description,
      "id_category" => $id_category,
      "cover" => $cover,
      "price" => $price,
      "discount" => $discount,
      "css_color" => $css_color,
      "material" => $material,
      "duration" => $duration,
      "size" => $size,
      "weight" => $weight,
      "fragance" => $fragance,
    ]);
  }

  /**
   * Deletes the candle from the database
   * 
   * @return void
   */
  public function delete(): void
  {
    Image::delete("../img/candles/" . $this->main_img);

    $conn = Connection::getConnection();

    $query = "DELETE FROM candles_details WHERE id = ?;
              DELETE FROM candles WHERE id = ?";

    $stmt = $conn->prepare($query);
    $stmt->execute([$this->id, $this->id]);
  }

  /**
   * Adds a new record to the pivot table linking a candle with a tag.
   *
   * @param int $id_candle The ID of the candle.
   * @param int $id_tag    The ID of the tag.
   *
   * @return void
   */
  public static function addTag(int $id_candle, int $id_tag): void
  {
    $conn = Connection::getConnection();

    $query = "INSERT INTO candles_x_tags VALUES (NULL, ?, ?)";

    $stmt = $conn->prepare($query);
    $stmt->execute([$id_candle, $id_tag]);
  }

  /**
   * Removes all tag associations for the current candle from the pivot table.
   *
   * @return void
   */
  public function clearTags(): void
  {
    $conn = Connection::getConnection();

    $query = "DELETE FROM candles_x_tags WHERE id_candle = ?";

    $stmt = $conn->prepare($query);
    $stmt->execute([$this->id]);
  }

  /**
   * Removes all images associations for the current candle from the extra_images table.
   *
   * @return void
   */
  public function clearExtraImages()
  {
    $conn = Connection::getConnection();

    $query = "DELETE FROM extra_images WHERE id_candle = ?";

    $stmt = $conn->prepare($query);
    $stmt->execute([$this->id]);
  }

  /**
   * Outputs the HTML markup for the product's price inside a <p> element.
   *
   * If the product has a discount, both the original and discounted prices will be shown,
   * with the original price struck through. The output is directly echoed.
   *
   * @param string $class (Optional) CSS class name to apply to the <p> element.
   * @return void
   */
  public function show_price($class = "")
  {
    if ($this->discount) {
      echo "
        <p class='$class' title='Precio en \$USD'>
          <span class='card__price--line-through not-sr-only'>\${$this->getPrice(false)}</span>
          <strong>\${$this->getPrice()}</strong>
        </p>
      ";
    } else {
      echo "
        <p class='$class' title='Precio en \$USD'>
          <strong>\${$this->getPrice()}</strong>
        </p>
      ";
    }
  }

  /**
   * Get the value of id
   */
  public function getId(): int
  {
    return $this->id;
  }

  /**
   * Set the value of id
   *
   * @return  self
   */
  public function setId(int $id)
  {
    $this->id = $id;

    return $this;
  }

  /**
   * Get the value of name
   */
  public function getName(): string
  {
    return $this->name;
  }

  /**
   * Set the value of name
   *
   * @return  self
   */
  public function setName(string $name)
  {
    $this->name = $name;

    return $this;
  }

  /**
   * Get the value of cssColor
   */
  public function getCssColor(): string
  {
    return $this->css_color;
  }

  /**
   * Set the value of cssColor
   *
   * @return  self
   */
  public function setCssColor(string $css_color)
  {
    $this->css_color = $css_color;

    return $this;
  }

  /**
   * Get the value of dateRelease
   */
  public function getdateRelease(): string
  {
    return $this->date_release;
  }

  /**
   * Set the value of dateRelease
   *
   * @return  self
   */
  public function setdateRelease(string $date_release)
  {
    $this->date_release = $date_release;

    return $this;
  }

  /**
   * Get the value of description
   */
  public function getDescription(): string
  {
    return $this->description;
  }

  /**
   * Set the value of description
   *
   * @return  self
   */
  public function setDescription(string $description)
  {
    $this->description = $description;

    return $this;
  }

  /**
   * Get the value of mainImg
   */
  public function getMainImg(): string
  {
    return $this->main_img;
  }

  /**
   * Set the value of mainImg
   *
   * @return  self
   */
  public function setMainImg(string $main_img)
  {
    $this->main_img = $main_img;

    return $this;
  }

  /**
   * Returns the product's price, optionally applying the discount.
   *
   * If a discount is present and `$applyDiscount` is true, the returned price will reflect the discount.
   * The result is formatted as a string with two decimal places.
   *
   * @param bool $applyDiscount (Optional) Whether to apply the discount to the price (default: true).
   * @return string Formatted price as a string (number_format()).
   */
  public function getPrice(bool $applyDiscount = true): string
  {
    $price = floatval($this->price);
    $discount = intval($this->discount);

    if ($applyDiscount && $discount) {
      $price = $price - ($price * ($discount / 100));
    }

    return number_format($price, 2);
  }

  /**
   * Set the value of price
   *
   * @return  self
   */
  public function setPrice(float|int $price)
  {
    $this->price = $price;

    return $this;
  }

  /**
   * Get the value of discount
   */
  public function getDiscount(): int
  {
    return $this->discount;
  }

  /**
   * Set the value of discount
   *
   * @return  self
   */
  public function setDiscount(int $discount)
  {
    $this->discount = $discount;

    return $this;
  }

  /**
   * Get the value of category
   */
  public function getCategory(): Category
  {
    return $this->category;
  }

  /**
   * Set the value of category
   *
   * @return  self
   */
  public function setCategory(Category $category)
  {
    $this->category = $category;

    return $this;
  }

  /**
   * Get the value of details
   */
  public function getDetails(): array
  {
    return [
      [
        "title" => "Material",
        "icon" => "icon--box",
        "value" => $this->material
      ],
      [
        "title" => "Duración",
        "icon" => "icon--clock",
        "value" => $this->duration
      ],
      [
        "title" => "Tamaño",
        "icon" => "icon--ruler",
        "value" => $this->size
      ],
      [
        "title" => "Peso",
        "icon" => "icon--weight",
        "value" => $this->weight
      ],
      [
        "title" => "Fragancia",
        "icon" => "icon--plant",
        "value" => $this->fragance
      ],
    ];
  }

  /**
   * Get the value of extraImg
   * @return ExtraImage[] array of ExtraImage objects
   */
  public function getExtraImg(): array
  {
    return $this->extraImages;
  }

  /**
   * Set the value of extraImg
   *
   * @return  self
   */
  public function setExtraImg(array $extraImages)
  {
    $this->extraImages = $extraImages;

    return $this;
  }

  /**
   * Get the value of tags
   */
  public function getTags()
  {
    return $this->tags;
  }

  public function getArrayOfTagsId(): array
  {
    $result = [];

    foreach ($this->tags as $tag) {
      $result[] = $tag->getId();
    }

    return $result;
  }

  /**
   * Set the value of tags
   *
   * @return  self
   */
  public function setTags($tags)
  {
    $this->tags = $tags;

    return $this;
  }

  /**
   * Get the value of material
   */
  public function getMaterial()
  {
    return $this->material;
  }

  /**
   * Set the value of material
   *
   * @return  self
   */
  public function setMaterial($material)
  {
    $this->material = $material;

    return $this;
  }

  /**
   * Get the value of duration
   */
  public function getDuration()
  {
    return $this->duration;
  }

  /**
   * Set the value of duration
   *
   * @return  self
   */
  public function setDuration($duration)
  {
    $this->duration = $duration;

    return $this;
  }

  /**
   * Get the value of size
   */
  public function getSize()
  {
    return $this->size;
  }

  /**
   * Set the value of size
   *
   * @return  self
   */
  public function setSize($size)
  {
    $this->size = $size;

    return $this;
  }

  /**
   * Get the value of weight
   */
  public function getWeight()
  {
    return $this->weight;
  }

  /**
   * Set the value of weight
   *
   * @return  self
   */
  public function setWeight($weight)
  {
    $this->weight = $weight;

    return $this;
  }

  /**
   * Get the value of fragance
   */
  public function getFragance()
  {
    return $this->fragance;
  }

  /**
   * Set the value of fragance
   *
   * @return  self
   */
  public function setFragance($fragance)
  {
    $this->fragance = $fragance;

    return $this;
  }
}
