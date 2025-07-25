<?php

require_once "../functions/autoload.php";
Authentication::verifyView(2, "../");

$formData = $_POST;
$fileData = $_FILES;

// echo "<pre>";
// print_r($formData);
// echo "</pre>";

// echo "<pre>";
// print_r($fileData);
// echo "</pre>";

// die("Pre try{}");

try {

  // CATEGORY
  $id_category = $formData["category"];
  if ($formData["category"] === "newCategory") {
    $id_category = Category::insert($formData["newCategory"]);
  }

  // COVER
  $cover = Image::uploadImage('../img/candles/', $fileData["cover"]);
  $id_candle = Candle::insert($formData["name"], $formData["description"], $id_category, $cover, $formData["price"], $formData["discount"], $formData["cssColor"], $formData["material"], $formData["duration"], $formData["size"], $formData["weight"], $formData["fragance"]);

  // TAGS
  if (isset($formData["tags"])) {
    foreach ($formData["tags"] as $id_tag) {
      Candle::addTag($id_candle, $id_tag);
    }
  }

  // EXTRA_IMAGES
  if (!empty($fileData["extra_images"]["name"][0])) {
    for ($i = 0; $i < count($fileData["extra_images"]["name"]); $i++) {
      // Tiene que haber una forma más óptima de hacer esto...
      $file = [
        "name" => $fileData["extra_images"]["name"][$i],
        "full_path" => $fileData["extra_images"]["full_path"][$i],
        "type" => $fileData["extra_images"]["type"][$i],
        "tmp_name" => $fileData["extra_images"]["tmp_name"][$i],
        "error" => $fileData["extra_images"]["error"][$i],
        "size" => $fileData["extra_images"]["size"][$i]
      ];

      $filename = Image::uploadImage('../img/candles/carousel/', $file, "c$i-");

      ExtraImage::insert($filename, $id_candle);
    }
  }

  Alert::addAlert('success', 'El producto se agregó correctamente');
} catch (Exception $e) {
  // echo "<pre>";
  // print_r($e);
  // echo "</pre>";

  Alert::addAlert('danger', 'No se pudo agregar el producto, contacte con servicio técnico');
}





if (array_key_exists("goBackToForm", $formData)) {
  header("Location: ../dashboard.php?section=add-product");
} else {
  header("Location: ../dashboard.php?section=admin-products");
}
